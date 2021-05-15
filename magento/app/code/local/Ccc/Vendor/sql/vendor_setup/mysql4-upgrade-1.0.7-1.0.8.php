<?php 
$installer = $this;

$installer->startSetup();

$tableName = $installer->getTable('vendor/vendor_product_group_name');
$table = $installer->getConnection()
    ->newTable($tableName)
    ->addColumn('entity_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'identity' => true,
        'primary' => true,
        'nullable' => false
    ), 'Id')
    ->addColumn('vendor_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'nullable' => true,
        'default' => NULL,
        'unsigned'  => true,
    ), 'Vendor Id')
    ->addColumn('name', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
        'nullable' => false, 'Group Name'
    ))
    ->addIndex($tableName, array('vendor_id'), array('vendor_id'))
    ->addForeignKey(
        $installer->getFkName('vendor/vendor_product_group_name', 'vendor_id', 'vendor/vendor', 'entity_id'),
        'vendor_id',
        $installer->getTable('vendor/vendor'),
        'entity_id',
        Varien_Db_Ddl_Table::ACTION_CASCADE,
        Varien_Db_Ddl_Table::ACTION_CASCADE
    )
    ->setComment('Group Vendor Orignal Name');

$installer->getConnection()->createTable($table);
$installer->getConnection()->addColumn($installer->getTable('vendor/vendor_product_group_name'), "attribute_group_id", "int( 10 ) UNSIGNED  NULL DEFAULT '0'
");


$installer->getConnection()->addForeignKey(
    $installer->getFkName('vendor/vendor_product_group_name', 'attribute_group_id', 'eav/attribute_group', 'attribute_group_id'),
    $installer->getTable('vendor/vendor_product_group_name'),
    'attribute_group_id',
    $installer->getTable('eav/attribute_group'),
    'attribute_group_id'
);

$installer->endSetup();


?>