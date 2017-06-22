<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Продукти';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Додати товар', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel'  => $searchModel,
        'rowOptions'   => function ($model, $index, $widge, $grid) {
            switch ($model->available) {
                case 0:
                    return ['class' => 'danger'];
                    break;
            }
            return ['onClick' => 'location.href=\'' . \yii\helpers\Url::to(['product/view', 'id' => $model->id]) . '\'',
                    'style'   => 'cursor: pointer',
            ];
        },
        'columns'      => [
//            ['class' => 'yii\grid\SerialColumn'],

            'id',
//            'manufacturer',
            [
                'attribute' => 'manufacturer',
                'content'   => function ($data) {
                    return \app\models\Manufacturers::findOne($data->manufacturer)->name;
                }
            ],
            'name',
            [
                'attribute' => 'category',
                'content'   => function ($data) {
                    return \app\models\Categories::findOne($data->category)->name;
                }
            ],
            [
                'attribute' => 'shelf',
                'content'   => function ($data) {
                    $shelf = \app\models\Shelfs::findOne($data->shelf);
                    if ($shelf) {
                        $shelf = $shelf->name;
                    } else {
                        $shelf = "Невідомо";
                    }
                    return $shelf;
                }
            ],
            // 'price_buy',
            'price_internet',
            // 'price_sell',
            'count',
            // 'serial_number',
            'note',
            // 'available',

            ['class' => 'yii\grid\ActionColumn'],
        ],
        'formatter'    => [
            'class'       => 'yii\i18n\Formatter',
            'nullDisplay' => '-',
        ]
    ]); ?>
</div>
