<?php


namespace backend\controllers;

use common\models\User;
use Yii;
use yii\web\Controller;
use yii\web\HttpException;
use yii\web\Response;

class UserController extends Controller
{
    public $layout = 'admin-main';

    public function actionIndex()
    {
        $url = \Yii::$app->urlManager;

        return $this->render('index', array(
            'user' => Yii::$app->user->identity,
            'useAppConfig' => array(
                'method' => 'POST',
                'url' => $url->createAbsoluteUrl(['user/ajax-save']),
            )
        ));
    }

    /**
     * @throws HttpException
     */
    public function actionAjaxSave()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        if (!Yii::$app->request->isAjax) {
            throw new HttpException(403, Yii::t('app', 'You are not allowed to perform this action.'));
        }

        $currentUser = User::findOne(Yii::$app->user->getId());

        $isLoad = $currentUser->load(Yii::$app->request->post(), '');
        if (!$isLoad) {
            return ["error" => "Failed loading data."];
        }

        return $currentUser->save()
            ? [
                "success" => "Saved successfully!"
            ]
            : [
                "error" => "Unsuccessful save."
            ];
    }
}