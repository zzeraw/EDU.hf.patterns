<?php

abstract class Duck {
    public $flyBehavior; // каждый объект Duck содержит ссылку на реализацию интерфейса FlyBehavior
    public $quackBehavior; // каждый объект Duck содержит ссылку на реализацию интерфейса QuackBehavior

    function __construct() {

    }

    public abstract function display();

    public function performFly() {
        $this->flyBehavior->fly(); // объект Duck делегирует ПОВЕДЕНИЕ объекту, на который ссылается flyBehavior.
    }

    public function performQuack() {
        $this->quackBehavior->quack(); // объект Duck делегирует ПОВЕДЕНИЕ объекту, на который ссылается quackBehavior.
    }

    public function swim() {
        echo "<div>All ducks float, even decoys!</div>";
    }
    // -------------------------
    public function setFlyBehavior(FlyBehavior $fb) {
        $this->flyBehavior = $fb;
    }
    public function setQuackBehavior(QuackBehavior $qb) {
        $this->quackBehavior = $qb;
    }
}

class MallardDuck extends Duck {

    function __construct() {
        $this->quackBehavior  = new Quack(); // MallardDuck использует класс Quack для выполнения действия, так что при вызове performQuack() отвественность за выполнение возлагается на объект Quack.
        $this->flyBehavior    = new FlyWithWings(); // А в качестве реализации FlyBehavior используется тип FlyWithWings.
    }

    public function display() {
        echo "<div>I'm a real Mallard Duck!</div>";
    }
}

class ModelDuck extends Duck {
    function __construct() {
        $this->quackBehavior  = new Quack();
        $this->flyBehavior    = new FlyNoWay(); // утка-приманка изначально не умеет летать
    }

    public function display() {
        echo "<div>I'm a model duck!</div>";
    }
}

// интерфейс реализуется всеми классами
interface FlyBehavior {
    public function fly();
}

class FlyWithWings implements FlyBehavior {
    // Реализация поведения для уток, которые УМЕЮТ летать
    public function fly() {
        echo "<div>I'm flying!</div>";
    }
}

class FlyNoWay implements FlyBehavior {
    // Реализация поведения для утрок, которые НЕ ЛЕТАЮТ (например, резиновых)
    public function fly() {
        echo "<div>I can't fly!</div>";
    }
}

class FlyRockedPowered implements FlyBehavior {
    // определяем новое поведение - реактивный полет
    public function fly() {
        echo "<div>I'm flying with a rocked!</div>";
    }
}

interface quackBehavior {
    public function quack();
}
class Quack implements quackBehavior{
    public function quack() {
        echo "<div>Quack!</div>";
    }
}
class MuteQuack implements quackBehavior{
    public function quack() {
        echo "<div><<Silence>></div>";
    }
}
class Squeak implements quackBehavior{
    public function quack() {
        echo "<div>Squeak!</div>";
    }
}

class MiniDucksSimulator {
    public static function main($args = NULL) {
        $mallard = new MallardDuck();
        $mallard->performQuack(); // вызов метода performQuack(), унаследованного классом MallardDuck; метод делегирует выполнение операции по ссылке на QuackBehavior (то есть вызывает quack() через унаследованную переменную quackBehavior() ).
        $mallard->performFly(); // затем то же самое происходит с методом performFly(), также унаследованным классов MallardDuck.

        $model = new ModelDuck();
        $model->performFly(); // первый вызов performFly() передается реализации, заданной в конструкторе ModelDuck - то есть экземпляру FlyNoWay.
        $model->setFlyBehavior(new FlyRockedPowered); // Вызываем set-метод, унаследованный классом ModelDuck, и... утка-приманка вдруг взлетает на реактивном двигателе
        $model->performFly(); // способность утки-приманки к полету переключается динамически! Если бы реализация находилась в иерархии  Duck, такое было бы невозможно.
    }
}

MiniDucksSimulator::main();


?>