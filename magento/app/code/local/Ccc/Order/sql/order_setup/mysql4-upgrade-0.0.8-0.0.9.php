<?php
$installer = $this;
$installer->startSetup();


$installer->getConnection()
->addColumn($installer->getTable('order'),'total', array(
    'type'      => Varien_Db_Ddl_Table::TYPE_INTEGER,
    'nullable'  => false,
    'comment'   => 'Total'
    ));   


$installer->endSetup();
