<?php
namespace Custom\Discount\Block\Adminhtml\Renderer;

use Magento\Backend\Block\Widget\Grid\Column\Renderer\AbstractRenderer;
use Magento\Framework\DataObject;
use Magento\Store\Model\StoreManagerInterface;
 
class CustomerStatus extends AbstractRenderer
{
    protected $_customerGroup;
    public function __construct(
        \Magento\Backend\Block\Context $context,
        StoreManagerInterface $storemanager,
        \Magento\Customer\Model\ResourceModel\Group\Collection $customerGroup,
        array $data = array()
    ) {
        parent::__construct($context, $data);
        $this->_customerGroup = $customerGroup;
        $this->_storeManager = $storemanager;
    }
    
    public function render(DataObject $row)
    {       
        $rowCollection = $row->getData();
        $customerGroudId = $rowCollection['customer_groud'];
        $customerGroup = $this->_customerGroup->toOptionArray();
        return $customerGroup[$customerGroudId]['label']; 
    }   
}