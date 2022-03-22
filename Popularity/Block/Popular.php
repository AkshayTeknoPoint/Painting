<?php

namespace PaintingTheme\Popularity\Block;
class Popular extends \Magento\Framework\View\Element\Template{

    protected $productsFactory;
    protected $_storeManager;

	public function __construct(
    	\Magento\Catalog\Block\Product\Context $context,
    	\Magento\Reports\Model\ResourceModel\Product\CollectionFactory $productsFactory,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
    	array $data = []
	) {
    	$this->_productsFactory = $productsFactory;
        $this->_storeManager = $storeManager;
    	parent::__construct($context, $data);
	}

	public function getProductCollection()
    {
        $currentStoreId = $this->_storeManager->getStore()->getId();

        $collection = $this->_productsFactory->create()
                           ->addAttributeToSelect('*')
                           ->addViewsCount()
                           ->setStoreId($currentStoreId)
                           ->addStoreFilter($currentStoreId);

	    return $collection->getItems();
    }
   
	
}