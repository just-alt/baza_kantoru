<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Attributes */

$this->title = 'Update Attributes: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Attributes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
$request = Yii::$app->request;
?>
<div class="attributes-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'parentID' => $parentId,
    ]) ?>

</div>
