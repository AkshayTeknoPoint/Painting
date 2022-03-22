<?php
 
namespace PaintingTheme\Zipcode\Model;

use Magento\Framework\Model\AbstractModel;
 
class Zipcode extends AbstractModel
{
    protected function _construct()
    {
        $this-> _init('PaintingTheme\Zipcode\Model\ResourceModel\Zipcode');
        // Path Of the ResourceModel
    }
}