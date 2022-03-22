<?php

namespace PaintingTheme\Zipcode\Block\Adminhtml\Zipcode;

use Magento\Backend\Block\Widget\Context;
use Magento\Cms\Api\BlockRepositoryInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use PaintingTheme\Zipcode\Model\ZipcodeFactory;

/**
 * Class GenericButton
 */
class GenericButton
{
    /**
     * @var Context
     */
    protected $context;

    /**
     * @var BlockRepositoryInterface
     */
    protected $zipcodeFactory;

    /**
     * @param Context $context
     * @param BlockRepositoryInterface $zipcodeFactory
     */
    public function __construct(Context $context, ZipcodeFactory $zipcodeFactory) 
    {
        $this->context = $context;
        $this->zipcodeFactory = $zipcodeFactory;
    }

    /**
     * Return CMS block ID
     *
     * @return int|null
     */
    public function getModelById()
    {
        try {
            return $this->zipcodeFactory->create()->load(
                $this->context->getRequest()->getParam('id')
            )->getId();
        } catch (NoSuchEntityException $e) {
        }
        return null;
    }

    /**
     * Generate url by route and parameters
     *
     * @param   string $route
     * @param   array $params
     * @return  string
     */
    public function getUrl($route = '', $params = [])
    {
        return $this->context->getUrlBuilder()->getUrl($route, $params);
    }

    /**
     * Check where button can be rendered
     *
     * @param string $name
     * @return string
     */
    public function canRender($name)
    {
        return $name;
    }
}
