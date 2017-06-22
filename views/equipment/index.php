<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EquipmentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Наявність';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="equipment-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Створити наявність', ['create'], ['class' => 'btn btn-success']) ?>
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

            'id',

            [
                'attribute' => 'product_id',
                'content' => function ($data) {
                    $manufId = \app\models\Product::findOne($data->product_id);
                    if ($manufId){
                        $manufId=$manufId->manufacturer;
                    } else return "Unknown";
                    $manuf = \app\models\Manufacturers::findOne($manufId)->name;
                    return "<b>".$manuf . "</b> " . \app\models\Product::findOne($data->product_id)->name;
                }
            ],
            [
                'attribute' => 'eq_group',
                'content' => function ($data) {
                    return app\models\EquipmentGroups::findOne($data->eq_group)->name;
                }
            ],

            [
                'attribute' => 'availability',
                'content' => function ($data) {
                    if ($data->availability == 0) {
                        $avail = "Відсутня";
                    } else $avail = "Присутня";
                    return $avail;
                }
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
