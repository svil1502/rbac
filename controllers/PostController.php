<?php
/**
 * Created by PhpStorm.
 * User: svetlanailina
 * Date: 2019-04-19
 * Time: 18:42
 */
namespace app\controllers;
use yii\web\Controller;
use app\models\Post;

class PostController extends Controller
{
    public function actionIndex(){
        $model = Post::find()->all();
        return $this->render('index', ['model'=>$model]);
    }
}