<?php


namespace backend\controllers;

use common\models\Files;
use common\models\Pages;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\HttpException;
use yii\web\Response;
use yii\web\UploadedFile;

class FilesController extends Controller
{
    public $layout = 'admin-main';

    //public $enableCsrfValidation = false;

    public function actionIndex()
    {
        $url = \Yii::$app->urlManager;
        $csrf_param = \Yii::$app->request->csrfParam;
        $csrf_token = \Yii::$app->request->csrfToken;

        $images = Files::find()
            ->where(['not', ['url' => null]])
            ->asArray()
            ->all();

        return $this->render('index', array(
            'config' => array(
                'save' => array(
                    'url' => $url->createAbsoluteUrl(['files/ajax-save']),
                    'method' => 'POST',
                ),
                'delete' => array(
                    'url' => $url->createAbsoluteUrl(['files/ajax-delete']),
                    'method' => 'POST'
                ),
                'csrf' => array(
                    'param' => $csrf_param,
                    'token' => $csrf_token,
                ),
                'images' => $images,
                'publicUrl' => $url->createAbsoluteUrl([''])
            ),

        ));
    }

    /**
     * @return array
     * @throws HttpException
     */
    public function actionAjaxSave()
    {
        \Yii::$app->response->format = Response::FORMAT_JSON;
        $files = array();

        foreach ($_FILES as $param => $file) {
            $model = new Files();
            $model->url = UploadedFile::getInstanceByName($param);

            if (!$model->validate()) {
                return ['error' => 'Failed validating...'];
            }
            $file = $model->upload();
            $model->url = $file['url'];
            $model->title = $file['title'];

            $file['url'] = Url::to("@web/{$file['url']}");

            if (!$model->save()) {
                return ['error' => 'Failed saving...'];
            }

            $files[] = $file;
        }

        return [
            'success' => 'Saved successfully!',
            'images' => $files
        ];
    }

}