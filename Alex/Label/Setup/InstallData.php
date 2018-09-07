<?php

namespace Alex\Label\Setup;

use Magento\Eav\Setup\EavSetup;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class InstallData implements InstallDataInterface {

    private $eavSetupFactory;
    private $logger;
    private $eavAttribute;

    public function __construct(EavSetupFactory $eavSetupFactory, \Psr\Log\LoggerInterface $logger, \Magento\Eav\Model\ResourceModel\Entity\Attribute $eavAttribute) {
        $this->eavSetupFactory = $eavSetupFactory;
        $this->logger = $logger;
        $this->eavAttribute = $eavAttribute;
    }

    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context) {
        $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);
        $entityTypeId = \Magento\Catalog\Model\Product::ENTITY;
        $eavSetup->addAttribute(
                $entityTypeId, 'badge_label', [
            'type' => 'varchar',
            'backend' => \Magento\Eav\Model\Entity\Attribute\Backend\ArrayBackend::class,
            'frontend' => '',
            'label' => 'Badge Label',
            'input' => 'multiselect',
            'class' => '',
            'source' => '',
            'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_GLOBAL,
            'visible' => true,
            'required' => false,
            'user_defined' => true, //false
            'default' => null,
            'searchable' => false,
            'filterable' => false,
            'comparable' => false,
            'visible_on_front' => false,
            'used_in_product_listing' => true,
            'unique' => false,
            'apply_to' => '',
            'option' => ['values' => ['Sale', 'Free Shipping', 'Best Seller']],
                ]
        );
        // get attribute id
        $attributeId = $this->eavAttribute->getIdByCode($entityTypeId, 'badge_label');
        // add attribute to default attribute set
        $attributeSetId = $eavSetup->getDefaultAttributeSetId($entityTypeId);
        $attributeGroupId = $eavSetup->getDefaultAttributeGroupId($entityTypeId, $attributeSetId);
        $eavSetup->addAttributeToGroup(
                $entityTypeId, $attributeSetId, $attributeGroupId, $attributeId, '999'  //sort_order
        );
        $this->logger->info("attribute id = $attributeId");
    }

}
