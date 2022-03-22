<?php
 
namespace PaintingTheme\ContactForm\Model;

use Magento\Framework\Model\AbstractModel;
 
class Student extends AbstractModel
{
    protected function _construct()
    {
        $this-> _init('PaintingTheme\ContactForm\Model\ResourceModel\Student');
        // Path Of the ResourceModel
    }
}