<?php


namespace app\modules\admin\controllers;
use Yii;
use app\models\Acts;
use app\models\ActsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;


use yii\web\ForbiddenHttpException;



use app\models\Contracts as ContractsAlias;
use app\models\Acts as ActsAlias;

/**
 * ActsController implements the CRUD actions for Acts model.
 */
class ActsController extends Controller
{
    /**
     * {@inheritdoc}
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
     * Lists all Acts models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ActsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);


        $data_ = ContractsAlias::find()->all();
        foreach ($data_ as $value) {
            $data[$value->id]=$value->number;
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'data' => $data,

        ]);
    }
    public function actionDownload($id)
{
    return $this->render('download', [
       'model' => $this->findModel($id),

    ]);

}
    /**
     * Displays a single Acts model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Acts model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Acts();
        $data_ = ContractsAlias::find()->all();
        foreach ($data_ as $value) {
            $data[$value->id]=$value->number;
        }
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id, 'data' => $data]);
        }

        return $this->render('create', [
            'model' => $model, 'data' => $data
        ]);
    }

    /**
     * Updates an existing Acts model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $data_ = ContractsAlias::find()->all();

        foreach ($data_ as $value) {
            $data[$value->id]=$value->number;
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id, 'data' => $data]);
        }

        return $this->render('update', [
            'model' => $model, 'data' => $data,
        ]);
    }

    /**
     * Deletes an existing Acts model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Acts model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Acts the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Acts::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
