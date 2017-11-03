# create_mvc_framework

Результаты всех заданий должны быть представлены в вашей СОБСТВЕННОЙ (пусть примитивной)интерпретации MVC системы в бустраповском интерфейсе.

1). Дан текст с включенными в него тегами следующего вида:
[НАИМЕНОВАНИЕ_ТЕГА:описание]данные[/НАИМЕНОВАНИЕ_ТЕГА]
На выходе нужно получить 2 массива.
* 1:
 * Ключ - наименование тега
 * Значение - данные 
* 2:
* Ключ - наименование тега
* Значение - описание

Вложенность тегов не допускается. Описания может и не быть. Обезателен закрвающий тег.

2). Дана таблица в базе MySQL с полями:
   * id  - ключ
   * name  имя,
   * parent ссылка на id родителя.

Данную таблицу нужно заполнить рандомными значениями, но так что бы получилось дерево с несколькими (от 0 до 5) уровнями вложенности. Реализовать алгоритм выводящий это дерево.
Ниже из таблицы из этого задания сделать выборку записей без потомков, но с 2-мя старшими родителями (используется SQL запрос, не циклы).

3). Дан 2-х мерный массив, количество элементов в каждой строке может быть разной и заранее не известно. Так же не известно количество строк. Нужно разработать алгоритм, на выходе которого получим массив, в котром будет представлены все возможные уникальные комбинации вариантов использующий по одному элементу из каждой строки.