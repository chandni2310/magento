<?php

$installer = $this;

$installer->startSetup();

$table = $installer->getConnection()
    ->newTable($installer->getTable('order/cart'))
    ->addColumn('cart_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'identity' => true,
        'nullable' => false,
        'primary' => true,
    ),'Cart Id')
    ->addColumn('session_id', Varien_Db_Ddl_Table::TYPE_TEXT, null, array(
        'unsigned' => true,
        'nullable' => true,
    ),'Session Id')
    ->addColumn('customer_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'unsigned' => true,
        'nullable' => false,
    ),'Customer Id')
    
    ->addColumn('total', Varien_Db_Ddl_Table::TYPE_DECIMAL, null, array(
    ),'Total')
    ->addColumn('discount', Varien_Db_Ddl_Table::TYPE_DECIMAL, null, array(
    ),'Discount')

    ->addColumn('payment_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'unsigned' => true,
        'nullable' => false,
    ),'Payment Id')
    ->addColumn('shipping_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'unsigned' => true,
        'nullable' => false,
    ),'Shipping Id')

    ->addColumn('shipping_amount', Varien_Db_Ddl_Table::TYPE_DECIMAL, null, array(
        'unsigned' => true,
        'nullable' => false,
    ),'Shipping Amount')
    
    ->addColumn('created_at', Varien_Db_Ddl_Table::TYPE_DATETIME, null, array(
        'unsigned' => true,
        'nullable' => false,
    ),'Created At');

$installer->getConnection()->createTable($table);


$cartTable = $installer->getConnection()
    ->newTable($installer->getTable('order/cart_address'))
    ->addColumn('cart_address_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'identity' => true,
        'nullable' => false,
        'primary' => true,
    ))
    ->addColumn('cart_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'nullable' => false,
    ))
    ->addColumn('address_id',  Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'nullable' => true,
    ))
    ->addColumn('address_type', Varien_Db_Ddl_Table::TYPE_TEXT, null, array(
        'nullable' => false,
    ))
    ->addColumn('address', Varien_Db_Ddl_Table::TYPE_TEXT, null, array(
        'nullable' => false,
    ))
    ->addColumn('city', Varien_Db_Ddl_Table::TYPE_TEXT, null, array(
        'nullable' => false,
    ))
    ->addColumn('state', Varien_Db_Ddl_Table::TYPE_TEXT, null, array(
        'nullable' => false,
    ))
    ->addColumn('country', Varien_Db_Ddl_Table::TYPE_TEXT, null, array(
        'nullable' => false,
    ))
    ->addColumn('zipcode', Varien_Db_Ddl_Table::TYPE_TEXT, null, array(
        'nullable' => false,
    ))
    ->addColumn('same_as_billing', Varien_Db_Ddl_Table::TYPE_TINYINT, null, array(
        'nullable' => true,
    ))
    
    ->addForeignKey(
        $installer->getFkName(
            'order/cart_address',
            'address_id',
            'customer/address_entity',
            'entity_id'
        ),
        'address_id', $installer->getTable('customer/address_entity'), 'entity_id',
        Varien_Db_Ddl_Table::ACTION_CASCADE, 
        Varien_Db_Ddl_Table::ACTION_CASCADE)

        ->addForeignKey(
            $installer->getFkName(
                'order/cart_address',
                'cart_id',
                'order/cart',
                'cart_id'
            ),
            'cart_id', $installer->getTable('order/cart'), 'cart_id',
            Varien_Db_Ddl_Table::ACTION_CASCADE, 
            Varien_Db_Ddl_Table::ACTION_CASCADE);

$installer->getConnection()->createTable($cartTable);

$itemTable = $installer->getConnection()
    ->newTable($installer->getTable('order/cart_item'))
    ->addColumn('cart_item_id',Varien_Db_Ddl_Table::TYPE_SMALLINT,null,array(
        'unsigned' => true,
        'nullable' => false,
        'primary' => true,
        'identity' =>true
    ))
    ->addColumn('cart_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'nullable' => false,
    ))
    ->addColumn('product_id',  Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'nullable' => false,
    ))
    ->addColumn('quantity',  Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'nullable' => false,
    ))
    ->addColumn('base_price',  Varien_Db_Ddl_Table::TYPE_DECIMAL, null, array(
        'nullable' => false,
    ))
    ->addColumn('price',  Varien_Db_Ddl_Table::TYPE_DECIMAL, null, array(
        'nullable' => false,
    ))
    ->addColumn('discount',  Varien_Db_Ddl_Table::TYPE_DECIMAL, null, array(
        'nullable' => false,
    ))
    ->addColumn('created_at',  Varien_Db_Ddl_Table::TYPE_DATETIME, null, array(
        'nullable' => false,
    ))

    ->addForeignKey(
        $installer->getFkName(
            'order/cart_item',
            'product_id',
            'catalog/product',
            'entity_id'
        ),
        'product_id', $installer->getTable('catalog/product'), 'entity_id',
        Varien_Db_Ddl_Table::ACTION_CASCADE, 
        Varien_Db_Ddl_Table::ACTION_CASCADE)

        ->addForeignKey(
            $installer->getFkName(
                'order/cart_item',
                'cart_id',
                'order/cart',
                'cart_id'
            ),
            'cart_id', $installer->getTable('order/cart'), 'cart_id',
            Varien_Db_Ddl_Table::ACTION_CASCADE, 
            Varien_Db_Ddl_Table::ACTION_CASCADE);
            
$installer->getConnection()->createTable($itemTable);

$installer->endSetup();