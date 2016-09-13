<?php

class GetRedis {

    protected static $_instance;

    public function __construct() {
        // $this->_redis = self::getInstance();
    }

    public static function getInstance() {
        if (NULL == self::$_instance) {
            $redis = new Redis();
            $redis->connect('127.0.0.1', 6379);
            return self::$_instance = $redis;
        }
        return self::$_instance;
    }

}
