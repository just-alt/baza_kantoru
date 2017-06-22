<?php

namespace app\controllers;

use app\models\Export;
use app\models\GlobalSearch;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Site;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;

class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'logout', 'search', 'camera'],
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
                        'actions' => ['search'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['camera'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $site = new Site();
        $readyForSell = $site->getReadyForSellProducts();

        return $this->render('index', ['readyForSell' => $readyForSell]);
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }

        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Test Export all motherboards
     *
     * @return string
     */
    public function actionExport1()
    {
        $site = new Export();
        $data = $site->getMotherboards();

        $array = [];
        foreach ($data as $d){
            $obj = new Export();
            $obj->id=$d['id'];
            $obj->manufacturer=$d['manufacturer'];
            $obj->model = $d['model'];
            $obj->note = $d['note'];
            $obj->category = $d['dis_group'];

            $array[] = $obj;
        }

        return $this->render('export', ['data' => $array]);
    }

    /**
     * Search product, disassemble through almost all fields
     *
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionSearch()
    {
        if (Yii::$app->request->get('q') && !empty(Yii::$app->request->get('q'))) {
            $query = Yii::$app->request->get('q');
            $search = new GlobalSearch();
            $searchResult = $search->searchProduct($query);

            return $this->render('search', ['query' => $query, 'result' => $searchResult]);
        }
        throw new NotFoundHttpException(Yii::t('app', 'No search result'));
    }

    /**
     * Displays 3d printer camera
     *
     * @return string
     */
    public function actionCamera()
    {
        return $this->render('camera');
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
