<?php

/**
 * Интерфейс "Команда"
 */
interface Command
{
    /**
     * Единственный метод
     */
    public function execute();
}

class Light
{
    public function on()
    {
        echo '<div>Light is ON</div>';
    }

    public function off()
    {
        echo '<div>Light is OFF</div>';
    }
}

class GarageDoor
{
    public function up()
    {
        echo '<div>Garage Door is Open</div>';
    }

    public function down()
    {
        echo '<div>Garage Door is Close</div>';
    }

    public function stop()
    {
        echo '<div>Garage Door is Stop</div>';
    }

    public function lightOn()
    {
        echo '<div>Light in garage is on</div>';
    }

    public function lightOff()
    {
        echo '<div>Light in garage is off</div>';
    }
}

/**
 * Класс команды должен реализовывать интерфейс Command.
 */
class LightOnCommand implements Command
{
    public $light;

    /**
     * В переменной light конструктору передается конкретный объект, которым будет управлять команда (допустим, освещение в гостиной). При вызове execute() получаетелем запроса будет объект $light.
     */
    function __construct(Light $light)
    {
        $this->light = $light;
    }

    /**
     * Метод execute() вызывает метод on() объекта-получателя (то есть осветительной системы).
     * @return [type] [description]
     */
    public function execute()
    {
        $this->light->on();
    }
}

class GarageDoorOpenCommand implements Command
{
    public $garageDoor;

    function __construct(GarageDoor $garageDoor)
    {
        $this->garageDoor = $garageDoor;
    }

    function execute()
    {
        $this->garageDoor->up();
    }
}

class SimpleRemoteControl
{
    /**
     * Всего одна ячейка для хранения команды (и одно управляемое устройство)
     * @var [type]
     */
    public $slot;

    function __construct()
    {

    }

    /**
     * Метод для назначения команды. Может вызываться повторно, если клиент кода захочет изменить поведение кнопки.
     * @param Command $comand [description]
     */
    public function setCommand(Command $command)
    {
        $this->slot = $command;
    }

    /**
     * Метод, вызываемый при нажатии кнопки. Мы просто берем объект команды, связанный с текущей ячейкой, и вызываем его метод execute().
     * @return [type] [description]
     */
    public function buttonWasPressed()
    {
        $this->slot->execute();
    }
}

/**
 * Клиент в терминологии паттерна.
 */
class SimpleRemoteControlTest
{
    public static function main($args = '')
    {
        // Объект remote - Иннициатор. Ему будет передаваться объект команды.
        $remote  = new SimpleRemoteControl;
        // Создание объекта Light, который будет Получателем запроса.
        $light   = new Light;
        // Создание команды с указанием Получателя.
        $lightOn = new LightOnCommand($light);

        $garageDoor = new GarageDoor;
        $garageOpen = new GarageDoorOpenCommand($garageDoor);

        // Команда передается Инициатору.
        $remote->setCommand($lightOn);
        // Имитируется нажатие кнопки.
        $remote->buttonWasPressed();

        $remote->setCommand($garageOpen);
        $remote->buttonWasPressed();
    }
}



class RemoteControl
{
    /**
     * В этой версии пульт будет поддерживать все семь команд "вкл/выкл", которые будут храниться в соответствувющих массивах.
     */
    public $onCommands = array();
    public $offCommands = array();

    function __construct()
    {
        $noCommand = new NoCommand;
        for ($i = 0; $i < 7; $i++) {
            $this->onCommands[$i] = $noCommand;
            $this->offCommands[$i] = $noCommand;
        }
    }
}





SimpleRemoteControlTest::main();
