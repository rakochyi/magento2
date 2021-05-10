<?php

namespace Elogic\Provider\Controller\Adminhtml\Test;

/**
 * Class Index
 * @package Elogic\Provider\Controller\Adminhtml\Test
 */
class Index extends \Magento\Backend\App\Action
{
    public function execute()
    {
        $this->_view->loadLayout();
        $this->_view->renderLayout();
    }
}
