<?php
namespace Elogic\Provider\Controller\Test;

/**
 * Class Index
 * @package Elogic\Provider\Controller\Test
 */
class Index extends \Magento\Framework\App\Action\Action
{
    public function execute()
    {
        $this->_view->loadLayout();
        $this->_view->renderLayout();
    }
}
