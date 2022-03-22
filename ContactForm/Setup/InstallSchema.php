<?php

namespace PaintingTheme\ContactForm\Setup;

use Magento\Framework\Db\Ddl\Table;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class InstallSchema implements InstallSchemaInterface
{
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();
        $table = $setup->getConnection()->newTable(
            $setup->getTable('student_detail')
        )->addColumn(
            'id',
            Table::TYPE_INTEGER,
            null,
            ['identity' => true, 'nullable' => false, 'primary' => true],
            'ID'
        )->addColumn(
            'firstname',
            Table::TYPE_TEXT,
            255,
            ['nullable' => false],
            'First Name'
        )->addColumn(
            'lastname',
            Table::TYPE_TEXT,
            255,
            ['nullable' => false],
            'Last Name'
        )->addColumn(
            'mobile',
            Table::TYPE_TEXT,
            255,
            ['nullable' => false],
            'Mobile Number'
        )->addColumn(
            'address',
            Table::TYPE_TEXT,
            255,
            ['nullable' => false],
            'Address'
        )->addColumn(
                'created_at',
                Table::TYPE_TIMESTAMP,
                null,
                ['nullable'=>false, 'default'=>Table::TIMESTAMP_INIT],
                'TIME CREATED'
        )->addColumn(
                'updated_at',
                Table::TYPE_TIMESTAMP,
                null,
                ['nullable'=>false, 'default'=>Table::TIMESTAMP_INIT_UPDATE],
                'TIME FOR UPDATE'
        )->setComment(
            'student detail'

        );

        $setup->getConnection()->createTable($table);

        $setup->endSetup();
    }
}
