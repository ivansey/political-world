<?php
/**
 * Created by PhpStorm.
 * User: ivansey
 * Date: 04.11.18
 * Time: 18:56
 */

class Store_add
{
    public $echo;

    public function __construct($echo)
    {
        $this->echo = $echo;
    }

    public function echo_call() {
        return
            $this->echo;
    }
}
