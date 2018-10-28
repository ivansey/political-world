<?php
/**
 * Created by PhpStorm.
 * User: Nyx
 * Date: 20.10.2018
 * Time: 16:14
 */

namespace Repository;

use Entity\Entity;
use Util\DB;

abstract class CRUDRepository{
    /**
     * @param string $table
     * @param int|null $offset
     * @param int|null $size
     * @return Entity[]
     */
    private static function getAll(?int $offset = null, ?int $size = null): array{
        $table = self::table();
        if(isset($offset) && is_null($size))
            return Entity::fromArraysArray(DB::execute("SELECT * FROM $table LIMIT "
                . DB::execute("SELECT COUNT(1) FROM $table") . "OFFSET $offset"));
        else if(isset($size))
            return Entity::fromArraysArray(DB::execute("SELECT * FROM $table LIMIT $size OFFSET " . isset($offset) ? $offset : null));
        else
            return Entity::fromArraysArray(DB::execute("SELECT * FROM $table"));
    }

    private static function find(int $id): Entity{
        $table = self::table();
        return Entity::fromArray(DB::execute("SELECT * FROM $table WHERE $table.id = $id"));
    }

    private static function first(): Entity{
        $table = self::table();
        return Entity::fromArray(DB::execute("SELECT * FROM $table ORDER BY id DESC LIMIT 1"));
    }


    private static function save(Entity $entity): void{
        DB::execute(self::setLikeQuery("INSERT INTO ", $entity));
    }

    private static function update(Entity $entity): void{
        DB::execute(self::setLikeQuery("UPDATE ", $entity));
    }

    private static function setLikeQuery(string $start, Entity $entity): string{
        $query = $start . lcfirst(get_class($entity)) . "s SET ";
        try {
            preg_match_all('/@property \w+ \$(\w+)/',
                (new \ReflectionClass(get_class($entity)))->getDocComment(), $matches);
            foreach ($matches[1] as $match)
                $query .= "$match = " . $entity->$match . ", ";
        } catch (\ReflectionException $e) {/* STUB: never happen*/}
        return substr($query, $query-2);
    }


    private static function delete(Entity $entity): void{
        DB::execute("DELETE FROM " . lcfirst(get_class($entity)) . " WHERE id = " . $entity->id);
    }


    /**
     * @param \ReflectionParameter[] $parameters
     * @param array $arguments
     * @return bool
     */
    private static function isArgumentsTypesEqual(array $parameters, array $arguments): bool{
        if(count($parameters) !== count($arguments))
            return false;
        for($i = 0; $i < count($parameters); $i++)
            if($parameters[$i]->getType()->getName() !== (gettype($arguments[$i]) === 'object'
                    ? get_class($arguments[$i]) : gettype($arguments[$i])))
                return false;
        return true;
    }

    /**
     * Reflection method
     * @param string $name
     * @param array $arguments
     * @return bool
     * @throws \ReflectionException
     */
    private static function canCall(string $name, array $arguments): bool {
        $class = new \ReflectionClass(static::class);
        if($class->hasMethod($name)) {
            return self::isArgumentsTypesEqual($class->getMethod($name)->getParameters(), $arguments);
        } else
            return false;
    }

    /**
     * Reflection method
     * @param string $name
     * @param array $arguments
     * @return null
     */
    public static function __callStatic(string $name, array $arguments){
        try {
            if (self::canCall($name, $arguments))
                return self::$$name($arguments);
        } catch (\ReflectionException $exception) { //STUB: never happen
        }
        return null;
    }

    private static function table(): string{
        return lcfirst(str_replace('Repository', '', static::class)) . 's';
    }
}