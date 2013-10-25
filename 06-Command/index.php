<?php

/**
 * Интерфейс "Команда"
 */
interface Command
{
    public function execute();

    public function undo();
}

class NoCommand implements Command
{
    public function execute()
    {

    }

    public function undo()
    {

    }
}

class Room
{
    public $room;

    function __construct($room)
    {
        $this->room = $room;
    }
}

class Light extends Room
{
    public function on()
    {
        echo '<div>' . $this->room . ': Light is ON</div>';
    }

    public function off()
    {
        echo '<div>' . $this->room . ': Light is OFF</div>';
    }
}

class GarageDoor extends Room
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

class Stereo extends Room
{
    public function on()
    {
        echo '<div>' . $this->room . ': Stereo is ON</div>';
    }

    public function off()
    {
        echo '<div>' . $this->room . ': Stereo is OFF</div>';
    }

    public function setCd()
    {
        echo '<div>' . $this->room . ': CD is turn on</div>';
    }

    public function setDvd()
    {
        echo '<div>' . $this->room . ': DVD is turn on</div>';
    }

    public function setRadio()
    {
        echo '<div>' . $this->room . ': Radio is turn on</div>';
    }

    public function setVolume($val)
    {
        echo '<div>' . $this->room . ': Volume is changed to ' . $val .' </div>';
    }
}

class CeilingFan extends Room
{
    const HIGH   = 3;
    const MEDIUM = 2;
    const LOW    = 1;
    const OFF    = 0;

    public $location;
    public $speed;

    function __construct($room)
    {
        parent::__construct($room);

        $this->speed = self::OFF;
    }

    public function high()
    {
        $this->speed = self::HIGH;
        echo '<div>' . $this->room . ': Fan speed is HIGH</div>';
    }

    public function medium()
    {
        $this->speed = self::MEDIUM;
        echo '<div>' . $this->room . ': Fan speed is MEDIUM</div>';
    }

    public function low()
    {
        $this->speed = self::LOW;
        echo '<div>' . $this->room . ': Fan speed is LOW</div>';
    }

    public function off()
    {
        $this->speed = self::OFF;
        echo '<div>' . $this->room . ': Fan is OFF</div>';
    }

    public function getSpeed()
    {
        return $this->speed;
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
     */
    public function execute()
    {
        $this->light->on();
    }

    public function undo()
    {
        $this->light->off();
    }
}

class LightOffCommand implements Command
{
    public $light;

    function __construct(Light $light)
    {
        $this->light = $light;
    }

    public function execute()
    {
        $this->light->off();
    }

    public function undo()
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

    public function undo()
    {
        $this->garageDoor->down();
    }
}

class GarageDoorCloseCommand implements Command
{
    public $garageDoor;

    function __construct(GarageDoor $garageDoor)
    {
        $this->garageDoor = $garageDoor;
    }

    function execute()
    {
        $this->garageDoor->down();
    }

    public function undo()
    {
        $this->garageDoor->up();
    }
}

class StereoOnWithCDCommand implements Command
{
    public $stereo;

    function __construct(Stereo $stereo)
    {
        $this->stereo = $stereo;
    }

    function execute()
    {
        $this->stereo->on();
        $this->stereo->setCD();
        $this->stereo->setVolume(11);
    }

    public function undo()
    {
        $this->stereo->on();
    }
}

class StereoOffCommand implements Command
{
    public $stereo;

    function __construct(Stereo $stereo)
    {
        $this->stereo = $stereo;
    }

    function execute()
    {
        $this->stereo->off();
    }

    public function undo()
    {
        $this->stereo->on();
        $this->stereo->setCD();
        $this->stereo->setVolume(11);
    }
}

class CeilingFanCommand implements Command {

    public $ceilingFan;
    /**
     * Локальная переменная для хранения предыдущей скорости.
     */
    public $prevSpeed;

    function __construct(CeilingFan $ceilingFan)
    {
        $this->ceilingFan = $ceilingFan;
    }

    function execute()
    {
        // Перед изменением скорости сохраняем ее предыдущее значение.
        $this->prevSpeed = $this->ceilingFan->getSpeed();
    }

    public function undo()
    {
        if ($this->prevSpeed == CeilingFan::HIGH) {
            $this->ceilingFan->high();
        } elseif ($this->prevSpeed == CeilingFan::MEDIUM) {
            $this->ceilingFan->medium();
        } elseif ($this->prevSpeed == CeilingFan::LOW) {
            $this->ceilingFan->low();
        } elseif ($this->prevSpeed == CeilingFan::OFF) {
            $this->ceilingFan->off();
        }
    }
}

class CeilingFanHighCommand extends CeilingFanCommand
{
    function execute()
    {
        parent::execute();

        $this->ceilingFan->high();
    }
}

class CeilingFanMediumCommand extends CeilingFanCommand
{
    function execute()
    {
        parent::execute();

        $this->ceilingFan->medium();
    }
}

class CeilingFanLowCommand extends CeilingFanCommand
{
    function execute()
    {
        parent::execute();

        $this->ceilingFan->low();
    }
}

class CeilingFanOffCommand extends CeilingFanCommand
{
    function execute()
    {
        parent::execute();

        $this->ceilingFan->off();
    }
}



class SimpleRemoteControl
{
    /**
     * Всего одна ячейка для хранения команды (и одно управляемое устройство)
     */
    public $slot;

    function __construct()
    {

    }

    /**
     * Метод для назначения команды. Может вызываться повторно, если клиент кода захочет изменить поведение кнопки.
     */
    public function setCommand(Command $command)
    {
        $this->slot = $command;
    }

    /**
     * Метод, вызываемый при нажатии кнопки. Мы просто берем объект команды, связанный с текущей ячейкой, и вызываем его метод execute().
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



class RemoteControlWithUndo
{
    /**
     * В этой версии пульт будет поддерживать все семь команд "вкл/выкл", которые будут храниться в соответствувющих массивах.
     */
    public $onCommands = array();
    public $offCommands = array();

    /**
     * Переменная для хранения последней выполненной команды.
     */
    public $undoCommand;

    function __construct()
    {
        $noCommand = new NoCommand;
        for ($i = 0; $i < 7; $i++) {
            $this->onCommands[$i] = $noCommand;
            $this->offCommands[$i] = $noCommand;
        }
        // В переменную undoCommand изначально также заносится объект NoCommand, чтобы при нажатии кнопки отмены ранее любых других кнопок ничего не происходило.
        $this->undoCommand = $noCommand;
    }

    /**
     * Метод setCommand() получает ячейку и команды включения и выключения для этой ячейки. Команды сохраняются в массивах для последующего использования.
     */
    public function setCommand($slot, Command $onCommand, Command $offCommand)
    {
        $this->onCommands[$slot]  = $onCommand;
        $this->offCommands[$slot] = $offCommand;
    }

    /**
     * При нажатии кнопки "вкл" или "выкл" пульт вызывает соответствующий метод onButtonWasPushed() или offButtonWasPushed().
     */
    public function onButtonWasPushed($slot)
    {
        $this->onCommands[$slot]->execute();

        // При нажатии кнопки мы сначала читаем команду и выполняем ее, а затем сохраняем ссылку на нее в переменной undoCommand.
        $this->undoCommand = $this->onCommands[$slot];
    }

    public function offButtonWasPushed($slot)
    {
        $this->offCommands[$slot]->execute();
        $this->undoCommand = $this->offCommands[$slot];
    }

    /**
     * При нажатии кнопки отмены мы вызываем метод undo() команды, хранящейся в переменной undoCommand. Вызов отменяет операцию последней выполненной команды.
     */
    public function undoButtonWasPushed()
    {
        $this->undoCommand->undo();
    }
}


class RemoteLoader
{
    public static function main()
    {
        $remoteControl = new RemoteControlWithUndo;

        // Создание всех устройств
        $livingRoomLight = new Light('Living Room');
        $kithchenLight   = new Light('Kitchen');
        $ceilingFan      = new CeilingFan('Living Room');
        $garageDoor      = new GarageDoor('');
        $stereo          = new Stereo('Living Room');

        // Создание команд для управления освещением
        $livingRoomLightOn  = new LightOnCommand($livingRoomLight);
        $livingRoomLightOff = new LightOffCommand($livingRoomLight);
        $kitchenLightOn     = new LightOnCommand($kithchenLight);
        $kitchenLightOff    = new LightOffCommand($kithchenLight);

        // Создаем экземпляры трех команд вентилятора: для высокой, для средней скорости и для выключения.
        $ceilingFanMedium = new CeilingFanMediumCommand($ceilingFan);
        $ceilingFanHigh   = new CeilingFanHighCommand($ceilingFan);
        $ceilingFanOff    = new CeilingFanOffCommand($ceilingFan);

        // Создание команд для управления дверью гаража
        $garageDoorUp       = new GarageDoorOpenCommand($garageDoor);
        $garageDoorDown     = new GarageDoorCloseCommand($garageDoor);

        // Создание команд для управления стереосистемой
        $stereoOnWithCD     = new StereoOnWithCDCommand($stereo);
        $stereoOff          = new StereoOffCommand($stereo);

        // Готовые команды связываются с ячейками пульта
        $remoteControl->setCommand(0, $livingRoomLightOn, $livingRoomLightOff);
        $remoteControl->setCommand(1, $kitchenLightOn, $kitchenLightOff);
        $remoteControl->setCommand(2, $stereoOnWithCD, $stereoOff);
        $remoteControl->setCommand(3, $ceilingFanMedium, $ceilingFanOff);
        $remoteControl->setCommand(4, $ceilingFanHigh, $ceilingFanOff);


        // Пульт готов к проверке!
        $remoteControl->onButtonWasPushed(0);
        $remoteControl->offButtonWasPushed(0);
        // var_dump($remoteControl);
        $remoteControl->undoButtonWasPushed();

        $remoteControl->onButtonWasPushed(1);
        $remoteControl->offButtonWasPushed(1);
        // var_dump($remoteControl);
        $remoteControl->undoButtonWasPushed();

        $remoteControl->onButtonWasPushed(2);
        $remoteControl->offButtonWasPushed(2);
        // var_dump($remoteControl);
        $remoteControl->undoButtonWasPushed();

        $remoteControl->onButtonWasPushed(3);
        $remoteControl->offButtonWasPushed(3);
        $remoteControl->undoButtonWasPushed();

        $remoteControl->onButtonWasPushed(4);
        $remoteControl->undoButtonWasPushed();
    }


}

RemoteLoader::main();

// SimpleRemoteControlTest::main();

