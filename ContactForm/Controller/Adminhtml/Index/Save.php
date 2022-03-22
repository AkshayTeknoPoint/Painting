<?php

namespace PaintingTheme\ContactForm\Controller\Adminhtml\Index;

use Magento\Backend\App\Action\Context;
use Magento\Backend\App\Action;
use Sample\Example\Model\Student;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\TestFramework\Inspection\Exception;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Store\Model\ScopeInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Escaper;
use Magento\Framework\Translate\Inline\StateInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Stdlib\DateTime\DateTimeFactory;

class Save extends Action {

    /**
     * @var DataPersistorInterface
     */
    protected $dataPersistor;
    protected $scopeConfig;
    protected $_escaper;
    protected $inlineTranslation;
    protected $_dateFactory;

    /**
     * @param Context $context
     * @param \Magento\Framework\Registry $coreRegistry
     * @param DataPersistorInterface $dataPersistor
     */
    public function __construct(Context $context, DataPersistorInterface $dataPersistor, 
    Escaper $escaper,StateInterface $inlineTranslation,ScopeConfigInterface $scopeConfig,DateTimeFactory $dateFactory) 
    {
        $this->dataPersistor = $dataPersistor;
        $this->scopeConfig = $scopeConfig;
        $this->_escaper = $escaper;
        $this->_dateFactory = $dateFactory;
        $this->inlineTranslation = $inlineTranslation;
        parent::__construct($context);
    }

    /**
     * Save action
     *
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute() {

        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();


        if ($data) {
            $id = $this->getRequest()->getParam('id');

            /** @var \Magento\Cms\Model\Block $model */
            $model = $this->_objectManager->create('PaintingTheme\ContactForm\Model\Student')->load($id);
            if (!$model->getId() && $id) {
                $this->messageManager->addError(__('This record no longer exists.'));
                return $resultRedirect->setPath('*/*/');
            }

            $data = array_filter($data, function($value) {
                return $value !== '';
            });
            $model->setData($data);
            $this->inlineTranslation->suspend();
            try {
                $model->save();
                $this->messageManager->addSuccess(__('Record Saved successfully'));
                $this->dataPersistor->clear('students_form_data');

                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['id' => $model->getId()]);
                }
                return $resultRedirect->setPath('*/*/');
            } catch (LocalizedException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addException($e, __('Something went wrong while saving the Record.'));
                print_r($e);
            }

            $this->dataPersistor->set('students_form_data', $data);
        }
        return $resultRedirect->setPath('*/*');
    }

}