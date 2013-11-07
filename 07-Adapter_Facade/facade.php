<?php

class Amplifier
{
    public $tuner;
    public $dvdPlayer;
    public $cdPlayer;

    public function __construct($tuner, $dvdPlayer, $cdPlayer)
    {
        $this->tuner     = $tuner;
        $this->dvdPlayer = $dvdPlayer;
        $this->cdPlayer  = $cdPlayer;
    }

    public function on()
    {
        echo __CLASS__ . ' ' . __METHOD__ . '<br>';
    }

    public function off()
    {
        echo __CLASS__ . ' ' . __METHOD__ . '<br>';
    }

    public function setCd()
    {
        echo __CLASS__ . ' ' . __METHOD__ . '<br>';
    }

    public function setDvd()
    {
        echo __CLASS__ . ' ' . __METHOD__ . '<br>';
    }

    public function setStereoSound()
    {
        echo __CLASS__ . ' ' . __METHOD__ . '<br>';
    }

    public function setSurroundSound()
    {
        echo __CLASS__ . ' ' . __METHOD__ . '<br>';
    }

    public function setTuner()
    {
        echo __CLASS__ . ' ' . __METHOD__ . '<br>';
    }

    public function setVolume($value)
    {
        echo __CLASS__ . ' ' . __METHOD__ . ' ' . $value . '<br>';
    }

    public function toString()
    {
        echo __CLASS__ . ' ' . __METHOD__ . '<br>';
    }

}

class Tuner
{
    public function on()
    {
        echo __CLASS__ . ' ' . __METHOD__ . '<br>';
    }

    public function off()
    {
        echo __CLASS__ . ' ' . __METHOD__ . '<br>';
    }

    public function setAm()
    {
        echo __CLASS__ . ' ' . __METHOD__ . '<br>';
    }

    public function setFm()
    {
        echo __CLASS__ . ' ' . __METHOD__ . '<br>';
    }

    public function setFrequency()
    {
        echo __CLASS__ . ' ' . __METHOD__ . '<br>';
    }

    public function toString()
    {
        echo __CLASS__ . ' ' . __METHOD__ . '<br>';
    }
}

class DvdPlayer
{
    public function on()
    {
        echo __CLASS__ . ' ' . __METHOD__ . '<br>';
    }

    public function off()
    {
        echo __CLASS__ . ' ' . __METHOD__ . '<br>';
    }

    public function eject()
    {
        echo __CLASS__ . ' ' . __METHOD__ . '<br>';
    }

    public function pause()
    {
        echo __CLASS__ . ' ' . __METHOD__ . '<br>';
    }

    public function play()
    {
        echo __CLASS__ . ' ' . __METHOD__ . '<br>';
    }

    public function setSurroundAudio()
    {
        echo __CLASS__ . ' ' . __METHOD__ . '<br>';
    }

    public function setTwoChannelAudio()
    {
        echo __CLASS__ . ' ' . __METHOD__ . '<br>';
    }

    public function stop()
    {
        echo __CLASS__ . ' ' . __METHOD__ . '<br>';
    }
}

class CdPlayer
{
    public function on()
    {
        echo __CLASS__ . ' ' . __METHOD__ . '<br>';
    }

    public function off()
    {
        echo __CLASS__ . ' ' . __METHOD__ . '<br>';
    }

    public function eject()
    {
        echo __CLASS__ . ' ' . __METHOD__ . '<br>';
    }

    public function pause()
    {
        echo __CLASS__ . ' ' . __METHOD__ . '<br>';
    }

    public function play()
    {
        echo __CLASS__ . ' ' . __METHOD__ . '<br>';
    }

    public function stop()
    {
        echo __CLASS__ . ' ' . __METHOD__ . '<br>';
    }

    public function toString()
    {
        echo __CLASS__ . ' ' . __METHOD__ . '<br>';
    }
}

class Projector
{
    public $dvdPlayer;

    function __construct($dvdPlayer)
    {
        $this->dvdPlayer = $dvdPlayer;
    }

    public function on()
    {
        echo __CLASS__ . ' ' . __METHOD__ . '<br>';
    }

    public function off()
    {
        echo __CLASS__ . ' ' . __METHOD__ . '<br>';
    }

    public function tvMode()
    {
        echo __CLASS__ . ' ' . __METHOD__ . '<br>';
    }

    public function wideScreenMode()
    {
        echo __CLASS__ . ' ' . __METHOD__ . '<br>';
    }

    public function toString()
    {
        echo __CLASS__ . ' ' . __METHOD__ . '<br>';
    }
}

class Screen
{
    public function up()
    {
        echo __CLASS__ . ' ' . __METHOD__ . '<br>';
    }

    public function down()
    {
        echo __CLASS__ . ' ' . __METHOD__ . '<br>';
    }

    public function toString()
    {
        echo __CLASS__ . ' ' . __METHOD__ . '<br>';
    }
}

class TheaterLights
{
    public function on()
    {
        echo __CLASS__ . ' ' . __METHOD__ . '<br>';
    }

    public function off()
    {
        echo __CLASS__ . ' ' . __METHOD__ . '<br>';
    }

    public function dim($value)
    {
        echo __CLASS__ . ' ' . __METHOD__ . ' ' . $value . '<br>';
    }

    public function toString()
    {
        echo __CLASS__ . ' ' . __METHOD__ . '<br>';
    }
}

class PopcornPopper
{
    public function on()
    {
        echo __CLASS__ . ' ' . __METHOD__ . '<br>';
    }

    public function off()
    {
        echo __CLASS__ . ' ' . __METHOD__ . '<br>';
    }

    public function pop()
    {
        echo __CLASS__ . ' ' . __METHOD__ . '<br>';
    }

    public function toString()
    {
        echo __CLASS__ . ' ' . __METHOD__ . '<br>';
    }
}




class HomeTheaterFacade
{
    // Композиция: компоненты подсистемы, которые мы собираемся использовать.
    public $amp;
    public $tuner;
    public $dvd;
    public $cd;
    public $projector;
    public $lights;
    public $screen;
    public $popper;

    /**
     * В конструкторе Фасада передаются ссылки на все компоненты. Фасад присваивает их соответствующим переменным экземпляра.
     * @param Amplifier     $amp       [description]
     * @param DvdPlayer     $dvd       [description]
     * @param CdPlayer      $cd        [description]
     * @param Projector     $projector [description]
     * @param Screen        $screen    [description]
     * @param TheaterLights $lights    [description]
     * @param PopcornPopper $popper    [description]
     */
    public function __construct(Amplifier $amp,
            Tuner $tuner,
            DvdPlayer $dvd,
            CdPlayer $cd,
            Projector $projector,
            Screen $screen,
            TheaterLights $lights,
            PopcornPopper $popper)
    {
        $this->amp       = $amp;
        $this->tuner     = $tuner;
        $this->dvd       = $dvd;
        $this->cd        = $cd;
        $this->projector = $projector;
        $this->lights    = $lights;
        $this->screen    = $screen;
        $this->popper    = $popper;
    }

    /**
     * Метод watchMovie() выполняет те же операции, которые ранее выполнялись нами вручную. Обратите внимание: выполнение каждой операции делегируется соответствующему компоненту подсистемы.
     * @param  [type] $string [description]
     * @return [type]         [description]
     */
    public function watchMovie($movie)
    {
        echo 'Get ready to watch a movie...<br>';
        $this->popper->on();
        $this->popper->pop();
        $this->lights->dim(10);
        $this->screen->down();
        $this->projector->on();
        $this->projector->wideScreenMode();
        $this->amp->on();
        $this->amp->setDvd($this->dvd);
        $this->amp->setSurroundSound();
        $this->amp->setVolume(5);
        $this->dvd->on();
        $this->dvd->play($movie);
    }

    /**
     * Метод endMovie() выключает всю аппаратуру за нас. И снова каждая операция делегируется соответствующему компоненту подсистемы.
     * @return [type]         [description]
     */
    public function endMovie()
    {
        echo 'Shutting movie theater down..<br>';
        $this->popper->off();
        $this->lights->on();
        $this->screen->up();
        $this->projector->off();
        $this->amp->off();
        $this->dvd->stop();
        $this->dvd->eject();
        $this->dvd->off();
    }
}


class HomeTheaterTestDrive
{
    public static function main()
    {
        // Компоненты создаются прямо в ходе тестирования. обычно клиент получает фасад, а не создает его.
        $cd        = new CdPlayer;
        $tuner     = new Tuner;
        $dvd       = new DvdPlayer;
        $projector = new Projector($dvd);
        $screen    = new Screen;
        $lights    = new TheaterLights;
        $popper    = new PopcornPopper;
        $amp       = new Amplifier($tuner, $dvd, $cd);

        // Создаем фасад со всеми компонентами подсистемы.
        $homeTheater = new HomeTheaterFacade($amp, $tuner, $dvd, $cd, $projector, $screen, $lights, $popper);

        $homeTheater->watchMovie('Raiders of the Lost Ark');
        $homeTheater->endMovie();
    }
}

HomeTheaterTestDrive::main();

