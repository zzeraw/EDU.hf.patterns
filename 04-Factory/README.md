# Шаблон "Фабричный метод" (Factory Method)

Определяет интерфейс создания объекта, но позволяет наследникам выбрать создаваемый экземпляр.

# Шаблон "Абстрактная фабрика" (Abstract Factory)

Предоставляет интерфейс для создания семейств взаимосвязанных объектов без указания их конкретных классов.

## Принципы ООП

* Код должен зависеть об абстракций, а не от конкретных классов.

## Ключевые моменты

* Все фабрики инкапсулируют создание объектов.
* Простая Фабрика, хотя и не является полноценным паттерном, обеспечивает простой механизм изоляции клиентов от конкретных классов.
* Фабричный Метод основан на наследовании: создание объектов делегируется субклассам, реализующим фабричный метод для создания объектов.
* Абстрактная Фабрика основана на композиции: создание объектов реализуется в методе, доступ к которому осуществляется через интерфейс фабрики.
* Все фабричные паттерны обеспечивают слабую связанность за счет сокращения зависимости приложения от конкретных классов.
* Задача Фабричного Метода - перемещение создания экземпляров в субклассы.
* Задача Абстрактной Фабрики - создание семейств взаимоссвязанных объектов без зависимости от их конкретных классов.