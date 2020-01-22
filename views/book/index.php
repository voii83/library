<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BooksSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Books';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="books-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Books', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
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
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
