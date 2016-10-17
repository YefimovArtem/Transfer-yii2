<?php

use yii\db\Migration;
use yii\db\Schema;

class m161017_030550_dump extends Migration
{

    public function up()
    {
        $this->createTable('{{%users}}', [
            'id' => Schema::TYPE_INTEGER . "(10) UNSIGNED NOT NULL AUTO_INCREMENT",
            'name' => Schema::TYPE_STRING . "(255) NOT NULL",
            'balance' => Schema::TYPE_DECIMAL . "(10,2) NOT NULL",
            'PRIMARY KEY (id)',
        ], $this->tableOptions);


        $this->batchInsert('{{%users}}', ['id', 'name', 'balance'], [
            [1, 'Jacob', '283297.56'],
            [2, 'Madison', '123225.05'],
            [3, 'Christopher', '531320.83'],
            [4, 'Kayla', '232323.27'],
            [5, 'John', '33233.29'],
        ]);
    }


}
