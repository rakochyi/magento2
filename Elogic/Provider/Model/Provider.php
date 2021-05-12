<?php

namespace Elogic\Provider\Model;

/**
 * Class Provider
 * @package Elogic\Provider\Model
 */
class Provider extends \Magento\Framework\Model\AbstractModel
{
    /**
     * @var \Magento\Framework\Stdlib\DateTime
     */
    protected $_dateTime;

    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init(\Elogic\Provider\Model\ResourceModel\Provider::class);
    }
}
