<?php

use app\components\history\EventViewFactory;
use app\services\history\event\IEventService;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $dataProvider ActiveDataProvider */
/* @var $linkExport string */
/* @var $eventService IEventService */
?>

<?php Pjax::begin(['id' => 'grid-pjax', 'formSelector' => false]); ?>

    <div class="panel panel-primary panel-small m-b-0">
        <div class="panel-body panel-body-selected">

            <div class="pull-sm-right">
                <?php if (!empty($linkExport)) {
                    echo Html::a(Yii::t('app', 'CSV'), $linkExport,
                        [
                            'class'     => 'btn btn-success',
                            'data-pjax' => 0
                        ]
                    );
                } ?>
            </div>

        </div>
    </div>

<?php echo ListView::widget([
    'dataProvider'     => $dataProvider,
    'itemView'         => function ($history) use ($eventService) {
        $eventViewFactory = new EventViewFactory($history);
        $itemView = $eventViewFactory->createView($history->event);

        return $itemView->render([
            'user' => $history->user,
            'body' => $eventService->getBodyByEventType($history)
        ]);
    },
    'options'          => [
        'tag'   => 'ul',
        'class' => 'list-group'
    ],
    'itemOptions'      => [
        'tag'   => 'li',
        'class' => 'list-group-item'
    ],
    'emptyTextOptions' => ['class' => 'empty p-20'],
    'layout'           => '{items}{pager}',
]); ?>

<?php Pjax::end(); ?>