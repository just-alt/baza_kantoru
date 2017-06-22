<?php

$today = new DateTime();
$today = $today->format('d-m-Y');

echo \moonland\phpexcel\Excel::export([
    'models' => $data,
    'fileName' => 'Price - ' . $today,
    'mode' => 'export', //default value as 'export'
    'columns' => ['id', 'category', 'manufacturer', 'model', 'attributes', 'problems', 'equipment'], //without header working, because the header will be get label from attribute label.
    'headers' => ['id' => 'id', 'category' => 'Категорія', 'manufacturer' => 'Виробник', 'model' => 'Модель', 'attributeS' => 'Атрибути', 'problems' => 'Поломки', 'equipment' => 'Відсутнє'],
]);