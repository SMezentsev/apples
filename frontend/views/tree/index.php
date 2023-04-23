<?php

use kartik\grid\GridView;
use yii\bootstrap5\Html;
use common\models\ProductPosition;
use common\models\ProductCondition;

?>
<div class="row">
    <div class="col-md-12">
            <p><a class="btn btn-lg btn-success" href="/tree/add">Добавить яблочневое дерево</a></p>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'containerOptions' => [
                'style' => 'min-height:100px; overflow: auto; word-wrap: break-word;'
            ],
            'rowOptions' => function ($tree) use ($model) {

                $id = $model->id ?? null;
                if ($id && $tree->id === $id) {
                    return ['style' => 'background-color: #efefef']; // Генерирует опции для tr
                }
                return [];
            },
            'toolbar' => [
            ],
            'pjax' => true,
            'toggleDataOptions' => ['minCount' => 10],
            'bordered' => true,
            'resizableColumns' => true,
            'striped' => false,
            'condensed' => false,
            'responsive' => true,
            'hover' => true,
            'floatHeader' => true,
            'floatHeaderOptions' => ['top' => true],
            'panel' => [
                'type' => 'primary'
            ],
            'columns' => [
                [
                    'hAlign' => 'center',
                    'vAlign' => 'middle',
                    'attribute' => 'id',
                    'label' => 'Деревья',
                    'format' => 'raw',
                    'value' => static function ($model) {

                        //return Html::a('Клиент', '/clients/' . $model->client->uuid . '/view', ['class' => 'links', 'target' => '_blank']) . ' / ' . $count;
                        return HTML::a(
                            '<i class="fa fa-tree" style="font-size:50px;color:black"></i><sub>' . $model->id . '</sub>',
                            '/tree?id=' . $model->id,
                            ['data-pjax' => '0']);
                    }
                ],

            ],
        ]);
        ?>
    </div>
    <div class="col-md-8">
        <?php

        foreach ($model->apples as $apple) { ?>

            <div class="row">
                <div class="col-md-2">
                    <i class="fa fa-apple" style="font-size:100px;color:#<?= $apple->color ?>"></i>
                </div>
                <div class="col-md-3">
                    <div>Количество: <?= $apple->amount ?>%</div>
                    <div>Состояние: <?= $apple->condition->productCondition->name ?></div>
                    <div>Положение: <?= $apple->position->productPosition->name ?></div>
                </div>
                <div class="col-md-6">

                    <?php if ($apple->position->productPosition->id === ProductPosition::ON_TREE) { ?>
                        <?= HTML::a(
                            'Упасть',
                            '/tree/fell-apple?tree_id=' . $model->id . '&apple_id=' . $apple->id,
                            ['class' => 'btn btn-primary btn-sm']); ?>
                    <?php } ?>
                    <?php if ($apple->position->productPosition->id === ProductPosition::ON_GROUND && $apple->amount) { ?>
                        <?= HTML::a(
                            'Откусить 20%',
                            '/tree/eat-apple?tree_id=' . $model->id . '&apple_id=' . $apple->id,
                            ['class' => 'btn btn-primary btn-sm']); ?>
                    <?php } ?>
                    <?php if (!$apple->amount) { ?>
                        <?= HTML::a(
                            'Удалить',
                            '/tree/delete-apple?tree_id=' . $model->id . '&apple_id=' . $apple->id,
                            ['class' => 'btn btn-primary btn-sm']); ?>
                    <?php } ?>
                </div>
            </div>


        <?php } ?>
    </div>
</div>
</div>
