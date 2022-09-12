<?php

class PostgreSQLFactory extends AbstractFactory
{

    public function createRepository(): RepositoryInterface
    {
        return new PostgreSQLRepository();
    }

    public function createConnection(): ConnectionInterface
    {
        return new PostgreSQLConnection();
    }
}