<?php
namespace PaintingTheme\Zipcode\Model\Source;
use PaintingTheme\Zipcode\Model\ZipcodeFactory;

class Test implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * Retrieve options array.
     *
     * @return array
     */
    protected $_zipcodeFactory;

	public function __construct(
        ZipcodeFactory $zipcodeFactory)
	{
		
        $this->_zipcodeFactory = $zipcodeFactory;
		//parent::__construct($context);
	}



    public function toOptionArray()
    {
        $zipcode = $this->_zipcodeFactory->create();
        $collection = $zipcode->getCollection();
        $data = $collection->getData();
        
        $result = [];

        foreach ($data as $item) {
            $result[] = ['value' => $item['country'], 'label' => $item['state']];
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





























