<?php
namespace PaintingTheme\Zipcode\Model\ResourceModel\Zipcode;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init('PaintingTheme\Zipcode\Model\Zipcode','PaintingTheme\Zipcode\Model\ResourceModel\Zipcode');
    }
    
}