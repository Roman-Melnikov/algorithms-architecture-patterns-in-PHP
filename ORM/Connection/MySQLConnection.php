<?php

class MySQLConnection implements ConnectionInterface
{
    public function getConnection(): \PDO
    {
        return new PDO();
    }
}