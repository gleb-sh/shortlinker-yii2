<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%clicks}}`.
 */
class m210711_124031_create_clicks_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%clicks}}', [
            'id' => $this->primaryKey(),
            'link_id'=>$this->integer(11)->notNull(),
            'click_date'=>$this->dateTime()->defaultValue(new \yii\db\Expression('NOW()')),
        ]);

        $this->addForeignKey(
            'link_id',
            'clicks',
            'link_id',
            'links',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%clicks}}');
        $this->dropForeignKey(
            'link_id',
            'links',
        );
    }
}
