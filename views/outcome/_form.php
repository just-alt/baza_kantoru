<?php

use app\models\Product;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\JsExpression;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Outcome */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="outcome-form">

    <?php $form = ActiveForm::begin(); ?>
    <?php
    $products = $model->generateProductField();
    ?>
    <?= $form->field($model, 'product_id')->widget(Select2::className(), [
        'data' => $products,
        'options' => [
            'placeholder' => '<span>'.Yii::t('app', 'Select product').'</span>',
        ],
        'pluginOptions' => [
            'templateResult' => new JsExpression('function (d) { return $(d.text); }'),
            'templateSelection' => new JsExpression('function (d) { return $(d.text); }'),
        ],
        'pluginEvents' => [
                'change'=>'function() { $.post( "' . Yii::$app->urlManager->createUrl('outcome/price?id=') . '"+$(this).val(), function( data ) {
                  $price = $( "#outcome-price" );
                  if ($price.val()==0){
                    $price.val(data);
                  }
                });
                }'
        ]
    ])
    ?>

    <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'count')->textInput() ?>

    <?php
    $date = new DateTime();
    if (!$model->date) {
        $today = $date->format('Y-m-d');
    } else $today = $model->date;
    ?>
    <?= $form->field($model, 'date')->textInput(['value' => $today]) ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
