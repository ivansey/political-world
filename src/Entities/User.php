<?php
/**
 * Created by PhpStorm.
 * User: Nyx
 * Date: 20.10.2018
 * Time: 16:26
 */

namespace Entity;

/**
 * Reflection Class User
 * @package Entity
 * @property string $name
 * @property string $password
 * @property string $about
 * @property int $money
 * @property ?string $date_reg
 */
class User extends Entity{

    /**
     * @param string $name
     * @return User
     */
    public function name(string $name): User
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @param string $password
     * @return User
     */
    public function password(string $password): User
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @param string $about
     * @return User
     */
    public function about(string $about): User
    {
        $this->about = $about;
        return $this;
    }

    /**
     * @param int $money
     * @return User
     */
    public function money(int $money): User
    {
        $this->money = $money;
        return $this;
    }
}