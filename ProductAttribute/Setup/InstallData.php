<?php

namespace PaintingTheme\ProductAttribute\Setup;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;

class InstallData implements InstallDataInterface
{
    private $eavSetupFactory;
    public function __construct(EavSetupFactory $eavSetupFactory)
    {
        $this->eavSetupFactory = $eavSetupFactory;
    }
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();
        $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);
        $eavSetup->addAttribute(
            \Magento\Catalog\Model\Product::ENTITY,
            'orientation',
            [
                'group' => 'General',
                'type' => 'text',
                'global' =>\Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_GLOBAL,
                'visible' => true,
                'required' => false,
                'searchable' => false,
                'used_in_product_listing' => true,
                'label' => 'Orientation',
                'input' => 'select',
                'source' =>\PaintingTheme\ProductAttribute\Model\Config\Orientation::class
            ]

        );

        $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);
        $eavSetup->addAttribute(
            \Magento\Catalog\Model\Product::ENTITY,
            'size',
            [
                'group' => 'General',
                'type' => 'text',
                'global' =>\Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_GLOBAL,
                'visible' => true,
                'required' => false,
                'searchable' => false,
                'used_in_product_listing' => true,
                'label' => 'Size',
                'input' => 'select',
                'source' =>\PaintingTheme\ProductAttribute\Model\Config\Size::class
            ]

        );

        $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);
        $eavSetup->addAttribute(
            \Magento\Catalog\Model\Product::ENTITY,
            'surface',
            [
                'group' => 'General',
                'type' => 'text',
                'global' =>\Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_GLOBAL,
                'visible' => true,
                'required' => false,
                'searchable' => false,
                'used_in_product_listing' => true,
                'label' => 'Surface',
                'input' => 'select',
                'source' =>\PaintingTheme\ProductAttribute\Model\Config\Surface::class
            ]

        );

        $setup->endSetup();
    }
}