<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\OutcomeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Outcomes');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="outcome-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Outcome'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'rowOptions'   => function ($model, $index, $widge, $grid) {
            return ['onClick' => 'location.href=\'' . \yii\helpers\Url::to([Yii::$app->controller->id.'/view', 'id' => $model->id]) . '\'',
                'style'   => 'cursor: pointer',
            ];
        },
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            'product_id',
            [
                'attribute' => 'manufacturer',
                'value' => function ($data) {
                    $manuf = \app\models\Product::findOne($data->product_id)->manufacturer;
                    return \app\models\Manufacturers::findOne($manuf)->name;
                }
            ],
            [
                'attribute' => 'product_id',
                'value' => function ($data) {
                    return \app\models\Product::findOne($data->product_id)->name;
                }
            ],
            'price',
            'count',
            'date',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
