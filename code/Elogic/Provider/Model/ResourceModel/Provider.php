<?php

namespace Elogic\Provider\Model\ResourceModel;

/**
 * Class Provider
 * @package Elogic\Provider\Model\ResourceModel
 */
class Provider extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * @return void
     */
    public function _construct()
    {
        $this->_init('elogic_providers', 'elogic_providers_id');
    }
}
