<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Books;

/**
 * BooksSearch represents the model behind the search form of `app\models\Books`.
 */
class BooksSearch extends Books
{
    public $author_name;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'date_publishing', 'rating'], 'integer'],
            [['author_name', 'name'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Books::find()->with('author');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => ['rating' => SORT_DESC]
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->joinWith(['author tbl_author']);

        $query->andFilterWhere([
            'id' => $this->id,
            'date_publishing' => $this->date_publishing,
            'rating' => $this->rating,
        ]);

        $query-> joinWith (['author tbl_author']);
        $query->andFilterWhere(['like', 'tbl_author.name', $this->author_name]);

        $query->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}
