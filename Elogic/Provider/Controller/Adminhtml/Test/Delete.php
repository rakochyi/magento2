<?php

namespace Elogic\Provider\Controller\Adminhtml\Test;

use Elogic\Provider\Model\Provider;

/**
 * Class Delete
 * @package Elogic\Provider\Controller\Adminhtml\Test
 */
class Delete extends \Magento\Backend\App\Action
{
    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        if (!($provider = $this->_objectManager->create(Provider::class)->load($id))) {
            $this->messageManager->addError(__('Unable to proceed. Please, try again.'));
            $resultRedirect = $this->resultRedirectFactory->create();
            return $resultRedirect->setPath('*/*/index', ['_current' => true]);
        }
        try {
            $provider->delete();
            $this->messageManager->addSuccess(__('Your provider has been deleted !'));
        } catch (Exception $e) {
            $this->messageManager->addError(__('Error while trying to delete provider: '));
            $resultRedirect = $this->resultRedirectFactory->create();
            return $resultRedirect->setPath('*/*/index', ['_current' => true]);
        }

        $resultRedirect = $this->resultRedirectFactory->create();
        return $resultRedirect->setPath('*/*/index', ['_current' => true]);
    }
}
