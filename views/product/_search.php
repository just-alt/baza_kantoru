<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ProductSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'category') ?>

    <?= $form->field($model, 'manufacturer') ?>

    <?= $form->field($model, 'year') ?>

    <?= $form->field($model, 'name') ?>

    <?php // echo $form->field($model, 'price_buy') ?>

    <?php // echo $form->field($model, 'price_internet') ?>

    <?php // echo $form->field($model, 'price_sell') ?>

    <?php // echo $form->field($model, 'count') ?>

    <?php // echo $form->field($model, 'serial_number') ?>

    <?php // echo $form->field($model, 'shelf') ?>

    <?php // echo $form->field($model, 'note') ?>

    <?php // echo $form->field($model, 'available') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
