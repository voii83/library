<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%books}}`.
 */
class m200122_105224_create_books_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%books}}', [
            'id' => $this->primaryKey(),
            'author_id' => $this->integer()->notNull(),
            'date_publishing' => $this->integer()->notNull(),
            'name' => $this->string()->notNull(),
            'rating' => $this->integer()->defaultValue(0),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        // add foreign key for table `authors`
        $this->addForeignKey(
            'fk-book-author_id',
            'books',
            'author_id',
            'authors',
            'id',
            'CASCADE'
        );
    }

    public function down()
    {
        // drops foreign key for table `authors`
        $this->dropForeignKey(
            'fk-book-author_id',
            'books'
        );

        $this->dropTable('{{%books}}');
    }
}
