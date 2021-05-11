<?php

$installer = $this;
$installer->startSetup();

$table = $installer->getConnection()
    ->newTable($installer->getTable('user/user'))
    ->addColumn(
        'user_id',
        Varien_Db_Ddl_Table::TYPE_INTEGER,
        null,
        array(
            'identity' => true,
            'nullable' => false,
            'primary' => true,
        ),
        'User Id'
    )
    ->addColumn(
        'user_name',
        Varien_Db_Ddl_Table::TYPE_TEXT,
        null,
        array(
            'nullable' => true,
        ),
        'User Name'
    );

$installer->getConnection()->createTable($table);
$installer->endSetup();


/* $installer->run("
— DROP TABLE IF EXISTS {$this->getTable('user')};
CREATE TABLE {$this->getTable('user')} (
`user_id` int(11) unsigned NOT NULL auto_increment,
`userName` varchar(255) NOT NULL default ”,
`status` smallint(6) NOT NULL default '0',
`created_time` datetime NULL,
`update_time` datetime NULL,
PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
"); */