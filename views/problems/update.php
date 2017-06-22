<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Problems */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Problems',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Problems'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="problems-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'parentId'=>$parentId,
    ]) ?>

</div>
