<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%links}}`.
 */
class m210711_123928_create_links_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%links}}', [
            'id'        => $this->primaryKey(),
            'link_name' => $this->string(255)->notNull(),
            'alias'     => $this->string(30)->unique(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%links}}');
    }
}
