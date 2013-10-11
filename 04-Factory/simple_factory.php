<?php

/**
 * Класс занимается исключительно созданием пиццы для своих клиентов.
 */
class SimplePizzaFactory
{
    /**
     * В фабрике определяется метод createPizza(), который будет использоваться всеми клиентами для создания новых объектов.
     */
    public function createPizza($type)
    {
        $pizza = null;

        if ($type == 'cheese') {
            $pizza = new CheesePizza();
        } elseif ($type == 'pepperoni') {
            $pizza = new PepperoniPizza();
        } elseif ($type == 'clam') {
            $pizza = new ClamPizza();
        } elseif ($type == 'veggie') {
            $pizza = new VeggiePizza();
        }

        return $pizza;
    }
}



class PizzaStore
{
    /**
     * Классу PizzaStore передается ссылка SimplePizzaFactory
     * @var SimplePizzaFactory
     */
    public $factory;

    function __construct(SimplePizzaFactory $factory)
    {
        $this->factory = $factory;
    }

    public function orderPizza($type)
    {
        // Вызов оператора new заменяется вызовом метода create объекта фабрики. Никаких созданий экземпляров конкретного типа.
        $pizza = $this->factory->createPizza($type);

        $pizza->prepare();
        $pizza->bake();
        $pizza->cut();
        $pizza->box();

        return $pizza;
    }
}
