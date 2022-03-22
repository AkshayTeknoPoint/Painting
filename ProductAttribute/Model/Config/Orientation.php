<?php

namespace PaintingTheme\ProductAttribute\Model\Config;

use Magento\Eav\Model\Entity\Attribute\Source\AbstractSource;

class Orientation extends AbstractSource
{
    public function getAllOptions()
    {
        $this->_options = [
            ['label'=> ('Horizontal Paintings'), 'value'=>'horintal paintings'],
            ['label'=> ('Vertical Paintings'), 'value'=>'vertical paintings'],
            ['label'=> ('Square Paintings'), 'value'=>'square paintings'],
            ['label'=> ('Round Paintings'), 'value'=>'round paintings'],
        ];
        return $this->_options;
    }
}