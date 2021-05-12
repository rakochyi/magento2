<?php

namespace Elogic\Provider\Model\Attribute\Source;

use Elogic\Provider\Model\ResourceModel\Provider\CollectionFactory as ProviderCollectionFactory;
use Magento\Eav\Model\Entity\Attribute\Source\AbstractSource;
use Magento\Eav\Model\Entity\Attribute\Source\SourceInterface;
use Magento\Framework\Data\OptionSourceInterface;

class ProviderAttr extends AbstractSource implements OptionSourceInterface, SourceInterface
{

    /**
     * @var ProviderCollectionFactory
     */
    private $providerCollectionFactory;


    /**
     * ProviderAttr constructor.
     * @param ProviderCollectionFactory $providerCollectionFactory
     */
    public function __construct(
        ProviderCollectionFactory $providerCollectionFactory
    ) {
        $this->providerCollectionFactory = $providerCollectionFactory;
    }


    /**
     * @return array
     */
    public function getAllOptions(): array
    {
        $collection = $this->providerCollectionFactory->create();
        $collection->addAttributeToSelect('*');
        $collection->addIsActiveFilter();

        foreach ($collection as $category) {
            $options[] = [
                'value' => $category->getId(),
                'label' => $category->getName() . ' (ID:' . $category->getId() . ')'
            ];
        }
        return $options;
    }
}
