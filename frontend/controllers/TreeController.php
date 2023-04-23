<?php

namespace frontend\controllers;

use common\models\search\TreeSearch;
use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\components\interfaces\ApplesInterface;
use common\components\interfaces\TreeInterface;
use common\models\Tree;

use yii\base\Module;

/**
 * Site controller
 */
class TreeController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'access' => [
                    'class' => AccessControl::class,
                    'rules' => [
                        [
                            'actions' => [
                                'add',
                                'index',
                                'eat-apple',
                                'delete-apple',
                                'fell-apple',
                            ],
                            'allow'   => true,
                        ],
                    ],
                ],
                'verbs'  => [
                    'class'   => VerbFilter::class,
                    'actions' => [
                        'index'  => ['GET'],
                        'eat-apple'  => ['GET'],
                        'delete-apple'  => ['GET'],
                        'fell-apple'  => ['GET'],
                        'add'  => ['GET'],
                    ],
                ],
            ]
        );
    }

    /**
     * @var ApplesInterface
     */
    protected $treeService;

    public function __construct(
        $id,
        Module $module,
        TreeInterface $treeService,
        array $config = []
    )
    {

        parent::__construct($id, $module, $config);

        $this->treeService = $treeService;
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {

        $query = new TreeSearch();
        $params = Yii::$app->request->queryParams;

        $model = new Tree();
        if(isset($params['id'])) {

            $model = $this->treeService->get($params['id']);
        }

        $dataProvider = $query->search();
        $searchModel = new TreeSearch();

        return $this->render('index', [

            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
            'model' => $model,
        ]);
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionAdd()
    {

        $tree = $this->treeService->add();

        return $this->redirect(['index?id='.$tree->id]);
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionDeleteApple($tree_id, $apple_id)
    {

        $tree = $this->treeService->deleteApple($id, $apple_id);

        return $this->redirect(['index?id='.$tree_id]);
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionEatApple($tree_id, $apple_id)
    {

        $tree = $this->treeService->eatApple($tree_id, $apple_id);

        return $this->redirect(['index?id='.$tree_id]);
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionFellApple($tree_id, $apple_id)
    {

        $tree = $this->treeService->fellApple($tree_id, $apple_id);

        return $this->redirect(['index?id='.$tree_id]);
    }


}
