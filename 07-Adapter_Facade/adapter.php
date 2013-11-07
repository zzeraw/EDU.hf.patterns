<?php

/**
 * Интерфейс "Утка"
 */
interface Duck
{
    public function fly();
    public function quack();
}

class MallardDuck implements Duck
{
    public function fly()
    {
        echo 'I am flying!<br/>';
    }

    public function quack()
    {
        echo 'Quack!<br/>';
    }
}

/**
 * Интерфейс "Индюшка"
 */
interface Turkey
{
    /**
     * Индюшка не крякает
     */
    public function gobble();

    /**
     * И летает немного короче, чем утка
     */
    public function fly();
}

class WildTurkey implements Turkey
{
    public function gobble()
    {
        echo 'Gobble gobble!<br/>';
    }

    public function fly()
    {
        echo 'I am flying a short distance!<br/>';
    }
}


/**
 * В Адаптере реализуем интерфейс того типа, на который расчитан ваш клиент.
 */
class TurkeyAdapter implements Duck
{
    public $turkey;

    /**
     * Затем получаем ссылку на адаптируемый объект. Обычно это делается в конструкторе.
     */
    function __construct(Turkey $turkey)
    {
        $this->turkey = $turkey;
    }

    /**
     * Адаптер должен реализовывать все методы интерфейса. Преобразование quack() между классами выполняется просто - реализация вызывает gobble().
     * @return [type] [description]
     */
    public function quack()
    {
        $this->turkey->gobble();
    }

    /**
     * Хотя метод fly() входит в оба интерфейса, индюшка не умеет летать на дальние расстояния. Чтобы установить соответствие между этими методами, мы вызываем метод fly() класса Turkey пять раз.
     */
    public function fly()
    {
        for ($i = 0; $i < 5; $i++) {
            $this->turkey->fly();
        }
    }
}

class DuckAdapter implements Turkey
{
    public $duck;

    function __construct(Duck $duck)
    {
        $this->duck = $duck;
    }

    public function gobble()
    {
        $this->duck->quack();
    }

    public function fly()
    {
        if (rand(0, 5) == 0) {
            $this->duck->fly();
        }
    }
}

/**
 * Тестовый код адаптера
 */
class DuckTestDrive
{
    public static function main()
    {
        $duck          = new MallardDuck;
        $turkey        = new WildTurkey;

        $turkeyAdapter = new TurkeyAdapter($turkey);
        $duckAdapter   = new DuckAdapter($duck);

        echo 'The turkey says: ';
        $turkey->gobble();
        $turkey->fly();

        echo 'The duck says: ';
        self::testDuck($duck);

        echo 'The TurkeyAdapter says: ';
        self::testDuck($turkeyAdapter);

        echo 'The DuckAdapter says: ';
        self::testTurkey($duckAdapter);
    }

    public static function testDuck(Duck $duck)
    {
        $duck->quack();
        $duck->fly();
    }

    public static function testTurkey(Turkey $turkey)
    {
        $turkey->gobble();
        $turkey->fly();
    }


}

DuckTestDrive::main();
