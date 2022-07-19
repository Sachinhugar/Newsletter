<?php
 
namespace News\Letter\Setup;
 
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Setup\Exception;
 
class InstallSchema implements InstallSchemaInterface
{
    
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;
 
        $installer->startSetup();
        try {
            $table = $installer->getConnection()->newTable(
                $installer->getTable('news_email')
            )->addColumn(
                'id',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null,
                ['identity' => true, 'nullable' => false, 'primary' => true],
                'Record Id'
            )->addColumn(
                'email',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                '255',
                ['nullable' => false],
                'Email'
            )->setComment(
                'Data Table'
            );
 
            $installer->getConnection()->createTable($table);
            $installer->endSetup();
        } catch (Exception $err) {
            \Magento\Framework\App\ObjectManager::getInstance()->get('Psr\Log\LoggerInterface')->info($err->getMessage());
        }
    }
}