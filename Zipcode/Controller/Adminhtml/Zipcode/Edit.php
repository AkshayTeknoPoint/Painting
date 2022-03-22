<?php

namespace PaintingTheme\Zipcode\Controller\Adminhtml\Zipcode;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Registry;
use PaintingTheme\Zipcode\Model\ZipcodeFactory;


class Edit extends Action
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'PaintingTheme_Zipcode::data';

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
    protected $zipcodeFactory;

    /**
     * @param Action\Context $context
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     * @param \Magento\Framework\Registry $registry
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        Registry $registry,
        ZipcodeFactory $zipcodeFactory
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->_coreRegistry = $registry;
        $this->zipcodeFactory = $zipcodeFactory;
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
        $resultPage->setActiveMenu('PaintingTheme_Zipcode::data')
            ->addBreadcrumb(__('Zipcode Records'), __('Zipcode Records'))
            ->addBreadcrumb(__('Manage Zipcode Records'), __('Manage Zipcode Records'));
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

        // 1. Get ID and create model
        $id = $this->getRequest()->getParam('id');  // Get The Id 
        $model = $this->zipcodeFactory->create();  // Init Model Using Model Factory In This Case Model Factory is Student Factory 
     
        // 2. Initial checking
        if ($id) {
            // Load A record Data From Data using Model 
            $model->load($id);

            if (!$model->getId()) {

                $this->messageManager->addErrorMessage(__('This item no longer exists.'));
                /** \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
                $resultRedirect = $this->resultRedirectFactory->create();
                return $resultRedirect->setPath('*/*/index');
            }
        }
        // Save Model Data to registry variable for future purpose 
        // Variable name is userdefined in this case  zipcode is the registry variable  .

        $this->_coreRegistry->register('zipcode', $model);

        // 5. Build edit form
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->_initAction();
        $resultPage->addBreadcrumb(
            $id ? __('Edit Color') : __('New Zipcode Record'),
            $id ? __('Edit Color') : __('New Zipcode Record')
        );
        $resultPage->getConfig()->getTitle()->prepend(__('Zipcode Records'));
        $resultPage->getConfig()->getTitle()
            ->prepend($model->getId() ? $model->getTitle() : __('New Zipcode Record'));

        return $resultPage;
    }
}
