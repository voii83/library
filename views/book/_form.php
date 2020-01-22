<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Books */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="books-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?php

    $items = \app\services\AuthorService::getAll();
    $params = [
        'prompt' => 'Choose a book author'
    ];
    echo $form->field($model, 'author_id')->dropDownList($items, $params)->label('Author Name');

    ?>

    <?= $form->field($model,'date_publishing_formatted')->widget(DatePicker::class, [
        'language' => 'en',
        'dateFormat' => 'dd.MM.yyyy',
        'options' => [
            'class'=> 'form-control',
            'autocomplete'=>'off'
        ],
        'clientOptions' => [
            'changeMonth' => true,
            'changeYear' => true,
        ]]) ?>


    <?= $form->field($model, 'rating')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
