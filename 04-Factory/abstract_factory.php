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

interface PizzaIngredientFactory
{
    // для каждого ингредиента в интерфейсе определяется метод create.
    public function createDough();
    public function createSauce();
    public function createCheese();
    public function createVeggies();
    public function createPepperoni();
    public function createCalm();
}

/**
 * Нью-йоркская фабрика ингредиентов реализует общий интерфейс всех фабрик ингредиентов.
 */
class NYPizzaIngredientFactory implements PizzaIngredientFactory
{
    /**
     * Каждый ингредиент - продукт, производимый Фабричным Методом в Абстрактной Фабрике.
     */

    public function createDough()
    {
        return new ThinCrustDough;
    }

    public function createSauce()
    {
        return new MarinaraSauce;
    }

    public function createCheese()
    {
        return new ReggianoCheese;
    }

    public function createVeggies()
    {
        return array(new Garlic, new Onion, new Mushroom, new RedPepper);
    }

    public function createPepperoni()
    {
        return new SlicedPepperoni;
    }

    public function createCalm()
    {
        return new FreshClams;
    }
}


class ChicagoPizzaIngredientFactory implements PizzaIngredientFactory
{
    public function createDough()
    {
        return new ThickCrustDough;
    }

    public function createSauce()
    {
        return new PlumTomatoSauce;
    }

    public function createCheese()
    {
        return new Mozzarella;
    }

    public function createVeggies()
    {
        return array(new EggPlant, new Spinach, new BlackOlives);
    }

    public function createPepperoni()
    {
        return new SlicedPepperoni;
    }

    public function createCalm()
    {
        return new FrozenClams;
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
    public $veggies = array();
    public $cheese;
    public $pepperoni;
    public $calm;

    public abstract function prepare();

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

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }
}


class CheesePizza extends Pizza
{
    public $ingredientFactory;

    /**
     * В ходе приготовления пиццы нам понадобится фабрика, поставляющая ингредиенты. Соответственно, конструктору каждого класса пиццы передается объект фабрики, ссылка на который сохраняется в переменной экземпляра.
     */
    function __construct($ingredientFactory)
    {
        $this->ingredientFactory = $ingredientFactory;
    }

    /**
     * Метод prepare готовит пиццу с сыром. Когда ему требуется очередной ингредиент, он запрашивает его у фабрики.
     */
    public function prepare()
    {
        echo '<div>Preparing' . $this->name . '</div>';
        $this->dough = $this->ingredientFactory->createDough();
        $this->sauce = $this->ingredientFactory->createSauce();
        $this->cheese = $this->ingredientFactory->createCheese();
    }
}

class ClamPizza extends Pizza
{
    public $ingredientFactory;

    /**
     * ClamPizza тоже сохраняет фабрику ингредиентов.
     */
    function __construct($ingredientFactory)
    {
        $this->ingredientFactory = $ingredientFactory;
    }

    /**
     * Чтобы создать пиццу с мидиями, метод prepare получает ингредиенты от локальной фабрики.
     * @return [type] [description]
     */
    public function prepare()
    {
        echo '<div>Preparing' . $this->name . '</div>';
        $this->dough = $this->ingredientFactory->createDough();
        $this->sauce = $this->ingredientFactory->createSauce();
        $this->cheese = $this->ingredientFactory->createCheese();
        $this->clam = $this->ingredientFactory->createClam(); // Если это нью-йоркская фабрика, то мидии будут свежие, а если чикагская - мороженые.
    }
}


/**
 * Классы пиццерий должны использовать правилные объекты Pizza. И им необходимо передать ссылку на региональную фабрику ингредиентов.
 */
class NYPizzaStore extends PizzaStore
{
    protected function createPizza($item)
    {
        $pizza = null;

        /* Фабрика производит ингредиенты для всех пицц в нью-йоркском стиле */
        $ingredientFactory = new NYPizzaIngredientFactory();

        /* Теперь при создании каждой пиццы задается фабрика, которая должна использоваться для производства ее ингредиентов. */
        if ($item === 'cheese') {
            $pizza = new CheesePizza($ingredientFactory);
            $pizza->setName('New York Style Cheese Pizza');
        } elseif ($item === 'veggie') {
            $pizza = new VeggiePizza($ingredientFactory);
            $pizza->setName('New York Style Veggie Pizza');
        } elseif ($item === 'clam') {
            $pizza = new ClamPizza($ingredientFactory);
            $pizza->setName('New York Style Clam Pizza');
        } elseif ($item === 'pepperoni') {
            $pizza = new PepperoniPizza($ingredientFactory);
            $pizza->setName('New York Style Pepperoni Pizza');
        }
        return $pizza;
    }
}


class PizzaTestDrive
{
    public static function main()
    {
        $nyStore      = new NYPizzaStore();
        // $chicagoStore = new ChicagoPizzaStore();

        $pizza = $nyStore->orderPizza('cheese');
        echo '<div>Ethan ordered a ' . $pizza->getName() . '</div>';

        echo '<hr/>';

        // $pizza = $chicagoStore->orderPizza('cheese');
        // echo '<div>Joel ordered a ' . $pizza->getName() . '</div>';
    }
}

PizzaTestDrive::main();


