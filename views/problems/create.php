<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Problems */

$this->title = Yii::t('app', 'Create Problems');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Problems'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="problems-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'parentId'=>$parentId,
    ]) ?>

</div>
