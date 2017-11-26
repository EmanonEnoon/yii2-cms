<?php

namespace app\models\searches;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\File;

/**
 * FileSearch represents the model behind the search form about `app\models\File`.
 */
class FileSearch extends File
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'created_at', 'updated_at'], 'integer'],
            [['name', 'path', 'ext', 'mime', 'size', 'md5', 'sha1', 'location'], 'safe'],
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
        $query = File::find();

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
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'path', $this->path])
            ->andFilterWhere(['like', 'ext', $this->ext])
            ->andFilterWhere(['like', 'mime', $this->mime])
            ->andFilterWhere(['like', 'size', $this->size])
            ->andFilterWhere(['like', 'md5', $this->md5])
            ->andFilterWhere(['like', 'sha1', $this->sha1])
            ->andFilterWhere(['like', 'location', $this->location]);

        return $dataProvider;
    }
}
