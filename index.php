<?php

class getCache {

    private $tag = array(
        'set' => 'set',
        'get' => 'get',
        'getx' => 'get',
    );

    public function __construct() {
        include 'Driver/GetRedis.php';
        $redis = new GetRedis();
        $this->_redis = $redis->getInstance();
    }

    public function set($key, $value, $time = false) {
        if (!$time) {
            return $this->_redis->set($key, $value);
        } else {
            return $this->_redis->setex($key, $time, $value);
        }
    }

    public function get($key, $json_decode = true) {
        $result = $this->_redis->get($key);
        if ($json_decode) {
            $result = json_decode($result, true);
        }
        return $result;
    }

    public function __call($name, $arguments) {
        if (array_key_exists($name, $this->tag)) {
            return call_user_func_array(array($this->_redis, $this->tag[$name]), $arguments);
        } else {
            throw new \Exception('no method');
        }
    }

}

$redis = new getCache();
$a = ['1', '2'];
$a = $redis->set('hehe', json_encode($a));
$a = $redis->get('hehe', false);
$a = $redis->getx('hehe');
$a = $redis->getxx('hehe');
var_dump($a);
