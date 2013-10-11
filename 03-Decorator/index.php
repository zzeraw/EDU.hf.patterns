<?php

/**
 * Абстрактный класс с двумя методами
 */
abstract class Beverage
{
    public $description = 'Unknown beverage';

    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Реализуем этот метод в наследниках
     */
    abstract public function cost();
}


/**
 * Объекты должны быть взаимозаменяемы с Beverage, поэтому расширяем класс Beverage
 */
abstract class CondimentDecorator extends Beverage
{
    /**
     * Также все декораторы должны заново реализовать метод getDescription()
     * PHP не позволяет абстрактному методу переопределять неабстрактный метод-предка.
     * Поэтому для нормальной работы я закомментирую эту строку.
     */
    // abstract public function getDescription();
}


/**
 * Все классы конкретных напитков расширяют класс Beverage
 */
class Espresso extends Beverage
{
    /**
     * Описание задается в конструкторе класса. Стоит напомнить, что переменная description наследуется от Beverage.
     */
    public function __construct()
    {
        $this->description = 'Espresso';
    }

    /**
     * Остается вычислить стоимость напитка. В этом классе беспокоиться о дополнениях не нужно, поэтому мы просто возвращаем стоимость "базового" эспрессо 1.99
     */
    public function cost()
    {
        return 1.99;
    }
}

/**
 * Домашняя смесь
 */
class HouseBlend extends Beverage
{
    public function __construct()
    {
        $this->description = 'House Blend';
    }

    public function cost()
    {
        return .89;
    }
}

/**
 * Темная обжарка
 */
class DarkRoast extends Beverage
{
    public function __construct()
    {
        $this->description = 'Dark Roast';
    }

    public function cost()
    {
        return .99;
    }
}

/**
 * Без кофеина
 */
class Decaf extends Beverage
{
    public function __construct()
    {
        $this->description = 'Decaf';
    }

    public function cost()
    {
        return 1.05;
    }
}



/**
 * Декоратор "Шоколад""
 */
class Mocha extends CondimentDecorator
{
    /**
     * Ссылка на Beverage
     */
    public $beverage;

    public function __construct(Beverage $beverage)
    {
        $this->beverage = $beverage;
    }

    /**
     * В описании должны содержаться не только название напитка, но и все дополнения. Таким образом мы сначала получаем описание, делегируя вызов декорируемому объекту, а затем присоединяем к нему строку "Mocha".
     */
    public function getDescription()
    {
        return $this->beverage->getDescription() . ', Mocha';
    }

    /**
     * Теперь необходимо вычислить стоимость напитка с шоколадом. Сначала вызов делегируется декорируемому объекту, а затем стоимость шоколада прибавляется к результату.
     */
    public function cost()
    {
        return .20 + $this->beverage->cost();
    }
}

/**
 * Декоратор "Соя""
 */
class Soy extends CondimentDecorator
{
    public $beverage;

    public function __construct(Beverage $beverage)
    {
        $this->beverage = $beverage;
    }

    public function getDescription()
    {
        return $this->beverage->getDescription() . ', Soy';
    }

    public function cost()
    {
        return .15 + $this->beverage->cost();
    }
}

/**
 * Декоратор "Взбитые сливки""
 */
class Whip extends CondimentDecorator
{
    public $beverage;

    public function __construct(Beverage $beverage)
    {
        $this->beverage = $beverage;
    }

    public function getDescription()
    {
        return $this->beverage->getDescription() . ', Whip';
    }

    public function cost()
    {
        return .10 + $this->beverage->cost();
    }
}






class StarbuzzCoffee
{
    public static function main()
    {
        $beverage = new Espresso();
        echo '<div>';
            echo $beverage->getDescription() . ' $' . $beverage->cost();
        echo '</div>';

        $beverage2 = new DarkRoast;
        $beverage2 = new Mocha($beverage2);
        $beverage2 = new Mocha($beverage2);
        $beverage2 = new Whip($beverage2);
        echo '<div>';
            echo $beverage2->getDescription() . ' $' . $beverage2->cost();
        echo '</div>';

        $beverage3 = new HouseBlend();
        $beverage3 = new Soy($beverage3);
        $beverage3 = new Mocha($beverage3);
        $beverage3 = new Whip($beverage3);
        echo '<div>';
            echo $beverage3->getDescription() . ' $' . $beverage3->cost();
        echo '</div>';

    }
}

StarbuzzCoffee::main();

?>
