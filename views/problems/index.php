<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProblemsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = yii::t('app','Problems');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="problems-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(yii::t('app','Create Problems'), ['create'], ['class' => 'btn btn-success']) ?>
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
//            'problem_group',
        [
                'attribute'=>'manufacturer',
            'format'=>'raw',
            'enableSorting'=>TRUE,
                'content'=>function($data){
                    $manufId = \app\models\Product::findOne($data->product_id)->manufacturer;
                    $manuf = \app\models\Manufacturers::findOne($manufId)->name;
                    return $manuf;
                }
        ],
            [
              'attribute'=>'product_id',
                'content'=>function($data){
                    return \app\models\Product::findOne($data->product_id)->name;
                }
            ],
            [
                    'attribute'=>'problem_group',
                'content'=>function($data){
                    return \app\models\ProblemsGroups::findOne($data->problem_group)->name;
                }
            ],
            'note',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
