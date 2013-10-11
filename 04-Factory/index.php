<?php

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

