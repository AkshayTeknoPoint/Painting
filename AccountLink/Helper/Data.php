<?php
namespace Paintingtheme\AccountLink\Helper;

class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
	protected $_ProfilePic;

	public function __construct(
		\Paintingtheme\AccountLink\Block\Customer\Account\ProfilePic $ProfilePic
	){
		$this->_ProfilePic = $ProfilePic;
	}

	public function getProfilePicById(){
		return $this->_ProfilePic->getProfilePic();
	}
}