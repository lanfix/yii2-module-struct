<?php

namespace app\components;

use app\models\UserSession;
use app\models\User;
use Yii;

class UserIdentityComponent extends yii\web\User
{

    private $_identity;

    /**
     * @param bool $autoRenew
     * @return User
     */
    public function getIdentity($autoRenew = true)
    {
        if(!$this->_identity) {
            $this->_identity = static::findIdentityByAccessToken($_COOKIE['AUTH_TOKEN'] ?? '');
        }
        return $this->_identity;
    }

    public function setIdentity($identity)
    {
        $this->_identity = $identity;
    }

    public function getId()
    {
        if($user = $this->getIdentity()) {
            return $user->id;
        }
        return 0;
    }

    public function login($user, $duration = 3600 * 24 * 5)
    {
        // Генерируем временный токен
        $token = Yii::$app->security->generateRandomString(32);

        // Исключаем коллизии токенов в БД
        if(static::findIdentityByAccessToken($token)) return false;

        // Записываем токен в БД
        $userSession = new UserSession();
        $userSession->user_id = $user->id;
        $userSession->token = $token;
        $userSession->status = 1;
        $userSession->save();

        // Записываем токен в cookies
        setcookie('AUTH_TOKEN', $token, time() + $duration, '/');
        return true;
    }

    public function logout($destroySession = true)
    {
        // Удаляем сессию текущего пользователя
        UserSession::updateAll(['status' => 0], ['token' => $_COOKIE['AUTH_TOKEN'] ?? '']);
        return $this->getIsGuest();
    }

    public static function findIdentityByAccessToken($token)
    {
        $row = UserSession::findOne(['token' => $token]);
        if($row->status == 1) return $row->user;
        return null;
    }

    /**
     * При обращении к свойствам сущности user
     * @param $name
     * @return mixed
     */
    public function __get($name)
    {
        $localMethodName = 'get' . ucfirst($name);
        if(method_exists($this, $localMethodName)) {
            return $this->{$localMethodName}();
        }
        return $this->_identity->{$name};
    }

    /**
     * При обращении к методам сущности user
     * @param $methodName
     * @param $params
     * @return mixed
     */
    public function __call($methodName, $params)
    {
        return call_user_func_array([$this->_identity, $methodName], $params);
    }

}