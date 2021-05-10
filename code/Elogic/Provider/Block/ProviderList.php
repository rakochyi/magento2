<?php

namespace Elogic\Provider\Block;

use Magento\Framework\View\Element\Template;

class ProviderList extends \Magento\Framework\View\Element\Template
{
    public function __construct(Template\Context $context, array $data = [])
    {
        parent::__construct($context, $data);
        $this->setData('provider', []);
    }

    public function addContacts($count)
    {
        $_provider = $this->getData('provider');
        $actualNumber = count($_provider);
        $names = [];
        for($i=$actualNumber;$i<($actualNumber+$count);$i++) {
            $_provider[] = 'nom '.($i+1);
        }
        $this->setData('provider',$_provider);
    }
}
