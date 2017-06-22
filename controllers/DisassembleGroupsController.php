<?php

namespace app\controllers;

use app\models\Disassemble;
use Yii;
use app\models\DisassembleGroups;
use app\models\DisassembleGroupsSearch;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DisassembleGroupsController implements the CRUD actions for disassemble-groups model.
 */
class DisassembleGroupsController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all DisassembleGroups models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DisassembleGroupsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single DisassembleGroups model.
     *
     * @param integer $id
     *
     * @return mixed
     */
    public function actionView($id)
    {
        $parts = $this->getAllParts($id);
        $dataProdiver = new ActiveDataProvider(['query' => $parts]);

        return $this->render('view', [
            'model' => $this->findModel($id),
            'dataProvider'=>$dataProdiver,
        ]);
    }

    /**
     * Creates a new DisassembleGroups model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new DisassembleGroups();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing DisassembleGroups model.
     * If update is successful, the browser will be redirected to the 'view' page.
     *
     * @param integer $id
     *
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing DisassembleGroups model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     *
     * @param integer $id
     *
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the DisassembleGroups model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param integer $id
     *
     * @return DisassembleGroups the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = DisassembleGroups::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function getAllParts($id)
    {
        $parts = Disassemble::find()->where(['dis_group'=>$id]);
        return $parts;
    }


    /**
     * Checks if user has access to calling action
     * @param $action
     *
     * @return true if user can access to action
     * @throws ForbiddenHttpException if user can't access action
     */
    public function beforeAction($action)
    {
        if (parent::beforeAction($action)) {
            if (!Yii::$app->user->can($action->id)) {
                throw new ForbiddenHttpException('Access denied');
            }

            return true;
        } else return false;
    }
}
