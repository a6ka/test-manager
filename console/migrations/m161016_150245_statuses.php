<?php

use yii\db\Migration;

class m161016_150245_statuses extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%statuses}}', [
            'id' => $this->primaryKey(),
            'status_name' => $this->string()->notNull()->unique(),
        ], $tableOptions);

        $this->execute(file_get_contents(__DIR__ . '/sql/statuses.sql'));
    }

    public function down()
    {
        $this->dropTable('{{%statuses}}');
    }
}
