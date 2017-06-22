<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Shelfs */

$this->title = Yii::t('app', 'Create Shelfs');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Shelfs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="shelfs-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
