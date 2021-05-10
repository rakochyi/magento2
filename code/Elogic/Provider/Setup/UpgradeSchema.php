<?php

namespace Elogic\Provider\Setup;

use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\UpgradeSchemaInterface;

class UpgradeSchema implements UpgradeSchemaInterface
{
    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        if (version_compare($context->getVersion(), '0.2.0', '<')) {

            $tableName = $setup->getTable('elogic_providers');
            $setup->getConnection()->addColumn($tableName, 'logo', [
                'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                'length'    => 1000,
                'nullable' => false,
                'comment' => 'Logo'
            ]);
        } else if (version_compare($context->getVersion(), '0.3.0', '<')) {

            /**
             * Add full text index to our table department
             */

            $tableName = $setup->getTable('elogic_providers');
            $fullTextIntext = ['name', 'description'];
            $setup->getConnection()->addIndex(
                $tableName,
                $setup->getIdxName($tableName, $fullTextIntext, \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT),
                $fullTextIntext,
                \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
            );
        }
        $setup->endSetup();
    }
}
