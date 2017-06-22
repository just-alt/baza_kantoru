<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Attributes */

$this->title = yii::t('app','Create Attributes');
$this->params['breadcrumbs'][] = ['label' => yii::t('app','Attributes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$request = Yii::$app->request;
?>
<div class="attributes-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= /** @var $parentID app\controllers\AttributesController */
    $this->render('_form', [
        'model' => $model,
        'parentID' => $parentID,
    ]) ?>

</div>
