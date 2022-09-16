<?php

class SquareAreaLib
{
    public function getSquareArea(int $diagonal)
    {
        $area = ($diagonal ** 2) / 2;
        return $area;
    }
}

class CircleAreaLib
{
    public function getCircleArea(int $diagonal)
    {
        $area = (M_PI * $diagonal ** 2) / 4;
        return $area;
    }
}

interface SquareInterface
{
    public function squareArea(int $sideSquare): float;
}

interface CircleInterface
{
    public function circleArea(int $circumference): float;
}

class SquareAreaLibAdapter implements SquareInterface
{

    public function __construct(
        private SquareAreaLib $squareAreaLib
    )
    {
    }

    public function squareArea(int $sideSquare): float
    {
        $diagonal = $sideSquare * sqrt(2);
        return $this->squareAreaLib->getSquareArea((int)$diagonal);
    }
}

class CircleAreaLibAdapter implements CircleInterface
{

    public function __construct(
        private CircleAreaLib $circleAreaLib
    )
    {
    }

    public function circleArea(int $circumference): float
    {
        $diagonal = $circumference / M_PI;
        return $this->circleAreaLib->getCircleArea((int)$diagonal);
    }
}
