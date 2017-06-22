<?php

use app\models\AttributeGroups;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Outcome */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Outcomes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="outcome-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'product_id',
            'price',
            'count',
            'date',

        ],
    ]) ?>

    <h4>Товар</h4>
    <?=
    /** @var \yii\data\ActiveDataProvider $data */
    GridView::widget([
        'dataProvider' => $data['product'],
        'layout' => "{items}\n{pager}",
        'rowOptions' => function($data){
            return [
                    'onClick'=>'location.href=\''.\yii\helpers\Url::to(['product/view', 'id'=>$data->id])."'",
            'style'=>'cursor: pointer'
            ];
        },
        'columns' => [
            'name',
        ]
    ])
    ?>
    <?php
    if ($data['attributes']->count) {
        echo "<h4>Атрибути</h4>";
            echo GridView::widget([
                    'dataProvider' => $data['attributes'],
                'layout' => "{items}\n{pager}",
                'columns' => [
                        [
                            'attribute' => 'attr_group',
                            'value' => function ($data) {
                                return AttributeGroups::findOne($data->attr_group)->name;
                            }
                        ],
                        'name',
                ]
            ]);
    }
    ?>
</div>
