<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\AttributeGroups */

$this->title = 'Create Attribute Groups';
$this->params['breadcrumbs'][] = ['label' => 'Attribute Groups', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="attribute-groups-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
