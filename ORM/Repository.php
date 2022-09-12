<?php

class Application
{
    public function createRepository(AbstractFactory $abstractFactory)
    {
        $connection = $abstractFactory->createConnection();
        $repository = $abstractFactory->createRepository($connection);
    }
}