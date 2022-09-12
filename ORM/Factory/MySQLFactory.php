<?php

class MySQLFactory extends AbstractFactory
{

    public function createRepository(): RepositoryInterface
    {
        return new MySQLRepository();
    }

    public function createConnection(): ConnectionInterface
    {
        return new MySQLConnection();
    }
}