<?php
/**
 * Created by PhpStorm.
 * User: Tioncico
 * Date: 2019/10/15 0015
 * Time: 14:46
 */

namespace  Yizuan\MongodbPool;

use MongoDB\Client;
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
            $option="";
            if(!empty($mongodbConfig->getUsername()) || !empty($mongodbConfig->getPassword())){
                $option['username']=$mongodbConfig->getUsername();
                $option['password']=$mongodbConfig->getPassword();
                $option["authSource"]=$mongodbConfig->getDb();
            }

            $host="{$mongodbConfig->getHost()}:{$mongodbConfig->getPort()}";

            $mongodb = new Client("mongodb://{$host}",$option);
            return $mongodb;
        },new PoolConfig());
    }


}