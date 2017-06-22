<?php

namespace app\controllers;

use app\models\imagesUpload;
use Yii;
use app\models\Disassemble;
use app\models\DisassembleSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * DisassembleController implements the CRUD actions for Disassemble model.
 */
class DisassembleController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'logout', 'view', 'delete'],
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['view'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['delete'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class'   => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Disassemble models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DisassembleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel'  => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Disassemble model.
     *
     * @param integer $id
     *
     * @return mixed
     */
    public function actionView($id)
    {
        $imagesModel = new imagesUpload();

        $imgList = $imagesModel->getImagesFromDB(Yii::$app->controller->id, $id);
        $images = [];
        foreach ($imgList as &$img) {
            $images[] = [
                'src'          => $imagesModel->getPath('disassemble') . $img->img_name,
                'url'          => $imagesModel->getPath('disassemble') . $img->img_name,
                'imageOptions' => ['width' => '25%', 'class' => 'pull-left img-responsive img-rounded']
            ];
        }

        return $this->render('view', [
            'model'  => $this->findModel($id),
            'images' => $images,
        ]);
    }

    /**
     * Creates a new Disassemble model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Disassemble();
        $imageUpload = new ImagesUpload;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $images = UploadedFile::getInstances($imageUpload, 'images');

            $imageUpload->uploadImages(Yii::$app->controller->id, $images, $model->id);
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model'        => $model,
                'imagesUpload' => $imageUpload,
            ]);
        }
    }

    /**
     * Updates an existing Disassemble model.
     * If update is successful, the browser will be redirected to the 'view' page.
     *
     * @param integer $id
     *
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $imageUpload = new ImagesUpload;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $images = UploadedFile::getInstances($imageUpload, 'images');

            $imageUpload->uploadImages(Yii::$app->controller->id, $images, $id);
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model'        => $model,
                'imagesUpload' => $imageUpload,
            ]);
        }
    }

    /**
     * Deletes an existing Disassemble model.
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
     * Finds the Disassemble model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param integer $id
     *
     * @return Disassemble the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Disassemble::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
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
