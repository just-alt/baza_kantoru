<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DisassembleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Disassembles');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="disassemble-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Disassemble'), ['create'], ['class' => 'btn btn-success']) ?>
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

            'id',
            [
                'attribute'=>'dis_group',
                'content' => function($data){
                    return \app\models\DisassembleGroups::findOne($data->dis_group)->name;
                }
            ],
            ['attribute' => 'manuf_id',
            'content' => function ($data) {
                return \app\models\Manufacturers::findOne($data->manuf_id)->name;
            }
        ],
//            'manuf_id',
        'model',
        'note:ntext',

        ['class' => 'yii\grid\ActionColumn'],
    ],
    ]); ?>
</div>
