<?php

declare(strict_types=1);

namespace Model\Repository;

use Model\Entity;

class User
{
    private $identityMap = [];

    private function addInIdentityMap(Entity\User $user): void
    {
        $key = $user->getLogin() . '_' . $user->getId();
        $this->identityMap[$key] = $user;
    }

    /**
     * @throws \Exception
     */
    private function getFromIdentityMapById(int $id): ?Entity\User
    {
        foreach ($this->identityMap as $key => $user) {
            $id = (int)$this->getPartKey($key, 'id');
            if ($user->getId() === $id) {
                return $user;
            }
        }

        return null;
    }

    /**
     * @throws \Exception
     */
    private function getFromIdentityMapByLogin(string $login): ?Entity\User
    {
        foreach ($this->identityMap as $key => $user) {
            $login = (int)$this->getPartKey($key, 'login');
            if ($user->getLogin() === $login) {
                return $user;
            }
        }

        return null;
    }

    /**
     * @throws \Exception
     */
    private function getPartKey(string $key, string $part): string
    {
        $arrayFromKey = explode("_", $key);

        switch ($part) {
            case "id":
                return $arrayFromKey[1];
            case "login":
                return $arrayFromKey[0];
            default:
                throw new \Exception(
                    "Incorrect $part"
                );
        }
    }

    /**
     * Получаем пользователя по идентификатору
     *
     * @param int $id
     * @return Entity\User|null
     * @throws \Exception
     */
    public function getById(int $id): ?Entity\User
    {
        $user = $this->getFromIdentityMapById($id);
        if ($user) {
            return $user;
        }

        foreach ($this->getDataFromSource(['id' => $id]) as $user) {
            $this->addInIdentityMap($user);
            return $this->createUser($user);
        }

        return null;
    }

    /**
     * Получаем пользователя по логину
     *
     * @param string $login
     * @return Entity\User
     * @throws \Exception
     */
    public function getByLogin(string $login): ?Entity\User
    {
        $user = $this->getFromIdentityMapByLogin($login);
        if ($user) {
            return $user;
        }

        foreach ($this->getDataFromSource(['login' => $login]) as $user) {
            if ($user['login'] === $login) {
                $this->addInIdentityMap($user);
                return $this->createUser($user);
            }
        }

        return null;
    }

    /**
     * Фабрика по созданию сущности пользователя
     *
     * @param array $user
     * @return Entity\User
     */
    private function createUser(array $user): Entity\User
    {
        $role = $user['role'];

        return new Entity\User(
            $user['id'],
            $user['name'],
            $user['login'],
            $user['password'],
            new Entity\Role($role['id'], $role['title'], $role['role'])
        );
    }

    /**
     * Получаем пользователей из источника данных
     *
     * @param array $search
     *
     * @return array
     */
    private function getDataFromSource(array $search = [])
    {
        $admin = ['id' => 1, 'title' => 'Super Admin', 'role' => 'admin'];
        $user = ['id' => 1, 'title' => 'Main user', 'role' => 'user'];
        $test = ['id' => 1, 'title' => 'For test needed', 'role' => 'test'];

        $dataSource = [
            [
                'id' => 1,
                'name' => 'Super Admin',
                'login' => 'root',
                'password' => '$2y$10$GnZbayyccTIDIT5nceez7u7z1u6K.znlEf9Jb19CLGK0NGbaorw8W', // 1234
                'role' => $admin
            ],
            [
                'id' => 2,
                'name' => 'Doe John',
                'login' => 'doejohn',
                'password' => '$2y$10$j4DX.lEvkVLVt6PoAXr6VuomG3YfnssrW0GA8808Dy5ydwND/n8DW', // qwerty
                'role' => $user
            ],
            [
                'id' => 3,
                'name' => 'Ivanov Ivan Ivanovich',
                'login' => 'i**extends',
                'password' => '$2y$10$TcQdU.qWG0s7XGeIqnhquOH/v3r2KKbes8bLIL6NFWpqfFn.cwWha', // PaSsWoRd
                'role' => $user
            ],
            [
                'id' => 4,
                'name' => 'Test Testov Testovich',
                'login' => 'testok',
                'password' => '$2y$10$vQvuFc6vQQyon0IawbmUN.3cPBXmuaZYsVww5csFRLvLCLPTiYwMa', // testss
                'role' => $test
            ],
        ];

        if (!count($search)) {
            return $dataSource;
        }

        $productFilter = function (array $dataSource) use ($search): bool {
            return (bool)array_intersect($dataSource, $search);
        };

        return array_filter($dataSource, $productFilter);
    }
}
