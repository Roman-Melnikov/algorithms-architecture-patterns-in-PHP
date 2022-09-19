<?php

interface PayStrategy
{
    public function pay(float $amount);
}

class PayByQiwi implements PayStrategy
{
    public function pay(float $amount)
    {
        echo 'Оплачиваем через платёжную систему Qiwi';
    }
}

class PayByYandex implements PayStrategy
{
    public function pay(float $amount)
    {
        echo 'Оплачиваем через платёжную систему Yandex';
    }
}

class PayByWebMoney implements PayStrategy
{
    public function pay(float $amount)
    {
        echo 'Оплачиваем через платёжную систему WebMoney';
    }
}

class ShoppingCart
{
    private float $amount = 0;

    /**
     * @return float
     */
    public function getAmount(): float
    {
        return $this->amount;
    }

    /**
     * @param float $amount
     */
    public function setAmount(float $amount): void
    {
        $this->amount = $amount;
    }

    public function payAmount(payStrategy $payStrategy)
    {
        $payStrategy->pay($this->amount);
    }
}

$shoppingCart = new ShoppingCart();
$shoppingCart->setAmount(100, 00);
$shoppingCart->payAmount(
    new PayByWebMoney()
);
