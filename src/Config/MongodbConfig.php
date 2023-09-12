<?php


namespace Yizuan\MongodbPool\Config;


use EasySwoole\Spl\SplBean;

class MongodbConfig extends SplBean
{

    protected $host = '127.0.0.1';
    protected $port = 27017;
    protected $db = 'default';
    protected $username = '';
    protected $password = '';



    /**
     * @return mixed
     */
    public function getHost()
    {
        return $this->host;
    }

    /**
     * @param mixed $host
     */
    public function setHost($host): void
    {
        $this->host = $host;
    }

    /**
     * @return int
     */
    public function getPort(): int
    {
        return $this->port;
    }

    /**
     * @param int $port
     */
    public function setPort(int $port): void
    {
        $this->port = $port;
    }

    /**
     * @return String
     */
    public function getDb(): String
    {
        return $this->db;
    }

    /**
     * @param String $db
     */
    public function setDb(String $db): void
    {
        $this->db = $db;
    }

    /**
     * @return String
     */
    public function getUsername(): String
    {
        return $this->username;
    }

    /**
     * @param String $username
     */
    public function setUsername(String $username): void
    {
        $this->username = $username;
    }

    /**
     * @return String
     */
    public function getPassword(): String
    {
        return $this->password;
    }

    /**
     * @param String $password
     */
    public function setPassword(String $password): void
    {
        $this->password = $password;
    }

}
