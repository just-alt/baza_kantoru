<?php



use yii\helpers\Html;

$this->title=yii::t('app', 'PriceExport');
?>


<?php
/** @var array $categories */

$form = \yii\widgets\ActiveForm::begin([]);

/** @var app\models\Export $model */
echo $form->field($model, 'categories')->listBox(\yii\helpers\ArrayHelper::map($categories, 'id', 'name'), ['multiple'=>true, 'style'=>'height: 500px']);
echo Html::submitButton('Скачати');
\yii\widgets\ActiveForm::end();