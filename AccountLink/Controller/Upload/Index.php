<?php

namespace Paintingtheme\AccountLink\Controller\Upload;

use \Magento\Framework\App\Action\Context;
use \Magento\Framework\View\Result\PageFactory;
use \Magento\Framework\App\Filesystem\DirectoryList;
use \Magento\Framework\Filesystem;

class Index extends \Magento\Framework\App\Action\Action
{
	protected $_resultPageFactory;

	protected $_profilePic;

	protected $allowedExtensions = ['png','jpeg','jpg','gif','svg'];

	protected $fileId = 'customer_pic';

	public function __construct(
		Context $context,
		PageFactory $resultPageFactory,
		\Paintingtheme\AccountLink\Block\Customer\Account\ProfilePic $profilePic
	){
		$this->_resultPageFactory = $resultPageFactory;
		$this->_profilePic = $profilePic;
		parent::__construct($context);
	}

	public function execute(){
		$resultPage = $this->_resultPageFactory->create();
		$customer = $this->_profilePic->getCustomer();
		if($customerId = $customer->getId()){
			$fileSystem = $this->_objectManager->create('\Magento\Framework\Filesystem');
			$mediaDir = $fileSystem->getDirectoryRead(\Magento\Framework\App\Filesystem\DirectoryList::ROOT)->getAbsolutePath().'pub/media/';
			if($customer->getData('customer_pic')){
				@unlink($mediaDir.'customer_pic/'.$customer->getData('customer_pic'));
				@rmdir($mediaDir.'customer_pic/'.$customer->getId());
			}
			$resource = $this->_objectManager->create('Magento\Framework\App\ResourceConnection');
			$table = $resource->getTableName('customer_entity');
			$write = $resource->getConnection($resource::DEFAULT_CONNECTION);
			try {
				$uploader = new \Magento\MediaStorage\Model\File\Uploader(
						$this->fileId,
						$this->_objectManager->create('Magento\MediaStorage\Helper\File\Storage\Database'),
						$this->_objectManager->create('Magento\MediaStorage\Helper\File\Storage'),
						$this->_objectManager->create('Magento\MediaStorage\Model\File\Validator\NotProtectedExtension')
					);
				$uploader->setAllowCreateFolders(true);
				$uploader->setAllowedExtensions($this->allowedExtensions);
				if ($uploader->save($mediaDir.'customer_pic/'.$customerId)) {
					$uploadedFileNameAndPath = $customerId.'/'.$uploader->getUploadedFileName();
					$write->query("UPDATE `{$table}` SET `customer_pic`='{$uploadedFileNameAndPath}' WHERE `entity_id`='{$customerId}'");
				}
			} catch (\Exception $e) {}
		}
		$this->_redirect('customer/account');
	}
}