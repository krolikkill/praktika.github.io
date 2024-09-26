<?php

namespace app\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\helpers\Html;

/**
 * This is the model class for table "work".
 *
 * @property int $id
 * @property string $name
 * @property string $body
 * @property int $category_id
 * @property int $user_id
 *
 * @property Categ $category
 * @property User $user
 */
class Work extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'work';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'body'], 'required'],
            [['body'], 'string'],
            [['category_id'], 'integer'],
            [['name'], 'string', 'max' => 55],
            ['user_id','default','value'=>Yii::$app->user->getId()],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Categ::class, 'targetAttribute' => ['category_id' => 'id']],
            [['file'], 'file', 'skipOnEmpty' => false, 'extensions' => ['docx', 'pdf', 'doc', 'ppt', 'pptx', 'zip', 'rar']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'body' => 'Описание',
            'category_id' => 'Категория',
            'user_id' => 'User ID',
            'file' => 'Ваш файл',
        ];
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Categ::class, ['id' => 'category_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    public function upload()
    {
        if ($this->validate()) {
            $this->file->saveAs('uploads/' . $this->file->baseName . '.' . $this->file->extension);
            return true;
        } else {
            return false;
        }
    }
}
