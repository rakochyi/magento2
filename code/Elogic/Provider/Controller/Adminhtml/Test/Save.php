<?php

namespace Elogic\Provider\Controller\Adminhtml\Test;

class Save extends \Magento\Backend\App\Action
{
    /**
     * @var \Magento\Framework\App\Request\DataPersistorInterface
     */
    protected $dataPersistor;

    /**
     * Save constructor.
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\App\Request\DataPersistorInterface $dataPersistor
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\App\Request\DataPersistorInterface $dataPersistor
    ) {
        $this->dataPersistor = $dataPersistor;
        parent::__construct($context);
    }


    /**
     * @return \Magento\Backend\Model\View\Result\Redirect|\Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();
        if ($data) {
            $id = $this->getRequest()->getParam('elogic_providers_id');

            $model = $this->_objectManager->create(\Elogic\Provider\Model\Provider::class)->load($id);
            if (!$model->getId() && $id) {
                $this->messageManager->addErrorMessage(__('This logo no longer exists.'));
                return $resultRedirect->setPath('*/*/');
            }

            $data = $this->_filterAttachmentData($data);
            $data['elogic_providers'] = json_encode($data['elogic_providers']);

            $model->setData($data);

            try {
                $model->save();
                $this->messageManager->addSuccessMessage(__('You saved the logo.'));
                $this->dataPersistor->clear('elogic_provider_provider');

                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['elogic_providers_id' => $model->getId()]);
                }
                return $resultRedirect->setPath('*/*/');
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the quote.'));
            }

            $this->dataPersistor->set('elogic_provider_provider', $data);
            return $resultRedirect->setPath('*/*/edit', ['elogic_providers_id' => $this->getRequest()->getParam('elogic_providers_id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }


    /**
     * @param array $rawData
     * @return array
     */
    public function _filterAttachmentData(array $rawData)
    {
        $data = $rawData;
        if (isset($data['uploader'][0]['name'])) {
            $data['uploader'] = $data['uploader'][0]['name'];
        } else {
            $data['uploader'] = null;
        }
        return $data;
    }
}
