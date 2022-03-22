<?php
namespace PaintingTheme\Zipcode\Model\Source;
use PaintingTheme\Zipcode\Model\ZipcodeFactory;

class Category implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * Retrieve options array.
     *
     * @return array
     */

    protected $_zipcodeFactory;
    public function toOptionArray()
    {
        
        $result = [];

        foreach (self::getOptionArray() as $index => $value) {
            $result[] = ['value' => $index, 'label' => $value];
        }

        return $result;
    }

    /**
     * Retrieve option array
     *
     * @return string[]
     */
    public static function getOptionArray()
    {
        return [1 => __('science'),
                2 => __('Algebra'),
                3 => __('Geomatry')                 ];
    }

   
    
}