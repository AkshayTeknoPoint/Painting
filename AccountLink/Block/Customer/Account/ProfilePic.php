<?php

namespace Paintingtheme\AccountLink\Block\Customer\Account;

use \Magento\Framework\View\Element\Template;
use \Magento\Framework\View\Element\Template\Context;
use \Magento\Customer\Model\Session;
use \Magento\Customer\Model\Customer;

class ProfilePic extends Template
{
	protected $session;
    protected $customer;
    
	public function __construct(
			Context $context,
			Session $session,
			Customer $customer,
			array $data = []
		){
		$this->session = $session;
		$this->customer = $customer;
		parent::__construct($context, $data);
	}
	
	public function getCustomer($id = false){
		
		if($id){
			$this->customer->load($id);
		}

		elseif($this->session && $this->session->getData('customer_id')){
			$this->customer->load($this->session->getData('customer_id'));
		}
		
		return $this->customer;
	}
	
	public function getSession(){
		// var_dump(dirname(dirname(dirname(__DIR__))));
		return $this->session;
	}
	
	public function getProfilePic(){
		$url = $this->getViewFileUrl('PaintingTheme_AccountLink/media/default.jpg');
		if($this->getCustomer()->getData('customer_pic')){
			$objectManager = \Magento\Framework\App\ObjectManager::getInstance();
			$fileSystem = $objectManager->get('\Magento\Framework\Filesystem');
			$mediaDir = $fileSystem->getDirectoryRead(\Magento\Framework\App\Filesystem\DirectoryList::ROOT)->getAbsolutePath().'pub/media/';
			if(file_exists($mediaDir.'customer_pic/'.$this->getCustomer()->getData('customer_pic'))){
				$storeManager = $objectManager->get('\Magento\Store\Model\StoreManagerInterface');
				$url = $storeManager->getStore()->getBaseUrl().'pub/media/customer_pic/'.$this->getCustomer()->getData('customer_pic');
			}
		}
		return $url;
	}
}