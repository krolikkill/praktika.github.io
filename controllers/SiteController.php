<?php

namespace app\controllers;

use app\models\Categ;
use app\models\RegForm;
use app\models\Work;
use Yii;
use yii\data\Pagination;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use yii\web\UploadedFile;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
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
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
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

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
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

    public function actionRegistr()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new RegForm();
        if ($model->load(Yii::$app->request->post()) && $model->registr()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('registr', [
            'model' => $model,
        ]);
    }

    public function actionWork()
    {
        $model = new Work();
        $them = Categ::find()->all();
        $id = Yii::$app->request->get('id');
        $category = Categ::findOne($id);
        //$tours = Tours::find()->where(['category_id'=>$id])->all();

        $theq = Categ::findOne($id);
        $query = Work::find()->where(['category_id' => $id]);
        $pages = new Pagination(['totalCount' => $query->count(), 'pageSize' => 3]);
        $tours = $query->offset($pages->offset)
            ->where(['category_id' => $id])
            ->limit($pages->limit)
            ->all();

        return $this->render('work',[
            'category'=>$category,
            'tours'=>$tours,
            'them'=>$them,
            'model'=>$model,
            //'artq'=>$artq,
            'pages'=>$pages,
        ]);

    }

    public function actionZayavka()
    {
        $model = New Work();

        if ($model->load(Yii::$app->request->post())){
            $model -> file = UploadedFile::getInstance($model, 'file');
            if ($model -> save()) {
                if ($model -> upload()) {
                    Yii::$app->session->setFlash('success', 'Всё прошло успешно');
                    return $this->goHome();
                }
            }
        }

        return $this->render('zayavka',[
            'model'=>$model
        ]);
    }

}
