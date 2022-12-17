<?php

namespace app\controllers;

use app\helpers\PicturesCollection;
use app\models\ContactForm;
use app\models\Picture;
use app\services\DecisionCollection;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Throwable;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\Response;

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

    public function actionIndex()
    {
        if (PicturesCollection::isMaxCountAllIdInCache()) {
            return $this->render('index', ['error' => 'Вы просмотрели все фотографии', 'picture_id' => 0]);
        }
        $error = '';
        try {
            $picture_id = PicturesCollection::getPictureId();

            if ($picture_id > PicturesCollection::getMaxId()) {
                return $this->render('index', ['error' => 'Вы просмотрели все фотографии', 'picture_id' => 0]);
            }

            $client = new Client();
            $picture = $client->get("https://picsum.photos/id/{$picture_id}/600/400")->getBody()->getContents();
            file_put_contents("images/picture.jpg", $picture);

        } catch (\Exception|\Throwable|\Error|\RuntimeException|ClientException $exception) {
            $error = 'Попробуйте перезагрузить страницу что-то пошло не так!';
        }
        return $this->render('index', ['error' => $error, 'picture_id' => $picture_id]);
    }

    public function actionCreate()
    {
        if ($this->request->isPost) {
            $body = $this->request->post();
            DecisionCollection::add($body);
        }

        if (PicturesCollection::isMaxCountAllIdInCache()) {
            return $this->render('index', ['error' => 'Вы просмотрели все фотографии', 'picture_id' => 1000]);
        }
        return $this->redirect(['index', ['error' => '']]);
    }

    public function actionAdmin()
    {
        if (array_key_exists('token', $this->request->queryParams) && $this->request->queryParams['token'] === 'xyz123') {
            $cache = DecisionCollection::getAllDecisionInCache();
            foreach ($cache as $picture_id => $decision) {
                $model = new Picture();
                $model->picture_id = $picture_id;
                $model->decision = $decision;
                $model->created_at = date('Y-m-d H:i:s');
                $model->update_at = date('Y-m-d H:i:s');
                $model->save();
            }
            $emptyCollection = [];
            DecisionCollection::putAllDecisionInCache($emptyCollection);

            $collectionDecision = Picture::find()->all();
            return $this->render('admin', ['decisions' => $collectionDecision]);
        }

        $title = 'Не правильные параметры входа!';
        $message = 'Проверьте данные входа или обратитесь к администратору ресурса!';
        return $this->render('error', ['name' => $title, 'message' => $message]);
    }


    public function actionDelete()
    {
        if ($this->request->isPost) {
            $body = $this->request->post();
            if (array_key_exists('picture_id', $body)) {
                $picture_id = $body['picture_id'];
                Picture::find()->where(['picture_id'=> $picture_id])->one()->delete();
                PicturesCollection::deletePictureId($picture_id);
            }
        }

        return $this->redirect(Url::toRoute(['site/admin', 'token' => 'xyz123']));
    }
    public function actionAbout()
    {
        return $this->render('about');
    }

    public function beforeAction($action)
    {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }

    private function isMaxPicturesIdRenderStop()
    {
        if (PicturesCollection::isMaxCountAllIdInCache()) {
            return $this->render('index', ['error' => 'Вы просмотрели все фотографии', 'picture_id' => 1000]);
        }
    }
}
