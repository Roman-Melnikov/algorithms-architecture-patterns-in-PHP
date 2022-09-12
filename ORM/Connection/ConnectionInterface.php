<?php

interface ConnectionInterface
{
    public function getConnection(): \PDO;
}