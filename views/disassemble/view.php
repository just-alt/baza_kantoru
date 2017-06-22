<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Disassemble */
/* @var $images app\models\ImagesUpload */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Disassembles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="disassemble-view">

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
        <?= Html::a(Yii::t('app', 'Create Disassemble'), ['create'], ['class'=>'btn btn-success']) ?>
    </p>

    <?= dosamigos\gallery\Gallery::widget(['items' => $images]);?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'dis_group',
            'manuf_id',
            'model',
            'note:ntext',
        ],
    ]) ?>

</div>
