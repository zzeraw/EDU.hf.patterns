<?php

abstract class CaffeineBeverage
{
    /**
     * Теперь для приготовления чая и кофе будет использоваться один метод - prepareRecipe(). Этот метод объявлен ключевым словом final, потому что суперклассы не должны переопределять этот метод!
     * Это шаблонный метод.
     * @return [type] [description]
     */
    public final function prepareRecipe()
    {
        $this->boilWater();
        $this->brew();
        $this->pourInCup();
        $this->addCondiments();
    }

    /**
     * Так как классы Coffee и Tea реализуют эти методы по-разному, мы объявляем их абстрактными. Субклассы должны предоставить реализацию.
     * @return [type] [description]
     */
    abstract public function brew();
    abstract public function addCondiments();

    public function boilWater()
    {
        echo 'Boiling water <br/>';
    }

    public function pourInCup()
    {
        echo 'Pouring into cup <br/>';
    }
}

class Tea extends CaffeineBeverage
{
    public function brew()
    {
        echo 'Steeping the tea <br/>';
    }

    public function addCondiments()
    {
        echo 'Adding lemon <br/>';
    }
}

class Coffee extends CaffeineBeverage
{
    public function brew()
    {
        echo 'Dripping coffee through filter <br/>';
    }

    public function addCondiments()
    {
        echo 'Adding sugar and milk <br/>';
    }
}

$myTea = new Tea;
$myTea->prepareRecipe();

?>