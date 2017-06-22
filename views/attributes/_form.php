<?php

use app\models\Product;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Attributes */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="attributes-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'attr_group')->dropDownList(ArrayHelper::map(\app\models\AttributeGroups::find()->all(), 'id', 'name'), ['prompt'=>'Виберіть групу атрибутів']) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'product_id')->dropDownList(ArrayHelper::map(Product::find()->orderBy(['id'=>SORT_DESC])->all(), 'id', 'name'), ['options' => [$parentID => ['Selected'=>'selected']], 'prompt'=>'Виберіть товар']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? yii::t('app','Create') : yii::t('app','Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>


</div>
