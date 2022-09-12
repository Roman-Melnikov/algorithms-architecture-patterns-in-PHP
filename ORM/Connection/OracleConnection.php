<?php

class OracleConnection implements ConnectionInterface
{
    public function getConnection(): \PDO
    {
        return new PDO();
    }
}