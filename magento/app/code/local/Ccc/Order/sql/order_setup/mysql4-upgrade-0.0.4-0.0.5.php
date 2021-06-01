<?php

$installer = $this;
$installer->startSetup();
$installer->run("
    ALTER TABLE {$this->getTable('cart')}
    ADD COLUMN `shipping_method` VARCHAR(255) NOT NULL;
    ");
$installer->run("
    ALTER TABLE {$this->getTable('cart')}
    ADD COLUMN `payment_method` VARCHAR(255) NOT NULL;
    ");
$installer->endSetup();