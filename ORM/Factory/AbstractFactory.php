<?php

abstract class AbstractFactory
{
    abstract public function createRepository(): RepositoryInterface;
    abstract public function createConnection(): ConnectionInterface;
}