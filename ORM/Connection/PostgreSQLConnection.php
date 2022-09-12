<?php

class PostgreSQLConnection implements ConnectionInterface
{
    public function getConnection(): \PDO
    {
        return new PDO();
    }
}