<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProblemsGroupsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = yii::t('app','Problems Groups');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="problems-groups-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(yii::t('app','Create Problems Groups'), ['create'], ['class' => 'btn btn-success']) ?>
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
            'name',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
