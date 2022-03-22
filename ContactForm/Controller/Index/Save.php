<?php

namespace PaintingTheme\ContactForm\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use PaintingTheme\ContactForm\Model\StudentFactory;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Session\SessionManagerInterface;
use PaintingTheme\ContactForm\Helper\Data;

class Save extends Action
{

    protected $_studentFactory;
    protected $resultPageFactory;
    protected $_sessionManager;
    protected $helper;

    public function __construct(
        Data $helper,
        Context $context,
        StudentFactory $modelstudentFactory,
        PageFactory  $resultPageFactory,
        SessionManagerInterface $sessionManager
    ) {
        parent::__construct($context);
        $this->_studentFactory = $modelstudentFactory;
        $this->resultPageFactory = $resultPageFactory;
        $this->_sessionManager = $sessionManager;
        $this->helper = $helper;
    }

    public function execute()
    {
        $StudentModel       = $this->_studentFactory->create();
        $data               = $this->getRequest()->getPost();

        $StudentModel->setData('firstname', $data['firstname']);
        $StudentModel->setData('lastname', $data['lastname']);
        $StudentModel->setData('mobile', $data['mobile']);
        $StudentModel->setData('address', $data['address']);

        $StudentModel->save();   // Save Databse 
        $this->helper->flushCache();
        $this->_redirect('*/*/show');
        $this->messageManager->addSuccess(__('Data has been saved.'));
        
        
    }
}
