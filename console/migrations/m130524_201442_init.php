<?php

use yii\db\Migration;

class m130524_201442_init extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'access_token' => $this->string()->notNull(),
            'username' => $this->string()->notNull()->unique(),
            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string()->unique(),
            'email' => $this->string()->notNull()->unique(),

            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->insert('{{%user}}', [
            'access_token' => 'bd9615e2871c56dddd8b88b576f131f51c20f3bc',
            'username' => 'admin',
            'auth_key' => 'Zu-CaZt_y9lyoxHymnaC1CAKhFiLPuqP',
            'password_hash' => '$2y$13$qiKJ/17Md7bfrngqqSQfdODWwr/yySSTv5pcCOPffFiXXXk6bW8su',
            'password_reset_token' => null,
            'email' => 'a6ka666@gmail.com',
            'status' => 10,
            'created_at' => time(),
            'updated_at' => time(),
        ]);

        $this->insert('{{%user}}', [
            'access_token' => 'bd9615e2871c56dddd8b88b576f131f51c20f3bc',
            'username' => 'admin2',
            'auth_key' => 'Zu-CaZt_y9lyoxHymnaC1CAKhFiLPuqP',
            'password_hash' => '$2y$13$qiKJ/17Md7bfrngqqSQfdODWwr/yySSTv5pcCOPffFiXXXk6bW8su',
            'password_reset_token' => null,
            'email' => 'illyar80@gmail.com',
            'status' => 10,
            'created_at' => time(),
            'updated_at' => time(),
        ]);
    }

    public function down()
    {
        $this->dropTable('{{%user}}');
    }
}
