<?php

namespace app\models\searches;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\DownloadAddon;

/**
 * DownloadAddonSearch represents the model behind the search form about `app\models\DownloadAddon`.
 */
class DownloadAddonSearch extends DownloadAddon
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'file_id'], 'integer'],
            [['parse', 'content', 'download', 'size'], 'safe'],
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
        $query = DownloadAddon::find();

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
            'file_id' => $this->file_id,
        ]);

        $query->andFilterWhere(['like', 'parse', $this->parse])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'download', $this->download])
            ->andFilterWhere(['like', 'size', $this->size]);

        return $dataProvider;
    }
}
