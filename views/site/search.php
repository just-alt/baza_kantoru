<?php
$this->title = Yii::t('app', 'Search result');
$this->title = "";
?>
<h3><?= /** @var string $query */
    Yii::t('app', 'Search result for')." <b>".$query."</b>"?></h3>

<?php
/** @var \yii\data\ActiveDataProvider $result */
    echo \yii\grid\GridView::widget([
        'dataProvider' => $result,
        'formatter' => [
            'class' => 'yii\i18n\Formatter',
            'nullDisplay' => '-',
        ],
        'columns' => [
            'id',
            [
                'attribute' => 'category',
                'value' => 'categoryName',
            ],
            [
                'attribute' => 'manufacturer',
                'value' => 'manuf'
            ],
            'name',
            'problem',
            'attribute',
        ]
    ])
?>



