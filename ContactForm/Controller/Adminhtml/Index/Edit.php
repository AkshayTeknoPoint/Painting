<?php

namespace PaintingTheme\ContactForm\Controller\Adminhtml\Index;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Registry;
use PaintingTheme\ContactForm\Model\StudentFactory;


class Edit extends Action
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'ContactForm::data';

    /**
     * Core registry
     *
     * @var \Magento\Framework\Registry
     */
    protected $_coreRegistry;

    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $resultPageFactory;

    /**
     * @param Action\Context $context
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     * @param \Magento\Framework\Registry $registry
     */
         public function __construct(Context $context,PageFactory $resultPageFactory,Registry $registry,
                                      StudentFactory $studentFactory) 
        {
        $this->resultPageFactory = $resultPageFactory;
        $this->_coreRegistry = $registry;
        $this->studentFactory = $studentFactory;
        parent::__construct($context);
    }

    /**
     * Init actions
     *
     * @return \Magento\Backend\Model\View\Result\Page
     */
    protected function _initAction()
    {
        // load layout, set active menu and breadcrumbs
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('PaintingTheme_ContactForm::data')
            ->addBreadcrumb(__('Contact Details'), __('Contact Details'))
            ->addBreadcrumb(__('Manage Student Records'), __('Manage Student Records'));
        return $resultPage;
    }

    /**
     * Edit CMS page
     *
     * @return \Magento\Backend\Model\View\Result\Page|\Magento\Backend\Model\View\Result\Redirect
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    public function execute()
    {
       //echo"Hii";
       // 1. Get ID and create model
       $id = $this->getRequest()->getParam('id');  // Get The Id 
       $model = $this->studentFactory->create();  // Init Model Using Model Factory In This Case Model Factory is Student Factory 
       //echo $id;


       // 2. Initial checking
       if ($id) {
           // Load A record Data From Data using Model 
        $model->load($id);

        if (!$model->getId()) {

           // $this->messageManager->addErrorMessage(__('This item no longer exists.'));
            /** \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
            $resultRedirect = $this->resultRedirectFactory->create();
            return $resultRedirect->setPath('*/*/');

          }
    }      
            // Save Model Data to registry variable for future purpose 
            // Variable name is userdefined in this case  studentdetails is the registry variable  .

            $this->_coreRegistry->register('contactdetails', $model);
            $resultpage=$this->resultPageFactory->create();
            $resultpage->getConfig()->getTitle()
            ->prepend($model->getId() ? $model->getTitle() : __('New Contact Details'));
            return $resultpage;



            // 5. Build edit form
            /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
           
    
      }       

    }
