<?php
namespace PaintingTheme\ContactForm\Model\ResourceModel;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Magento\Framework\Model\ResourceModel\Db\Context;


class Student extends AbstractDb
{
	
	public function __construct(Context $context)
	{
		parent::__construct($context);
	}
	
	protected function _construct()
	{
		$this->_init('student_detail', 'id');
	}
	
}