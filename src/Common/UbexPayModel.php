<?php
namespace UbexPay\Common;

use UbexPay\Rest\Connections;

/**
 * UbexPayModel Class
 * @property array $prop Class properties 
 */
class UbexPayModel extends Connections
{
    /**
     * Set class properties and methods
     * @param array|null $data data
     */
    public function __construct($data = null) {

        $class   = new \ReflectionClass($this);
        $methods = $class->getMethods();
        foreach ($methods as $method) {
            if (!in_array($method->name, $this->props)) {
                $this->props[$method->name] = $method->name;
            }
        }
    }
}
