<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\EquipmentGroups */

$this->title = Yii::t('app', 'Create Equipment Groups');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Equipment Groups'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="equipment-groups-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
