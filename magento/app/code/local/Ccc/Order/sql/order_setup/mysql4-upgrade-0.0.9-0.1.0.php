<?php
$installer = $this;
$installer->startSetup();



$installer->getConnection()
->addColumn($installer->getTable('order'),'created_at', array(
    'type'      => Varien_Db_Ddl_Table::TYPE_DATETIME,
    'nullable'  => false,
    'comment'   => 'Created At'
    ));   





$installer->endSetup();
