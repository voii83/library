<?php

namespace app\models;

use app\behaviors\DateToTimeBehavior;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "authors".
 *
 * @property int $id
 * @property string $name
 * @property int|null $date_birth
 * @property int|null $rating
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Books[] $books
 */
class Authors extends \yii\db\ActiveRecord
{
    public $date_birth_formatted;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'authors';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'date_birth_formatted'], 'required'],
            [['date_birth', 'rating', 'created_at', 'updated_at'], 'integer'],
            ['date_birth_formatted', 'date', 'format' => 'php:d.m.Y'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'date_birth' => 'Date Birth',
            'date_birth_formatted' => 'Date Birth',
            'rating' => 'Rating',
        ];
    }

    /**
     * Gets query for [[Books]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBooks()
    {
        return $this->hasMany(Books::className(), ['author_id' => 'id']);
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
            ],
            [
                'class' => DateToTimeBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_VALIDATE => 'date_birth_formatted',
                    ActiveRecord::EVENT_AFTER_FIND => 'date_birth_formatted',
                ],
                'timeAttribute' => 'date_birth'
            ]
        ];
    }
}
