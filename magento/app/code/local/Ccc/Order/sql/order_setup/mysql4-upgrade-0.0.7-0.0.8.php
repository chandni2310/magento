<?php
$installer = $this;
$installer->startSetup();

$installer->run("
ALTER TABLE {$this->getTable('order_item')}
    CHANGE `base_Price` `base_price` text;
");
$installer->run("
ALTER TABLE {$this->getTable('order_item')}
    CHANGE `priColumnName` `price` decimal(12,4);
");

$installer->getConnection()
->addColumn($installer->getTable('order_item'),'created_at', array(
    'type'      => Varien_Db_Ddl_Table::TYPE_DATETIME,
    'nullable'  => false,
    'comment'   => 'Created At'
    ));   





$installer->endSetup();
