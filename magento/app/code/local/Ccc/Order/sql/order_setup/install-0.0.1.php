<?php
$installer = $this;
$installer->startSetup();
$installer->run("

-- DROP TABLE IF EXISTS {$this->getTable('order/order')};
-- DROP TABLE IF EXISTS {$this->getTable('order/order_item')};
-- DROP TABLE IF EXISTS {$this->getTable('order/order_address')};
-- DROP TABLE IF EXISTS {$this->getTable('order/cart')};
-- DROP TABLE IF EXISTS {$this->getTable('order/cart_item')};
-- DROP TABLE IF EXISTS {$this->getTable('order/cart_address')};


");
$tableName = $installer->getTable('order/order');
$table = $installer->getConnection()
    ->newTable($tableName)
    ->addColumn('order_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'identity' => true,
        'primary' => true,
        'nullable' => false
    ), 'Id')
    ->addColumn('customer_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'nullable' => true,
        'default' => NULL,
        'unsigned'  => true,
    ), 'Customer Id')
    ->addColumn('customer_name', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
    ),'Customer Name')
    ->addColumn('customer_email', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
    ),'Customer Email')
    ->addColumn('shipping_id', Varien_Db_Ddl_Table::TYPE_INTEGER, 11, array(
    ),'Shipping Id')
    ->addColumn('shipping_method', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
    ),'Shipping Method')
    ->addColumn('shipping_amount', Varien_Db_Ddl_Table::TYPE_DECIMAL, '12,4', array(
    ),'Shipping Amount')
     ->addColumn('payment_id', Varien_Db_Ddl_Table::TYPE_INTEGER, 11, array(
    ),'Payment Id')
     ->addColumn('payment_method', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
    ),'Payment Method')
   


    ->addIndex($tableName, array('customer_id'), array('customer_id'))
    ->addForeignKey(
        $installer->getFkName('order/order', 'customer_id', 'customer/entity', 'entity_id'),
        'customer_id',
        $installer->getTable('customer/entity'),
        'entity_id',
        Varien_Db_Ddl_Table::ACTION_CASCADE,
        Varien_Db_Ddl_Table::ACTION_CASCADE
    )
    ->setComment('Order table');

$installer->getConnection()->createTable($table);



$installer->endSetup();
?>