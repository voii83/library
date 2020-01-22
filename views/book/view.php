<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Books */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Books', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="books-view">

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
                'attribute' => 'author',
                'format' => 'raw',
                'value' => function ($data) {
                    return Html::a($data->author->name, Url::to(['/author/view', 'id' => $data->author->id]));
                }
            ],
            [
                'attribute' => 'date_publishing',
                'value' => function ($data) {
                    return date('j-m-Y',$data->date_publishing);
                }
            ],
            [
                'attribute' => 'rating',
                'value' => function ($data) {
                    return $rating = $data->rating ? $data->rating : 0;
                }
            ],
        ],
    ]) ?>

</div>
