<?php

namespace Elogic\Provider\Controller\Adminhtml\Test;


/**
 * Class Add
 * @package Elogic\Provider\Controller\Adminhtml\Test
 */
class Add extends \Magento\Backend\App\Action
{
    public function execute()
    {
        $this->_view->loadLayout();
        $this->_view->renderLayout();
        die('Hello');

    }
}

