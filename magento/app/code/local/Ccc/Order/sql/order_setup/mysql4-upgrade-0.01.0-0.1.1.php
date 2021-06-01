<?php
$installer = $this;
$installer->startSetup();



$installer->getConnection()
->addColumn($installer->getTable('order_address'),'address_id', array(
    'type'      => Varien_Db_Ddl_Table::TYPE_INTEGER,
    'nullable'  => false,
    'comment'   => 'address id'
    ));   





$installer->endSetup();
