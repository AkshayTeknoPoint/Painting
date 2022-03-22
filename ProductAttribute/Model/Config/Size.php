<?php

namespace PaintingTheme\ProductAttribute\Model\Config;

use Magento\Eav\Model\Entity\Attribute\Source\AbstractSource;

class Size extends AbstractSource
{
    public function getAllOptions()
    {
        $this->_options = [
            ['label'=> ('Small Paintings'), 'value'=>'small paintings'],
            ['label'=> ('Medium Paintings'), 'value'=>'medium paintings'],
            ['label'=> ('Large Paintings'), 'value'=>'large paintings'],
            ['label'=> ('Extra Large Paintings'), 'value'=>'extra large paintings'],
        ];
        return $this->_options;
    }
}