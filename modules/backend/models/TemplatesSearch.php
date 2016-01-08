<?php

namespace app\modules\backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\backend\models\Templates;

/**
 * PageSearch represents the model behind the search form about `app\modules\backend\models\Page`.
 */
class TemplatesSearch extends Templates
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'path'], 'required',],
            [['name', 'path',], 'string', 'max' => 250],
        ];
    }

    /**
     * @inheritdoc
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
        $query = Templates::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'path', $this->path]);

        return $dataProvider;
    }
}
