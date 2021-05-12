<?php

namespace Elogic\Provider\Controller\Adminhtml\Test;

use Elogic\Provider\Model\Provider;

class NewAction extends \Magento\Backend\App\Action
{

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\Result\Redirect|\Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $this->_view->loadLayout();
        $this->_view->renderLayout();

        $providerData = $this->getRequest()->getParam('provider');
        if (is_array($providerData)) {
            $provider = $this->_objectManager->create(Provider::class);
            $provider->setData($providerData)->save();
            $resultRedirect = $this->resultRedirectFactory->create();
            return $resultRedirect->setPath('*/*/index');
        }
    }
}
