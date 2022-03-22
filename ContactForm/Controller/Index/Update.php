<?php

namespace PaintingTheme\ContactForm\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Request\Http;
use Magento\Framework\Registry;
use Magento\Framework\Session\SessionManagerInterface;
use Magento\Framework\View\Result\PageFactory;
use PaintingTheme\ContactForm\Model\StudentFactory;
use PaintingTheme\ContactForm\Helper\Data;

class Update extends Action
{

    protected $_studentFactory;
    protected $resultPageFactory;
    protected $_sessionManager;
    protected $_coreRegistry;
    protected $_request;
    protected $helper;

    public function __construct(
        Data $helper,
        Context $context,
        StudentFactory $modelstudentFactory,
        PageFactory $resultPageFactory,
        Registry $coreRegistry,
        Http $request,
        SessionManagerInterface $sessionManager
    ) {
        parent::__construct($context);
        $this->_studentFactory = $modelstudentFactory;
        $this->resultPageFactory = $resultPageFactory;
        $this->_sessionManager = $sessionManager;
        $this->_coreRegistry = $coreRegistry;
        $this->_request = $request;
        $this->helper = $helper;
    }

    public function execute()
    {
        $id = $this->getRequest()->getParam('id');

        $StudentModel = $this->_studentFactory->create()->load($id);
        //print_r($StudentModel);
        $data = $this->getRequest()->getPost();

        $StudentModel->setData('firstname', $data['firstname']);
        $StudentModel->setData('lastname', $data['lastname']);
        $StudentModel->setData('mobile', $data['mobile']);
        $StudentModel->setData('address', $data['address']);

        $StudentModel->save(); // Save Databse
        $this->helper->flushCache();
        $this->_redirect('*/*/show');
        $this->messageManager->addSuccess(__('Data has been updated.'));

    }
}
