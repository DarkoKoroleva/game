# game
Доброго времени суток!
Я оставлю небольшой комментарий к своей работе. 

Дополнительные соглашения: из файла "rooms.txt" считывается в строку наполнение комнат, из файла "adj.txt" - таблица смежности комнат, где каждая строчка ставится в соответствие с комнатой с таким же порядком номером. Комнаты нумеруются в порядке их следования в файле. Первая - старт, последняя - финиш.

Хочу добавить, это мой первый проект на php, и я не на все свои вопросы о внутренней работе языка (что у него под капотом и почему некоторые функции работают так и не иначе) нашла. Одним из таких вопросов стал момент считывания из файла таблицы смежности комнат. Было несколько вариантов решения в голове, реализовать получилось лишь один и, вполне вероятно, "с костылями". Проблема была в том, что функция fgets() из моего файла считывает первые n-1 строку с кодом переноса строки на конце, а соответственно при разделении этой строки на элементы массива, последний элемент был испорчен дополнением '\r'. Поэтому, я вручную удаляла его, чтобы в дальнейшем при обращении к элементу масиива не возникало ошибки. 

Игра сделана в стиле визуальной новеллы, где на каждое действие персонажа выводится соответствующий текст и предложение действия. 

Искренне рада выполнять такие интересные задачи, спасибо!
