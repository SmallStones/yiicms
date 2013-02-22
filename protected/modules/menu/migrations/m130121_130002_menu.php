<?php

class m130121_130002_menu extends EDbMigration
{
    public function safeUp()
    {
        $options = Yii::app()->db->schema instanceof CMysqlSchema ? 'ENGINE=InnoDB DEFAULT CHARSET=utf8' : '';

        $this->createTable('{{menu}}', array(
                'id'             => 'pk',
                'root'           => 'integer NOT NULL',
                'lft'            => 'integer NOT NULL',
                'rgt'            => 'integer NOT NULL',
                'level'          => 'tinyint(127) unsigned NOT NULL',
                'code'           => 'varchar(20) NOT NULL',
                'title'          => 'varchar(100) NOT NULL',
                'href'           => 'varchar(200) NOT NULL',
                'type'           => 'tinyint(3) unsigned NOT NULL DEFAULT "1"',
                'access'         => 'varchar(50) DEFAULT NULL',
                'status'         => 'boolean NOT NULL DEFAULT "1"',
                'create_user_id' => 'integer NOT NULL',
                'update_user_id' => 'integer DEFAULT NULL',
                'create_time'    => 'timestamp NULL DEFAULT NULL',
                'update_time'    => 'timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
            ),
            $options
        );
        $this->createIndex('ix_{{menu}}_status', '{{menu}}', 'status', false);
        $this->createIndex('ix_{{menu}}_create_user_id', '{{menu}}', 'create_user_id', false);
        $this->createIndex('ix_{{menu}}_update_user_id', '{{menu}}', 'update_user_id', false);
        if ((Yii::app()->db->schema instanceof CSqliteSchema) == false) {
            $this->addForeignKey('fk_{{menu}}_{{user}}_create_user_id', '{{menu}}', 'create_user_id', '{{user}}', 'id', 'CASCADE', 'NO ACTION');
            $this->addForeignKey('fk_{{menu}}_{{user}}_update_user_id', '{{menu}}', 'update_user_id', '{{user}}', 'id', 'CASCADE', 'NO ACTION');
        }
        //menu category
        $this->insert('{{menu}}', array(
                'root'           => 1,
                'lft'            => 1,
                'rgt'            => 4,
                'level'          => 1,
                'code'           => 'top',
                'title'          => Yii::t('menu', 'Верхнее меню'),
                'type'           => 1,
                'create_user_id' => 1,
                'create_time'    => new CDbExpression('NOW()'),
        ));
        //menu link to index page item
        $this->insert('{{menu}}', array(
                'root'           => 1,
                'lft'            => 2,
                'rgt'            => 3,
                'level'          => 2,
                'title'          => Yii::t('zii', 'Home'),
                'href'           => '/page/index/',
                'type'           => 1,
                'create_user_id' => 1,
                'create_time'    => new CDbExpression('NOW()'),
            ));
    }

    public function safeDown()
    {
        $this->dropTable('{{menu}}');
    }
}