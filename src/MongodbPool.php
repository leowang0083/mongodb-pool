<?php

namespace Yizuan\MongodbPool;

use EasySwoole\Component\Singleton;
use MongoDB\Client;
use Yizuan\MongodbPool\Config\MongodbConfig;
use EasySwoole\Pool\Config as PoolConfig;
use Yizuan\MongodbPool\Exception\Exception;

class MongodbPool
{
    use Singleton;

    protected $container = [];

    function register(MongodbConfig $config, string $name ='default', ?string $cask = null): PoolConfig
    {
        if(isset($this->container[$name])){
            //已经注册，则抛出异常
            throw new MongodbPoolException("mongodb pool:{$name} is already been register");
        }
        if($cask){
            $ref = new \ReflectionClass($cask);
            if((!$ref->isSubclassOf(Client::class))){
                throw new Exception("cask {$cask} not a sub class of MongoDB\Client");
            }
        }
        $pool = new Pool($config,$cask);
        $this->container[$name] = $pool;
        return $pool->getConfig();
    }

    function getPool(string $name ='default'): ?Pool
    {
        if (isset($this->container[$name])) {
            return $this->container[$name];
        }
        return null;
    }

    static function defer(string $name ='default',$timeout = null):?Client
    {
        $pool = static::getInstance()->getPool($name);
        if($pool){
            return $pool->defer($timeout);
        }else{
            return null;
        }
    }

    static function invoke(callable $call,string $name ='default',float $timeout = null)
    {
        $pool = static::getInstance()->getPool($name);
        if($pool){
            return $pool->invoke($call,$timeout);
        }else{
            return null;
        }
    }
}