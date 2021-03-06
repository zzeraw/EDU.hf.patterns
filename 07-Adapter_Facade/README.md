# Шаблон "Адаптер" (Adapter)

Преобразует интерфейс класса к другому интерфейсу, на который рассчитан клиент. Адаптер обеспечивает совместную работу классов, невозможную в обычных условиях из-за несовместимости интерфейсов.

# Шаблон "Фасад" (Facade)

Представляет унифицированный интерфейс к группе интерфейсов подсистемы. Фасад определяет высокоуровневый интерфейс, упрощающий работу с подсистемой.

## Принципы ООП

* Взаимодействуйте только с "друзьями". Принцип минимальной информированности.

## Ключевые моменты

* Если вам понадобится использовать существующий класс с неподходящим интерфейсом - используйте адаптер.
* Если вам понадобится упростить большой интерфейс или семейство сложных интерфейсов - используйте фасад.
* Адаптер приводит интерфейс к тому виду. на который рассчитан клиент.
* Фасад изолирует клиента от сложной подсистемы.
* Объем работы по реализации адаптера зависит от размера и сложности целевого интерфейса.
* Реализация фасада основана на композиции и делегировании.
* Существуют две разновидности адаптеров: адаптеры объектов и адаптеры классов. Для адаптеров классов необходимо множественное наследование.
* Для подсистемы можно реализовать несколько фасадов.