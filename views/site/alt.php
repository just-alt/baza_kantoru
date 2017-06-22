<?php
/** @var  $model app\controllers\SiteController*/

echo \yii\helpers\Html::a('Export','/site/export');

echo \yii\grid\GridView::widget([
   'dataProvider' => $data,
    'columns' => [
        'id',
        'category',
        'manufacturer',
        'model',
        'attributes',
        'problems',
        'equipment',
        'price'
    ],
    'formatter' => [
        'class' => 'yii\i18n\Formatter',
        'nullDisplay' => '-',
    ]
]);