<?php

use yii\db\Migration;

class m161016_150305_tasks extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%tasks}}', [
            'id' => $this->primaryKey(),
            'status_id' => $this->integer()->notNull(),
            'task_name' => $this->string()->notNull()->unique(),

            'created_at' => $this->integer()->notNull(),
            'update_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createIndex('status_id','tasks','status_id');
        $this->addForeignKey('FK_statuses_task','tasks','status_id','statuses','id','CASCADE','CASCADE');
    }

    public function down()
    {
        $this->dropForeignKey('FK_statuses_task', 'tasks');
        $this->dropIndex('status_id', 'tasks');

        $this->dropTable('{{%tasks}}');
    }
}
