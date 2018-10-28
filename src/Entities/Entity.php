<?php
/**
 * Created by PhpStorm.
 * User: Nyx
 * Date: 20.10.2018
 * Time: 16:26
 */

namespace Entity;

/**
 * Class Entity
 * @package Entity
 * @property int $id
 */
class Entity{
    /**
     * @var array
     */
    private $entity;

    /**
     * Entity constructor.
     * @param array $entity
     */
    protected function __construct(array $entity){
        $this->entity = $entity;
    }

    /**
     * Reflection method
     * @param $name
     * @return array|null
     */
    public function __get(string $name): ?array{
        if(array_key_exists($name, $this->entity))
            return $this->entity[$name];
        return null;
    }

    /**
     * Reflection method
     * @param string $name
     * @param $value
     */
    public function __set(string $name, $value): void{
        if($name !== 'id' && array_key_exists($name, $this->entity))
            $this->entity[$name] = $value;
    }

    /**
     * @param array $array
     * @return Entity
     */
    public static function fromArray(array $array): Entity{
        return new static($array);
    }

    /**
     * @param array $array
     * @return Entity[]
     */
    public static function fromArraysArray(array $array): array {
        $arr = [];
        foreach ($array as $item)
            array_push($arr, new static($item));
        return $arr;
    }
}