<?php

abstract class Duck {
    public $flyBehavior; // свойство типа FlyBehavior, ссылка на класс
    public $quackBehavior; // свойство типа QuackBehavior, ссылка на класс

    function __construct() {

    }

    public abstract function display();

    public function performFly() {
        $this->flyBehavior->fly();
    }

    public function performQuack() {
        $this->quackBehavior->quack();
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
        $this->quackBehavior  = new Quack();
        $this->flyBehavior    = new FlyWithWings();
    }

    public function display() {
        echo "<div>I'm a real Mallard Duck!</div>";
    }
}
class ModelDuck extends Duck {
    function __construct() {
        $this->quackBehavior  = new Quack();
        $this->flyBehavior    = new FlyNoWay();
    }

    public function display() {
        echo "<div>I'm a model duck!</div>";
    }
}

interface FlyBehavior {
    public function fly();
}
class FlyWithWings implements FlyBehavior {
    public function fly() {
        echo "<div>I'm flying!</div>";
    }
}
class FlyNoWay implements FlyBehavior {
    public function fly() {
        echo "<div>I can't fly!</div>";
    }
}
class FlyRockedPowered implements FlyBehavior {
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
        $mallard->performQuack();
        $mallard->performFly();

        $model = new ModelDuck();
        $model->performFly();
        $model->setFlyBehavior(new FlyRockedPowered);
        $model->performFly();
    }
}

MiniDucksSimulator::main();


?>