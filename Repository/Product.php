<?php

declare(strict_types=1);

namespace Model\Repository;

use Model\Entity;

class Product
{
    private $identityMap = [];

    private function addInIdentityMap(Entity\Product $product): void
    {
        $key = $product->getId();
        $this->identityMap[$key] = $product;
    }

    private function getForIdentityMap(array $ids = []): array
    {
        $identityMapFilter = function (Entity\Product $product) use ($ids) {
            return in_array($product->getId(), $ids);
        };
        return array_filter($this->identityMap, $identityMapFilter);
    }

    private function getIdsWhichNotList(array $ids, array $list): array
    {
        $idsFilter = function (string $id) use ($list) {
            return array_key_exists($id, $list);
        };
        return array_filter($ids, $idsFilter);
    }

    /**
     * Поиск продуктов по массиву id
     *
     * @param int[] $ids
     * @return Entity\Product[]
     */
    public function search(array $ids = []): array
    {
        if (!count($ids)) {
            return [];
        }

        $productListFromIdentityMap = $this->getForIdentityMap($ids);

        $ids = $this->getIdsWhichNotList($ids, $productListFromIdentityMap);

        $productListFromSourse = [];
        foreach ($this->getDataFromSource(['id' => $ids]) as $item) {
            $product = new Entity\Product($item['id'], $item['name'], $item['price']);

            $this->addInIdentityMap($product);
            $productListFromSourse[] = $product;
        }

        return array_merge($productListFromIdentityMap, $productListFromSourse);
    }

    /**
     * Получаем все продукты
     *
     * @return Entity\Product[]
     */
    public function fetchAll(): array
    {
        $productList = [];
        foreach ($this->getDataFromSource() as $item) {
            $productList[] = new Entity\Product($item['id'], $item['name'], $item['price']);
        }

        return $productList;
    }

    /**
     * Получаем продукты из источника данных
     *
     * @param array $search
     *
     * @return array
     */
    private function getDataFromSource(array $search = [])
    {
        $dataSource = [
            [
                'id' => 1,
                'name' => 'PHP',
                'price' => 15300,
            ],
            [
                'id' => 2,
                'name' => 'Python',
                'price' => 20400,
            ],
            [
                'id' => 3,
                'name' => 'C#',
                'price' => 30100,
            ],
            [
                'id' => 4,
                'name' => 'Java',
                'price' => 30600,
            ],
            [
                'id' => 5,
                'name' => 'Ruby',
                'price' => 18600,
            ],
            [
                'id' => 8,
                'name' => 'Delphi',
                'price' => 8400,
            ],
            [
                'id' => 9,
                'name' => 'C++',
                'price' => 19300,
            ],
            [
                'id' => 10,
                'name' => 'C',
                'price' => 12800,
            ],
            [
                'id' => 11,
                'name' => 'Lua',
                'price' => 5000,
            ],
        ];

        if (!count($search)) {
            return $dataSource;
        }

        $productFilter = function (array $dataSource) use ($search): bool {
            return in_array($dataSource[key($search)], current($search), true);
        };

        return array_filter($dataSource, $productFilter);
    }
}
