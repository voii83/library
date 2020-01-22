<?php

use yii\helpers\Html;
use yii\widgets\LinkPager;

$this->title = 'Books author';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="books-index">

    <h1><?= Html::encode($this->title) . ' - ' . $author->name?></h1>

    <?php if ($books) : ?>
    <table class="table">
        <thead>
        <tr>
            <th>Name</th>
            <th>Rating</th>
            <th>Date publishing</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($books as $book) : ?>
            <tr>
                <td><?= $book->name ?></td>
                <td><?= $book->rating ?></td>
                <td><?= date('j-m-Y',$book->date_publishing) ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
        <?= LinkPager::widget([
            'pagination' => $pages,
        ]); ?>
    <?php else : ?>
        <h3>Books not found</h3>
    <?php endif; ?>
</div>