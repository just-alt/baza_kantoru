<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\DisassembleGroups */

$this->title = Yii::t('app', 'Create Disassemble Groups');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Disassemble Groups'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="disassemble-groups-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
