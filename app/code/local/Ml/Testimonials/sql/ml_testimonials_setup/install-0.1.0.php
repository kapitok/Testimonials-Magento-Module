<?php
/**
 * Create testimonials table
 */
$installer = $this;

/* @var $installer Mage_Core_Model_Resource_Setup */
$installer->startSetup();

$connection = $installer->getConnection();

$table =
    $connection
        ->newTable($installer->getTable('ml_testimonials/testimonials'))
        ->addColumn ('testimonial_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array (
            'identity'  => true,
            'unsigned'  => true,
            'nullable'  => false,
            'primary'   => true,
        ), 'Id')
        ->addColumn('customer_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array (
            'nullable'  => false,
        ), 'Magento Customer Id')
        ->addColumn('store_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array (
            'unsigned'  => true,
            'nullable'  => true,
        ), 'Store ID')
        ->addColumn('customer_email', Varien_Db_Ddl_Table::TYPE_VARCHAR, null, array (
            'nullable'  => false,
        ), 'Title')
        ->addColumn('description', Varien_Db_Ddl_Table::TYPE_TEXT, null, array (
            'nullable'  => false,
        ), 'Description')
        ->addColumn('is_active', Varien_Db_Ddl_Table::TYPE_BOOLEAN, null, array (
            'nullable'  => false,
            'default'   => true,
        ), 'Is Active')
        ->addColumn('created_at', Varien_Db_Ddl_Table::TYPE_TIMESTAMP, null, array (
            'nullable'  => true,
            'default'   => Varien_Db_Ddl_Table::TIMESTAMP_INIT
        ), 'Created Time')
        ->addColumn('updated_at', Varien_Db_Ddl_Table::TYPE_TIMESTAMP, null, array (
            'nullable'  => true,
        ), 'Updated Time')
        ->addForeignKey(
            $installer->getFkName('ml_testimonials/testimonials', 'customer_id', 'customer/entity', 'entity_id'),
            'customer_id',
            $installer->getTable('customer/entity'),
            'entity_id',
            Varien_Db_Ddl_Table::ACTION_CASCADE,
            Varien_Db_Ddl_Table::ACTION_CASCADE
        );

$installer->getConnection()->createTable($table);

$installer->endSetup();
