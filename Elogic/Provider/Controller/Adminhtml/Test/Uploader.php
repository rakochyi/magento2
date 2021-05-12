<?php

namespace Elogic\Provider\Controller\Adminhtml\Test;

use Magento\Framework\Controller\ResultFactory;
/**
 * Class Uploader
 * @package Elogic\Provider\Controller\Adminhtml\Test
 */
class Uploader extends \Magento\Backend\App\Action
{
    /**
     * @var \Elogic\Provider\Model\ImageUploader
     */
    public $imageUploader;


    /**
     * Uploader constructor.
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Elogic\Provider\Model\ImageUploader $imageUploader
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Elogic\Provider\Model\ImageUploader $imageUploader
    ) {
        parent::__construct($context);
        $this->imageUploader = $imageUploader;
    }


    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        try {
            $result = $this->imageUploader->saveFileToTmpDir('logo');
            $result['cookie'] = [
                'name' => $this->_getSession()->getName(),
                'value' => $this->_getSession()->getSessionId(),
                'lifetime' => $this->_getSession()->getCookieLifetime(),
                'path' => $this->_getSession()->getCookiePath(),
                'domain' => $this->_getSession()->getCookieDomain(),
            ];
        } catch (\Exception $e) {
            $result = ['error' => $e->getMessage(), 'errorcode' => $e->getCode()];
        }
        return $this->resultFactory->create(ResultFactory::TYPE_JSON)->setData($result);
    }
}
