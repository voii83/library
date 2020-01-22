<?php

namespace app\models;

use app\behaviors\DateToTimeBehavior;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "books".
 *
 * @property int $id
 * @property int $author_id
 * @property int $date_publishing
 * @property string $name
 * @property int|null $rating
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Authors $author
 */
class Books extends \yii\db\ActiveRecord
{
    public $date_publishing_formatted;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'books';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['author_id', 'date_publishing_formatted', 'name'], 'required'],
            [['author_id', 'date_publishing', 'rating', 'created_at', 'updated_at'], 'integer'],
            [['name'], 'string', 'max' => 255],
            ['date_publishing_formatted', 'date', 'format' => 'php:d.m.Y'],
            [['author_id'], 'exist', 'skipOnError' => true, 'targetClass' => Authors::className(), 'targetAttribute' => ['author_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'author_id' => 'Author ID',
            'date_publishing' => 'Date Publishing',
            'name' => 'Name',
            'rating' => 'Rating',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Author]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(Authors::className(), ['id' => 'author_id']);
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
                    ActiveRecord::EVENT_BEFORE_VALIDATE => 'date_publishing_formatted',
                    ActiveRecord::EVENT_AFTER_FIND => 'date_publishing_formatted',
                ],
                'timeAttribute' => 'date_publishing'
            ]
        ];
    }
}
