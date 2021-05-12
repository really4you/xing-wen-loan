<?php
/**
 * Created by PhpStorm.
 * User: zys
 * Date: 2021/5/12
 * Time: 15:43
 */

namespace really4you\Xingwen\Api\Loan58;

class Config
{
    /**
     * @var
     */
    protected $config;

    /**
     * @var
     */
    protected static $instance;


    public function __construct($config = [])
    {
        $this->config = $config;
    }

    public static function getInstance($config = [])
    {
        if (!self::$instance) {
            self::$instance = new self($config);
        }

        return self::$instance;
    }

    public function getConfig()
    {
        return $this->config;
    }
}