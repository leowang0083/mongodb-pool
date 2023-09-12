<?php
/**
 * Created by PhpStorm.
 * User: Tioncico
 * Date: 2019/10/15 0015
 * Time: 14:46
 */

namespace  Yizuan\MongodbPool;

use Yizuan\MongodbPool\Config\MongodbConfig;
use EasySwoole\Pool\MagicPool;


class Pool extends MagicPool
{
    function __construct(MongodbConfig $mongodbConfig,?string $cask = null)
    {
        parent::__construct(function ()use($mongodbConfig,$cask){
            if($cask){
                return new $cask($mongodbConfig);
            }
            $auth="";
            if(!empty($mongodbConfig->getUsername()) || !empty($mongodbConfig->getPassword())){$auth="{$mongodbConfig->getUsername()}:{$mongodbConfig->getPassword()}@";}

            $host="{$mongodbConfig->getHost()}:{$mongodbConfig->getPort()}";

            $mongodb = new \MongoClient("mongodb://{$auth}{$host}");
            $db=$mongodbConfig->getDb();
            $db=$mongodb->$db;

            return $db;
        },new PoolConfig());
    }


}