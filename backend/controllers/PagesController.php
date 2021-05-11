<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use common\models\Pages;
use yii\web\HttpException;
use yii\web\Response;

/**
 * Site controller
 */
class PagesController extends Controller
{

    public $layout = 'admin-main';

    public function actionIndex()
    {
        $model = new Pages();
        $posts = $model::find()->asArray()->all();

        return $this->render('index', [
            'posts' => $posts,
            'model' => $model
        ]);
    }

    public function actionCreate()
    {
        $url = \Yii::$app->urlManager;

        return $this->render('edit', [
            'config' => [
                'url' => $url->createAbsoluteUrl(['pages/ajax-save']),
                'type' => 'POST'
            ],
            'request' => [
                'action' => 'save'
            ]
        ]);
    }

    public function actionEdit($id)
    {
        $url = \Yii::$app->urlManager;
        $model = Pages::findOne($id);

        return $this->render('edit', [
            'config' => [
                'url' => $url->createAbsoluteUrl(['pages/ajax-edit']),
                'type' => 'POST'
            ],
            'request' => [
                'action' => 'edit',
                'model' => $model->attributes
            ]
        ]);
    }

    /**
     * @return array
     * @throws HttpException
     */
    public function actionAjaxSave()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        if (!Yii::$app->request->isAjax) {
            throw new HttpException(403, Yii::t('app', 'You are not allowed to perform this action.'));
        }

        $model = new Pages();
        $isLoad = $model->load(Yii::$app->request->post(), '');
        if (!$isLoad) {
            return ["error" => "Failed loading data."];
        }
        
        return $model->save()
            ? [
                "success" => "Saved successfully!"
            ]
            : [
                "error" => "Unsuccessful save."
            ];
    }

    public function actionAjaxEdit()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        if (!Yii::$app->request->isAjax) {
            throw new HttpException(403, Yii::t('app', 'You are not allowed to perform this action.'));
        }
        $request = Yii::$app->request->post();
        $model = Pages::findOne((int)$request['id']);

        $isLoad = $model->load($request, '');
        if (!$isLoad) {
            return ["error" => "Failed loading data."];
        }

        return $model->save()
            ? [
                "success" => "Saved successfully!"
            ]
            : [
                "error" => "Unsuccessful save."
            ];
    }
}