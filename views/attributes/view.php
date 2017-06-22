<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Attributes */

$this->title = \app\models\Product::findOne($model->product_id)->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Attributes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="attributes-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(yii::t('app','Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(yii::t('app','Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a(yii::t('app','Create Attributes'), ['create','parentId'=>$model->product_id], ['class' => 'btn btn-success']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute'=>'product_id',
                'value'=> \app\models\Product::findOne($model->product_id)->name,
            ],
            [
                'attribute'=>'attr_group',
                'value'=> \app\models\AttributeGroups::findOne($model->attr_group)->name,
            ],
            'name',
        ],
    ]) ?>

</div>
