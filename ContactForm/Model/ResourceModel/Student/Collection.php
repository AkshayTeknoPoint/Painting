<?php
namespace PaintingTheme\ContactForm\Model\ResourceModel\Student;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init('PaintingTheme\ContactForm\Model\Student','PaintingTheme\ContactForm\Model\ResourceModel\Student');
    }
    
}