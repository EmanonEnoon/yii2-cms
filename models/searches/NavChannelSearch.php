<?php

namespace app\models\searches;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\NavChannel;

/**
 * NavChannelSearch represents the model behind the search form about `app\models\NavChannel`.
 */
class NavChannelSearch extends NavChannel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'parent_id', 'type', 'order'], 'integer'],
            [['title', 'url', 'target'], 'safe'],
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
        $query = NavChannel::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'parent_id' => $this->parent_id,
            'type' => $this->type,
            'order' => $this->order,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'url', $this->url])
            ->andFilterWhere(['like', 'target', $this->target]);

        return $dataProvider;
    }
}
