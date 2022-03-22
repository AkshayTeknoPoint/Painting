<?php
namespace PaintingTheme\Zipcode\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Magento\Framework\Model\ResourceModel\Db\Context;


class Zipcode extends AbstractDb
{
	
	public function __construct(Context $context)
	{
		parent::__construct($context);
	}
	
	protected function _construct()
	{
		$this->_init('zipcode', 'id');
	}
	
}