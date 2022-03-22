<?php

namespace PaintingTheme\ProductAttribute\Model\Config;

use Magento\Eav\Model\Entity\Attribute\Source\AbstractSource;

class Surface extends AbstractSource
{
    public function getAllOptions()
    {
        $this->_options = [
            ['label'=> ('Canvas Paintings'), 'value'=>'canvas paintings'],
            ['label'=> ('Paper Paintings'), 'value'=>'paper paintings'],
            ['label'=> ('Cloth/Silk Paintings'), 'value'=>'cloth/silk paintings'],
        ];
        return $this->_options;
    }
}