<?php


abstract class PizzaStore
{
    public final function orderPizza($type)
    {
        // Вызов оператора new заменяется вызовом метода create объекта фабрики. Никаких созданий экземпляров конкретного типа.
        $pizza = $this->createPizza($type);

        $pizza->prepare();
        $pizza->bake();
        $pizza->cut();
        $pizza->box();

        return $pizza;
    }

    /**
     * Фабричный метод стал абстрактным методом PizzaStore.
     */
    protected abstract function createPizza($type);
}


/**
 * Класс расширяет PizzaStore, поэтому он наследует метод orderPizza(), который понятия не имеет какой из типов пиццы мы создаем. Он знает лишь то, что пиццу можно приготовить, выпечь, нарезать и упаковать.
 */
class NYPizzaStore extends PizzaStore
{
    /**
     * Возвращает объект Pizza, а субкласс несет полную ответственность за создаваемый конкретный экземпляр Pizza.
     */
    public function createPizza($type)
    {
        if ($type == 'cheese') {
            return new NYStyleCheesePizza();
        } elseif ($type == 'pepperoni') {
            return new NYStylePepperoniPizza();
        } elseif ($type == 'clam') {
            return new NYStyleClamPizza();
        } elseif ($type == 'veggie') {
            return new NYStyleVeggiePizza();
        } else {
            return null;
        }
    }
}

/**
 * Пицца в стиле Чикаго
 */
class ChicagoPizzaStore extends PizzaStore
{
    /**
     * Возвращает объект Pizza, а субкласс несет полную ответственность за создаваемый конкретный экземпляр Pizza.
     */
    public function createPizza($type)
    {
        if ($type == 'cheese') {
            return new ChicagoStyleCheesePizza();
        } elseif ($type == 'pepperoni') {
            return new ChicagoStylePepperoniPizza();
        } elseif ($type == 'clam') {
            return new ChicagoStyleClamPizza();
        } elseif ($type == 'veggie') {
            return new ChicagoStyleVeggiePizza();
        } else {
            return null;
        }
    }
}

/**
 * Пицца в калифорнийском стиле
 */
class CAPizzaStore extends PizzaStore
{
    /**
     * Возвращает объект Pizza, а субкласс несет полную ответственность за создаваемый конкретный экземпляр Pizza.
     */
    public function createPizza($type)
    {
        if ($type == 'cheese') {
            $pizza = new CAStyleCheesePizza();
        } elseif ($type == 'pepperoni') {
            $pizza = new CAStylePepperoniPizza();
        } elseif ($type == 'clam') {
            $pizza = new CAStyleClamPizza();
        } elseif ($type == 'veggie') {
            $pizza = new CAStyleVeggiePizza();
        } else {
            return null;
        }
    }
}

/**
 * Суперкласс для конкретных классов пиццы
 */
abstract class Pizza
{
    public $name; // название
    public $dough; // основа
    public $sauce; // соус
    public $topping = array(); // добавки

    public function prepare()
    {
        echo '<div>Preparing ' . $this->name . '</div>';
        echo '<div>Tossing dough...</div>';
        echo '<div>Adding sauce...</div>';
        echo '<div>Adding toppings: </div>';
        foreach ($this->toppings as $topping) {
            echo ' ' . $topping;
        }
    }

    public function bake()
    {
        echo '<div>Bake for 25 vinutes at 350</div>';
    }

    public function cut()
    {
        echo '<div>Cutting pizza into diagonal slices</div>';
    }

    public function box()
    {
        echo '<div>Place pizza in official PizzaStore box</div>';
    }

    public function getName()
    {
        return $this->name;
    }
}

/**
 * Нью-Йоркская пицца
 */
class NYStyleCheesePizza extends Pizza
{
    function __construct()
    {
        $this->name       = 'NY Style Sauce and Cheese Pizza';
        $this->dough      = 'Thin Crust Dough';
        $this->sauce      = 'Marinara Sauce';
        $this->toppings[] = 'Grated Reggiano Cheese';
    }
}

/**
 * Чикагская пицца
 */
class ChicagoStyleCheesePizza extends Pizza
{
    function __construct()
    {
        $this->name       = 'Chicago Style Deep Dish Cheese Pizza';
        $this->dough      = 'Extra Trick Crust Dough';
        $this->sauce      = 'Plum Tomato Sauce';
        $this->toppings[] = 'Shredded Mozzarella Cheese';
    }

    /**
     * Переопределяем метод cut() так как чикагская пицца нарезается квадратами.
     * @return [type] [description]
     */
    public function cut()
    {
        echo '<div>Cutting pizza into square slices</div>';
    }
}


class PizzaTestDrive
{
    public static function main()
    {
        $nyStore      = new NYPizzaStore();
        $chicagoStore = new ChicagoPizzaStore();

        $pizza = $nyStore->orderPizza('cheese');
        echo '<div>Ethan ordered a ' . $pizza->getName() . '</div>';

        echo '<hr/>';

        $pizza = $chicagoStore->orderPizza('cheese');
        echo '<div>Joel ordered a ' . $pizza->getName() . '</div>';
    }
}

PizzaTestDrive::main();
