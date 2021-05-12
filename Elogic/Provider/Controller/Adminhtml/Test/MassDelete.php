<?php

namespace Elogic\Provider\Controller\Adminhtml\Test;

use Elogic\Provider\Model\Provider;

/**
 * Class MassDelete
 * @package Elogic\Provider\Controller\Adminhtml\Test
 */
class MassDelete extends \Magento\Backend\App\Action
{
    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\Result\Redirect|\Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $ids = $this->getRequest()->getParam('selected', []);
        if (!is_array($ids) || !count($ids)) {
            $resultRedirect = $this->resultRedirectFactory->create();
            return $resultRedirect->setPath('*/*/index', ['_current' => true]);
        }
        foreach ($ids as $id) {
            if ($contact = $this->_objectManager->create(Provider::class)->load($id)) {
                $contact->delete();
            }
        }
        $this->messageManager->addSuccess(__('A total of %1 record(s) have been deleted.', count($ids)));

        $resultRedirect = $this->resultRedirectFactory->create();
        return $resultRedirect->setPath('*/*/index', ['_current' => true]);
    }
}
