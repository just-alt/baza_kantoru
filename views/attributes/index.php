<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AttributesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = yii::t('app','Attributes');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="attributes-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(yii::t('app','Create Attributes'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'rowOptions' => function($model){
            return ['onClick'=>'location.href=\''.\yii\helpers\Url::to([Yii::$app->controller->id.'/view', 'id'=>$model->id]).'\'',
                'style'=>'cursor: pointer',
            ];
        },
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            [
              'attribute'=>'manufacturer',
                'label' => yii::t('app', 'Manufacturer'),
                'format' => 'text',
                'content'=>function($data){
                    $manufId = \app\models\Product::findOne($data->product_id)->manufacturer;
                    return \app\models\Manufacturers::findOne($manufId)->name;
                },
            ],
            [
              'attribute'=>'product_id',
                'content'=>function($data){
                    return \app\models\Product::findOne($data->product_id)->name;
                }
            ],
            [
                'attribute'=>'attr_group',
                'content'=>function($data){
                    return \app\models\AttributeGroups::findOne($data->attr_group)->name;
                }
            ],
            'name',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
