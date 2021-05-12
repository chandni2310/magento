<?php

$this->startSetup();

$this->addEntityType(Ccc_Example_Model_Resource_Example::ENTITY, [
    'entity_model'                => 'example/example',
    'attribute_model'             => 'example/attribute',
    'table'                       => 'example/example',
    'increment_per_store'         => '0',
    'additional_attribute_table'  => 'example/eav_attribute',
    'entity_attribute_collection' => 'example/example_attribute_collection',
]);

$this->createEntityTables('example');
$this->installEntities();

$default_attribute_set_id = Mage::getModel('eav/entity_setup', 'core_setup')
    						->getAttributeSetId('example', 'Default');

$this->run("UPDATE `eav_entity_type` SET `default_attribute_set_id` = {$default_attribute_set_id} WHERE `entity_type_code` = 'example'");

$this->endSetup();
