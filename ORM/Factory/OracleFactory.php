<?php

class OracleFactory extends AbstractFactory
{

    public function createRepository(): RepositoryInterface
    {
        return new OracleRepository();
    }

    public function createConnection(): ConnectionInterface
    {
        return new OracleConnection();
    }
}