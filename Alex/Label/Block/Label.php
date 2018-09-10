<?php

namespace Alex\Label\Block;

class Label extends \Magento\Framework\View\Element\Template {

    /**
     * Core registry
     *
     * @var \Magento\Framework\Registry
     */
    protected $_coreRegistry;

    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param array $data
     */
    public function __construct(
    \Magento\Framework\View\Element\Template\Context $context, \Magento\Framework\Registry $registry, array $data = []
    ) {
        $this->_coreRegistry = $registry;
        parent::__construct($context, $data);
    }

    /**
     * Get current product
     *
     * @return null|object
     */
    public function getProduct() {
        $product = $this->_coreRegistry->registry('product');
        if (is_null($product)) {
            $product = $this->_coreRegistry->registry('current_product');
        }
        return $product;
    }

    /**
     * Get values of badge label attribute of current product
     * @return string
     */
    public function getLabels() {
        $product = $this->getProduct();
        if (!empty($product) && $product->getId()) {
            $labels = $product->getResource()->getAttribute('badge_label')->getFrontend()->getValue($product);
        } else {
            $labels = '';
        }
        return $labels;
    }

}
