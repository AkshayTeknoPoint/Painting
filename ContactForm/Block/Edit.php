<?php

namespace PaintingTheme\ContactForm\Block;

use Magento\Framework\App\Request\Http;
use PaintingTheme\ContactForm\Model\StudentFactory;

class Edit extends \Magento\Framework\View\Element\Template
{
    protected $_pageFactory;
    protected $_request;
    protected $_studentFactory;

    public function __construct(\Magento\Framework\View\Element\Template\Context $context, Http $request,
        StudentFactory $studentFactory) {
        $this->_request = $request;
        $this->_studentFactory = $studentFactory;
        return parent::__construct($context);
    }

    public function show()
    {
        $id = $this->_request->getParam('id');
        $datanew = $this->_studentFactory->create()->load($id);
        return $datanew;
    }
}
