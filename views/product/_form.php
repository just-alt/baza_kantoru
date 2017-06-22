<?php

use app\models\Manufacturers;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\product;

/* @var $this yii\web\View */
/* @var $model app\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'category')->DropDownList(ArrayHelper::map(\app\models\Categories::find()->all(), 'id', 'name')) ?>

    <?= $form->field($model, 'manufacturer')->DropDownList(ArrayHelper::map(Manufacturers::find()->orderBy(['name'=>SORT_ASC])->all(), 'id', 'name')) ?>

    <!--<?= $form->field($model, 'year')->textInput() ?>-->

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <!--<?= $form->field($model, 'price_buy')->textInput() ?>-->

    <?= $form->field($model, 'price_internet')->textInput() ?>

    <!--<?= $form->field($model, 'price_sell')->textInput() ?>-->

    <?= $form->field($model, 'count')->textInput() ?>

    <!--<?= $form->field($model, 'serial_number')->textInput(['maxlength' => true]) ?>-->

    <?= $form->field($model, 'shelf')->dropDownList(ArrayHelper::map(\app\models\Shelfs::find()->all(), 'id', 'name')) ?>

    <?= $form->field($model, 'note')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'available')->textInput() ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
