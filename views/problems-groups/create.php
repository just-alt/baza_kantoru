<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ProblemsGroups */

$this->title = yii::t('app','Create Problems Groups');
$this->params['breadcrumbs'][] = ['label' => yii::t('app','Problems Groups'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="problems-groups-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
