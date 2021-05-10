<?php

namespace Elogic\Provider\Block\Adminhtml\Provider\Edit;

/**
 * Class GenericButton
 * @package Elogic\Provider\Block\Adminhtml\Provider\Edit
 */
class GenericButton
{
    /**
     * Url Builder
     *
     * @var \Magento\Framework\UrlInterface
     */
    protected $urlBuilder;


    /**
     * Registry
     *
     * @var \Magento\Framework\Registry
     */
    protected $registry;


    /**
     * GenericButton constructor.
     * @param \Magento\Backend\Block\Widget\Context $context
     * @param \Magento\Framework\Registry $registry
     */
    public function __construct(
        \Magento\Backend\Block\Widget\Context $context,
        \Magento\Framework\Registry $registry
    ) {
        $this->urlBuilder = $context->getUrlBuilder();
        $this->registry = $registry;
    }


    /**
     * @return null
     */
    public function getId()
    {
        $provider = $this->registry->registry('provider');
        return $provider ? $provider->getId() : null;
    }


    /**
     * @param string $route
     * @param array $params
     * @return string
     */
    public function getUrl($route = '', $params = [])
    {
        return $this->urlBuilder->getUrl($route, $params);
    }
}
