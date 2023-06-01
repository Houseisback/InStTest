<?php

$array = [
    ['id' => 1, 'date' => "12.01.2020", 'name' => "test1"],
    ['id' => 2, 'date' => "02.05.2020", 'name' => "test2"],
    ['id' => 4, 'date' => "08.03.2020", 'name' => "test4"],
    ['id' => 1, 'date' => "22.01.2020", 'name' => "test1"],
    ['id' => 2, 'date' => "11.11.2020", 'name' => "test4"],
    ['id' => 3, 'date' => "06.06.2020", 'name' => "test3"],
];

// 1 выделить уникальные записи (убрать дубли) в отдельный массив. в конечном массиве не должно быть элементов с одинаковым id.

$pattern = array_unique(array_column($array, 'id'));
$array = array_intersect_key($array, $pattern);

// 2 отсортировать многомерный массив по ключу (любому)

usort($array, fn($a, $b) => $a['id'] <=> $b['id']);

// 3 вернуть из массива только элементы, удовлетворяющие внешним условиям (например элементы с определенным id)

$array = array_filter($array, fn($item) => ($item['id'] < 4));

// 4 изменить в массиве значения и ключи (использовать name => id в качестве пары ключ => значение)

$array = array_combine(array_map(fn($item) => $item['name'], $array), array_map(fn($item) => $item['id'], $array));

// 5 В базе данных имеется таблица с товарами goods (id INTEGER, name TEXT),
// таблица с тегами tags (id INTEGER, name TEXT) и таблица связи товаров
// и тегов goods_tags (tag_id INTEGER, goods_id INTEGER, UNIQUE(tag_id, goods_id)).
// Выведите id и названия всех товаров, которые имеют все возможные теги в этой базе.

$query = "SELECT g.id, g.name FROM (
    SELECT goods_id FROM goods_tags
    WHERE tags_id IN (SELECT id FROM tags)
    GROUP BY goods_id HAVING COUNT(*) = (SELECT COUNT(id) FROM tags)
) AS go JOIN goods AS g ON g.id = go.goods_id";

// 6 Выбрать без join-ов и подзапросов все департаменты,
// в которых есть мужчины, и все они (каждый)
// поставили высокую оценку (строго выше 5).

$query = "SELECT department_id FROM evaluations 
    WHERE gender=true GROUP BY department_id HAVING MIN(value) > 5";