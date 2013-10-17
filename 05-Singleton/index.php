<?php

class ChocolateBoiler
{
    private $empty;
    private $boiled;
    private $uniqueInstance = null;

    private function __construct()
    {
        $this->empty = true;
        $this->boiled = false;
    }

    public static function getInstance()
    {
        if ($this->uniqueInstance === null) {
            $this->uniqueInstance = new ChocolateBoiler;
        }
        return $this->uniqueInstance;
    }

    public function fill()
    {
        if ($this->isEmpty()) {
            $this->empty = false;
            $this->boiled = false;
        }
    }

    public function drain()
    {
        if (!$this->isEmpty() && $this->isBoiled()) {
            $this->empty = true;
        }
    }

    public function boil()
    {
        if (!$this->isEmpty() && !$this->isBoiled()) {
            $this->boiled = true;
        }
    }

    public function isEmpty()
    {
        return $this->empty;
    }

    public function isBoiled()
    {
        return $this->boiled;
    }

}

?>