<?php


interface Subject {
    public function registerObserver(Observer $o);
    public function removeObserver(Observer $o);
    public function notifyObservers();
}

// Интерфейс Observer реализуется всеми наблюдателями, таким образом, все наблюдатели должны реализовывать метод update().
interface Observer {
    public function update($temp, $humidity, $pressure);
}

// Интерфейс DisplayElement содержит всего один метод display(), который вызывается для отображения визуального элемента.
interface DisplayElement {
    public function display();
}


class WheatherData implements Subject {
    private $observers; // массив для хранения наблюдателей
    private $temperature;
    private $humidity;
    private $pressure;

    public function __construct() {
        $this->observers = array(); // задаем массив
    }

    public function registerObserver(Observer $o) {
        $this->observers[] = $o; // новые наблюдатели просто добавляются в конец спимка
    }
    public function removeObserver(Observer $o) { // если наблюдатель хочет отменить регистрацию, то мы просто удаляем его из списка
        $i = array_search($o, $this->observers);
        if ($i >= 0) {
            unset($this->observers[$i]);
        }
    }
    // Оповещение наблюдателей об изменении состояния через метод update, реализуемый всеми наблюдателями
    public function notifyObservers() {
        for ($i=0; $i < count($this->observers); $i++) {
            $observer = $this->observers[$i];
            $observer->update($this->temperature, $this->humidity, $this->pressure);
        }
    }

    // Оповещение наблюдателей о появлении новых данных
    public function measurementsChanged() {
        $this->notifyObservers();
    }

    // Тестовый метод для чтения данных с устройства
    public function setMeasurements($temperature, $humidity, $pressure) {
        $this->temperature = $temperature;
        $this->humidity = $humidity;
        $this->pressure = $pressure;
        $this->measurementsChanged();
    }
}


class CurrentConditionalDisplay implements Observer, DisplayElement {
    private $temperature;
    private $humidity;
    private $pressure;

    // Конструктору передается объект WeatherData, который используется для регистрации элемента в качестве наблюдателя
    public function __construct(Subject $weatherData) {
        $this->weatherData = $weatherData;
        $weatherData->registerObserver($this);
    }

    public function update($temperature, $humidity, $pressure) {
        $this->temperature = $temperature;
        $this->humidity = $humidity;
        $this->pressure = $pressure;

        $this->display();
    }

    public function display() {
        echo "<div>Current conditions: " . $this->temperature . "F degrees and " .$this->humidity. "% humidity</div>";
    }
}


$weatherData = new WheatherData();

$currentConditionalDisplay = new CurrentConditionalDisplay($weatherData);

$weatherData->setMeasurements(80, 65, 30.4);
$weatherData->setMeasurements(82, 70, 29.2);
$weatherData->setMeasurements(78, 90, 29.2);


?>