<?php

use yii\db\Migration;

class m200213_113301_auth_multi_sessions_system extends Migration
{

    public function safeUp()
    {

        $this->createTable('{{%user_session}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'token' => $this->string(255)->notNull(),
            'status' => $this->boolean()->defaultValue(1),
            'created_at' => $this->integer()->notNull(),
        ]);

        $this->createIndex(
            'idx-user_session-user_id',
            '{{%user_session}}',
            'user_id'
        );
        $this->addForeignKey(
            'fk-user_session-user_id',
            '{{%user_session}}', 'user_id',
            '{{%user}}', 'id', 'CASCADE'
        );

    }

    public function safeDown()
    {

        $this->dropForeignKey(
            'fk-user_session-user_id',
            '{{%user_session}}'
        );
        $this->dropIndex(
            'idx-user_session-user_id',
            '{{%user_session}}'
        );

        $this->dropTable('{{%user_session}}');

    }

}
