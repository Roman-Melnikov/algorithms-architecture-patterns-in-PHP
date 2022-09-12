<?php

class OracleRepository implements RepositoryInterface
{
    public function __construct(
        private \PDO $pdo
    )
    {
    }

    public function get(int $id): Entity
    {
        $entity = 'some Entity';
        return $entity;
    }

    public function save(Entity $entity): void
    {

    }
}