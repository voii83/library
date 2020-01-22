<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Authors */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Authors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="authors-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'name',
            [
                'attribute' => 'date_birth',
                'value' => function ($data) {
                    return date('j-m-Y',$data->date_birth);
                }
            ],
            [
                'attribute' => 'rating',
                'value' => function ($data) {
                    return $rating = $data->rating ? $data->rating : 0;
                }
            ],
            [
                'attribute' => 'book',
                'format' => 'raw',
                'value' => function ($data) {
                    return Html::a('View books', Url::to(['/book/list-author', 'id' => $data->id]));
                }
            ],
        ],
    ]) ?>

</div>
