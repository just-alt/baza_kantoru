<?php

use app\models\AttributeGroups;
use app\models\Categories;
use app\models\Manufacturers;
use app\models\Problems;
use app\models\ProblemsGroups;
use app\models\Shelfs;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Product */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Товар', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Оновити', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Видалити', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a(yii::t('app', 'Create Attributes'), ['attributes/create', 'parentId' => $model->id], ['class' => 'btn btn-success']) ?>
        <?= Html::a(yii::t('app', 'Create Problems'), ['problems/create', 'parentId' => $model->id], ['class' => 'btn btn-success']) ?>
        <?= Html::a(yii::t('app', 'Create Equipment'), ['equipment/create', 'parentId' => $model->id], ['class' => 'btn btn-success']) ?>
        <?= Html::a(yii::t('app', 'Create Product'), ['create'], ['class' => 'btn btn-primary']) ?>
    </p>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'category',
                'value' => Categories::findOne($model->category)->name,
            ],
            [
                'attribute' => 'manufacturer',
                'value' => $model->getManufacturer($model->manufacturer),
            ],
            'name',
            'price_internet',
            'count',
            [
                'attribute' => 'shelf',
                'value' => Shelfs::findOne($model->shelf)->name,
            ],

            'note',
            'available',
        ],
    ]) ?>

    <?php
    // Product attributes
    /** @var \yii\db\Query $query */
    $query = $model->getAllAttributes($model->id);
    if ($query->count()) {
        echo "<h3>" . yii::t('app', 'Attributes') . "</h3>";

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10
            ]
        ]);
        echo \yii\grid\GridView::widget([
            'dataProvider' => $dataProvider,
            'layout' => "{items}\n{pager}",
            'columns' => [
                [
                    'attribute' => 'attr_group',
                    'value' => function ($data) {
                        return AttributeGroups::findOne($data->attr_group)->name;
                    }
                ],
                'name'
            ]
        ]);
    }
    //  Product problems
    $query = $model->getAllProblems($model->id);
    if ($query->count()) {
        echo "<h3>" . yii::t('app', 'Problems') . "</h3>";
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10
            ]
        ]);
        echo \yii\grid\GridView::widget([
            'dataProvider' => $dataProvider,
            'layout' => "{items}\n{pager}",
            'columns' => [
                [
                    'attribute' => 'problem_group',
                    'value' => function ($data) {
                        return ProblemsGroups::findOne($data->problem_group)->name;
                    }
                ],
                'note'
            ]
        ]);
    }
//    Product equipment
    $query = $model->getAllEquipment($model->id);
    if ($query->count()) {
        echo "<h3>" . yii::t('app', 'Equipments-') . "</h3>";
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10
            ]
        ]);
        echo \yii\grid\GridView::widget([
            'dataProvider' => $dataProvider,
            'layout' => "{items}\n{pager}",
            'columns' => [
                [
                    'attribute' => 'eq_group',
                    'value' => function ($data) {
                        return \app\models\EquipmentGroups::findOne($data->eq_group)->name;
                    }
                ]
            ]
        ]);
    }
    ?>

</div>
