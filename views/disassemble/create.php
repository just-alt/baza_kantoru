<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Disassemble */

$this->title = Yii::t('app', 'Create Disassemble');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Disassembles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="disassemble-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'imagesUpload'=> $imagesUpload
    ]) ?>

</div>
