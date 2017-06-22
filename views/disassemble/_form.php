<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Disassemble */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="disassemble-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'manuf_id')->textInput()->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\Manufacturers::find()->all(), 'id', 'name')) ?>

    <?= $form->field($model, 'dis_group')->textInput()->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\DisassembleGroups::find()->all(), 'id', 'name')) ?>

    <?= $form->field($model, 'model')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'note')->textarea(['rows' => 6]) ?>

    <?= $form->field($imagesUpload, 'images[]')->fileInput(['multiple'=>true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
