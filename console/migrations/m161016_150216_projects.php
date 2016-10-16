<?php

use yii\db\Migration;

class m161016_150216_projects extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%projects}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'project_name' => $this->string()->notNull()->unique(),

            'created_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createIndex('user_id','projects','user_id');
        $this->addForeignKey('FK_project_user','projects','user_id','user','id','CASCADE','CASCADE');
    }

    public function down()
    {
        $this->dropForeignKey('FK_project_user', 'projects');
        $this->dropIndex('user_id', 'projects');

        $this->dropTable('{{%projects}}');
    }
}
