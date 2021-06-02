<?php
$installer = $this;
$installer->startSetup();
$installer->run("

-- DROP TABLE IF EXISTS {$this->getTable('order_address')};
-- DROP TABLE IF EXISTS {$this->getTable('order_item')};
");
$tableName = $installer->getTable('order/order_address');
$table = $installer->getConnection()
    ->newTable($tableName)
    ->addColumn('order_address_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'identity' => true,
        'primary' => true,
        'nullable' => false
    ), 'Id')
    ->addColumn('order_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'nullable' => true,
        'default' => NULL,
    ), 'Order Id')
    ->addColumn('address_type', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
    ),'Address Type')
    ->addColumn('address', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
    ),'address')
    ->addColumn('city', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
    ),'City')
     ->addColumn('state', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
    ),'State')
    ->addColumn('country', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
    ),'Country')
    ->addColumn('zipcode', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
    ),'Zipcode')
     ->addColumn('same_as_billing', Varien_Db_Ddl_Table::TYPE_SMALLINT, 1, array(
    ),'Same As Billing')
   


    ->addIndex($tableName, array('order_id'), array('order_id'))
    ->addForeignKey(
        $installer->getFkName('order/order_address', 'order_id', 'order/order', 'order_id'),
        'order_id',
        $installer->getTable('order/order'),
        'order_id',
        Varien_Db_Ddl_Table::ACTION_CASCADE,
        Varien_Db_Ddl_Table::ACTION_CASCADE
    )
    ->setComment('Order Address table');

$installer->getConnection()->createTable($table);

//$tableName = $installer->getTable('order/order_address');
$table = $installer->getConnection()
    ->newTable($installer->getTable('order/order_item'))
    ->addColumn('order_item_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'identity' => true,
        'primary' => true,
        'nullable' => false
    ), 'Id')
    ->addColumn('order_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'nullable' => true,
        'default' => NULL,
    ), 'Order Id')
    ->addColumn('product_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'nullable' => true,
        'default' => NULL,
    ), 'Product Id')
    ->addColumn('sku', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
    ),'SKU')
    ->addColumn('name', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
    ),'Product Name')
    ->addColumn('quantity', Varien_Db_Ddl_Table::TYPE_INTEGER, 10, array(
    ), 'Quantity')
    ->addColumn('base_Price', Varien_Db_Ddl_Table::TYPE_DECIMAL, '12,4', array(
    ),'Base Price')
    ->addColumn('priColumnName', Varien_Db_Ddl_Table::TYPE_DECIMAL, '12,4', array(
    ),'Price')
    ->addColumn('discount', Varien_Db_Ddl_Table::TYPE_INTEGER, 10, array(
    ), 'Discount')
    ->addColumn('city', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
    ),'City')
     ->addColumn('state', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
    ),'State')
    ->addColumn('country', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
    ),'Country')
    ->addColumn('zipcode', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
    ),'Zipcode')
     ->addColumn('same_as_billing', Varien_Db_Ddl_Table::TYPE_SMALLINT, 1, array(
    ),'Same As Billing')
   


    ->addIndex($tableName, array('order_id'), array('order_id'))
    ->addForeignKey(
        $installer->getFkName('order/order_item', 'order_id', 'order/order', 'order_id'),
        'order_id',
        $installer->getTable('order/order'),
        'order_id',
        Varien_Db_Ddl_Table::ACTION_CASCADE,
        Varien_Db_Ddl_Table::ACTION_CASCADE
    )
    ->setComment('Order Item table');

$installer->getConnection()->createTable($table);





$installer->endSetup();
?>