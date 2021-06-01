<?php
$installer = $this;
$installer->startSetup();
$installer->run("ALTER TABLE {$installer->getTable('order/cart_item')} DROP FOREIGN KEY  `FK_CART_ITEM_PRODUCT_ID_CATALOG_PRODUCT_ENTITY_ENTITY_ID`");
$installer->run("ALTER TABLE {$installer->getTable('order/cart_item')} DROP COLUMN product_id");
$installer->run("
    ALTER TABLE {$this->getTable('order/cart_item')}
    ADD COLUMN `product_id` INT(11) NOT NULL;
    ");
$installer->endSetup();