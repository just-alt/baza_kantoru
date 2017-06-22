<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Equipment */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Equipments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="equipment-view">

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
        <?= Html::a(yii::t('app', 'Create Equipment'), ['create', 'parentId' => $model->product_id], ['class' => 'btn btn-success']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'eq_group',
                'value' => function ($data) {
                    return \app\models\EquipmentGroups::findOne($data->eq_group)->name;
                }
            ],
            [
                'attribute' => 'availability',
                'value' => function ($data) {
                    return ($data->availability == 0) ? 'Відсутня' : 'Присутня';
                }
            ],
            [
                'attribute' => 'product_id',
                'value' => function ($data) {
                    return \app\models\Product::findOne($data->product_id)->name;
                }
            ]
        ],
    ]) ?>

</div>
