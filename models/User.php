<?php

namespace app\models;

use yii\behaviors\TimestampBehavior;
use yii\web\IdentityInterface;
use yii\db\ActiveRecord;

/**
 * @property int $id
 * @property string $login
 * @property string $password_hash
 * @property int $created_at
 * @property int $updated_at
 */
class User extends ActiveRecord implements IdentityInterface
{

    public static function tableName()
    {
        return '{{%user}}';
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => time(),
            ],
        ];
    }

    public static function findIdentity($id)
    {
        return User::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        /** @var UserSession $session */
        $session = UserSession::find()->where(['token' => $token])->with('user')->one();
        if($session->status == 1) return $session->user;
        return null;
    }

    public function getId(): int
    {
        return $this->getPrimaryKey();
    }

    public function getAuthKey(): string
    {
        return $_COOKIE['AUTH_TOKEN'] ?? '';
    }

    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    function beforeDelete()
    {
        UserSession::deleteAll(['user_id' => $this->id]);
    }

}