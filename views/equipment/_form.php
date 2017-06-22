<?php

use app\models\Product;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Equipment */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="equipment-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'eq_group')->dropDownList(ArrayHelper::map(\app\models\EquipmentGroups::find()->all(), 'id', 'name'), ['prompt'=>'Виберіть групу']) ?>

    <?= $form->field($model, 'availability')->textInput() ?>

    <?= $form->field($model, 'product_id')->dropDownList(ArrayHelper::map(Product::find()->orderBy(['id'=>SORT_DESC])->all(), 'id', 'name'), ['prompt'=>'Виберіть товар', 'options'=>[$parentId=>['Selected'=>'selected']]]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
