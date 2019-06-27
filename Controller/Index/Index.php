<?php
namespace DCKAP\ImportOptions\Controller\Index;
use DCKAP\ImportOptions\Helper\AttributeData;

class Index extends \Magento\Framework\App\Action\Action
{
    protected $_attributeData;
    protected $_categoryCollectionFactory;
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Catalog\Model\ResourceModel\Category\CollectionFactory $categoryCollectionFactory,
        AttributeData $attributeData)
    {
        $this->_attributeData= $attributeData;
        $this->_categoryCollectionFactory = $categoryCollectionFactory;
        return parent::__construct($context);
    }
    public function execute()
    {
        // file which we need to import
        $file = fopen("/var/www/html/magentos/magento/BookCodesSheet1.csv", "r");
        while (!feof($file)) {
            $options[] = fgetcsv($file);
        }
        fclose($file);
        unset($options[0]);
        foreach($options as $labels){
             if($labels){
                  $this->_attributeData->createOrUpdateId('book_code',$labels);    
             }
        }
        echo "added";
        die;
    }
}