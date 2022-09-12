<?php

class Repository
{
    public function createRepository(AbstractFactory $abstractFactory): RepositoryInterface
    {
        $connection = $abstractFactory->createConnection();
        return $abstractFactory->createRepository($connection);
    }
}