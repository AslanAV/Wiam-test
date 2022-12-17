<?php

use yii\db\Migration;

/**
 * Class m221215_172256_pictures
 */
class m221215_172256_pictures extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%pictures}}', [
            'id' => $this->primaryKey(),
            'picture_id' => $this->integer(),
            'decision' => $this->string(),
            'created_at' => $this->timestamp(),
            'update_at' => $this->timestamp(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%pictures}}');
    }
}
