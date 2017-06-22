<?php

use app\models\ProblemsGroups;
use app\models\Product;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Problems */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="problems-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'problem_group')->dropDownList(ArrayHelper::map(ProblemsGroups::find()->all(), 'id', 'name'), ['prompt'=>'Група поломок']) ?>

    <?= $form->field($model, 'product_id')->dropDownList(ArrayHelper::map(Product::find()->orderBy(['id'=>SORT_DESC])->all(), 'id', 'name'), ['prompt'=>'Виберіть товар',  'options' => [$parentId => ['Selected'=>'selected']]]) ?>

    <?= $form->field($model, 'note')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
