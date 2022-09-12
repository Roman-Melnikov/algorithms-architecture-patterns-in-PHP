<?php

interface RepositoryInterface
{
    public function get(int $id): Entity;

    public function save(Entity $entity): void;
}