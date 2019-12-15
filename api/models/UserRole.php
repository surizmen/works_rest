<?php

namespace app\models;

use common\models\User;
use Yii;
use yii\db\Query;

/**
 * This is the model class for table "user_role".
 *
 * @property int $id
 * @property int $user_id
 * @property int $role_id
 * @property int|null $points
 * @property string|null $test_date
 *
 * @property Role $role
 * @property User $user
 */
class UserRole extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_role';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'role_id'], 'required'],
            [['user_id', 'role_id', 'points'], 'default', 'value' => null],
            [['user_id', 'role_id', 'points'], 'integer'],
            [['test_date'], 'safe'],
            [['role_id'], 'exist', 'skipOnError' => true, 'targetClass' => Role::className(), 'targetAttribute' => ['role_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'ID пользователя',
            'role_id' => 'ID роли',
            'points' => 'Очки теста',
            'test_date' => 'Дата теста',
        ];
    }

    public function ChangeTotalResult($result)
    {
        $this->points = $result;
        if ($this->save())
            return (['message' => 'Тест успешно пройден']);
        return $this->getErrors();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRole()
    {
        return $this->hasOne(Role::className(), ['id' => 'role_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
