<?php

namespace PaintingTheme\Zipcode\Controller\Index;

use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\View\Result\PageFactory;
use PaintingTheme\Zipcode\Model\ZipcodeFactory;

class Index extends \Magento\Framework\App\Action\Action
{

    /**
     * @var Magento\Framework\View\Result\PageFactory
     */
    protected $resultPageFactory;

    protected $resultJsonFactory;
    protected $_zipcodeFactory;

    /**
     * @param Context     $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        JsonFactory $resultJsonFactory,
        ZipcodeFactory $zipcodeFactory
    ) {

        $this->resultPageFactory = $resultPageFactory;
        $this->resultJsonFactory = $resultJsonFactory;
        $this->_zipcodeFactory = $zipcodeFactory;
        return parent::__construct($context);
    }

    public function execute()
    {
        $items = $this->_zipcodeFactory->create();
        //get data from js file
        $data = $this->getRequest()->getPost();
        $zipcode = $data['pincode'];
        //$data = '530068';
        $resultJson = $this->resultJsonFactory->create();
        //get collection from zipcode table
        $collection = $items->getCollection()
            ->addFieldToSelect('*')
            ->addFieldToFilter('zipcode', $zipcode);
        $response = $collection->getData();
        //print_r($response[0]['zipcode']);
    
        //to check pincode exist or not
        if ($response == null) {
            $msg = "Pincode is not Valid";
            return $resultJson->setData(['json' => $msg]);
        } else {
            //to fetch city & state
            $map = [
                $city = $response[0]['city'],
                $state = $response[0]['state'],
            ];

            //var_dump( $response);
            return $resultJson->setData(['jsondata' => $map]);
        }

    }
}
