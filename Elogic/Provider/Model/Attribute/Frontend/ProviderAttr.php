<?php

namespace Elogic\Provider\Model\Attribute\Frontend;

use Magento\Eav\Model\Entity\Attribute\Frontend\AbstractFrontend;

class ProviderAttr extends AbstractFrontend
{
    /**
     * @param \Magento\Framework\DataObject $object
     * @return string
     */
    public function getValue(\Magento\Framework\DataObject $object): string
    {
        $value = $object->getData($this->getAttribute()->getAttributeCode());
        return "<b>$value</b>";
    }
}
