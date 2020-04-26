<?php

use app\models\User;
use yii\db\Migration;

class m130524_201442_init extends Migration
{

    public function safeUp()
    {

        $this->createTable(User::tableName(), [
            'id' => $this->primaryKey(),
            'login' => $this->string()->notNull()->unique(),
            'password_hash' => $this->string()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);

    }

    public function safeDown()
    {

        $this->dropTable(User::tableName());

    }
}
