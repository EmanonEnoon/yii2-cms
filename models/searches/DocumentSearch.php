<?php

namespace app\models\searches;

use app\models\Document;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * DocumentSearch represents the model behind the search form about `app\models\Document`.
 */
class DocumentSearch extends Document
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'category_id', 'root', 'pid', 'model_id', 'position', 'link_id', 'cover_id', 'display', 'deadline', 'attach', 'view', 'comment', 'extend', 'level', 'status', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['name', 'title', 'description', 'type'], 'safe'],
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
        $query = Document::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params, '');

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'category_id' => $this->category_id,
            'root' => $this->root,
            'pid' => $this->pid,
            'model_id' => $this->model_id,
            'position' => $this->position,
            'link_id' => $this->link_id,
            'cover_id' => $this->cover_id,
            'display' => $this->display,
            'deadline' => $this->deadline,
            'attach' => $this->attach,
            'view' => $this->view,
            'comment' => $this->comment,
            'extend' => $this->extend,
            'level' => $this->level,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'type', $this->type]);

        return $dataProvider;
    }
}
