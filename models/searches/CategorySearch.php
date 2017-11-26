<?php

namespace app\models\searches;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Category;

/**
 * CategorySearch represents the model behind the search form about `app\models\Category`.
 */
class CategorySearch extends Category
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'parent_id', 'order', 'link_id', 'allow_publish', 'display', 'reply', 'check', 'created_at', 'updated_at', 'icon_id'], 'integer'],
            [['name', 'title', 'meta_title', 'keywords', 'description', 'model', 'type', 'reply_model', 'extend', 'status'], 'safe'],
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
        $query = Category::find();

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
            'order' => $this->order,
            'link_id' => $this->link_id,
            'allow_publish' => $this->allow_publish,
            'display' => $this->display,
            'reply' => $this->reply,
            'check' => $this->check,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'icon_id' => $this->icon_id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'meta_title', $this->meta_title])
            ->andFilterWhere(['like', 'keywords', $this->keywords])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'model', $this->model])
            ->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'reply_model', $this->reply_model])
            ->andFilterWhere(['like', 'extend', $this->extend])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
