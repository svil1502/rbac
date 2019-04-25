<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\Contracts;
use app\models\ContractsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use app\models\Companies as CompaniesAlias;
use app\models\Requisites as RequisitesAlias;
use app\models\Locations;
use yii\helpers\Json;

use yii\web\ForbiddenHttpException;
/**
 * ContractsController implements the CRUD actions for Contracts model.
 */
class ContractsController extends Controller
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
     * Lists all Contracts models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ContractsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $data_companies = CompaniesAlias::find()->all();
        $data_requisites = RequisitesAlias::find()->all();
        foreach ($data_companies as $value) {
            $data_c[$value->id]=$value->name;
        }
        foreach ($data_requisites as $value) {
            $data_r[$value->id]=$value->req;
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'data_c' => $data_c,
            'data_r' => $data_r,
        ]);
    }

    /**
     * Displays a single Contracts model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */

    public function actionDownload($id)
    {
        return $this->render('download', [
            'model' => $this->findModel($id),

        ]);

    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Contracts model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Contracts();

        $data_companies = CompaniesAlias::find()->all();
        $data_requisites = RequisitesAlias::find()->all();
        foreach ($data_companies as $value) {
            $data_c[$value->id]=$value->name;
        }
        foreach ($data_requisites as $value) {
            $data_r[$value->id]=$value->req;
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id, 'data_c' => $data_c, 'data_r' => $data_r]);
        }

        return $this->render('create', [
            'model' => $model,
            'data_c' => $data_c,
            'data_r' => $data_r,
           
        ]);
    }

    /**
     * Updates an existing Contracts model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $data_companies = CompaniesAlias::find()->all();
        $data_requisites = RequisitesAlias::find()->all();
        foreach ($data_companies as $value) {
            $data_c[$value->id]=$value->name;
        }
        foreach ($data_requisites as $value) {
            $data_r[$value->id]=$value->req;
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id, 'data_c' => $data_c, 'data_r' => $data_r]);
        }

        return $this->render('update', [
            'model' => $model,
            'data_c' => $data_c,
            'data_r' => $data_r,
        ]);
    }

    /**
     * Deletes an existing Contracts model.
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
     * Finds the Contracts model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Contracts the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Contracts::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
