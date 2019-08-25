<?php
namespace Custom\Discount\Block\Adminhtml\Renderer;

use Magento\Backend\Block\Widget\Grid\Column\Renderer\AbstractRenderer;
use Magento\Framework\DataObject;
use Magento\Store\Model\StoreManagerInterface;
 
class Customer extends AbstractRenderer
{
    protected $_customerFactory;
    public function __construct(
        \Magento\Backend\Block\Context $context,
        StoreManagerInterface $storemanager,
        \Magento\Customer\Api\CustomerRepositoryInterface $customerFactory,
        array $data = array()
    ) {
        parent::__construct($context, $data);
        $this->_storeManager = $storemanager;
        $this->_customerFactory = $customerFactory;
    }
    
    public function render(DataObject $row)
    {       
        $rowCollection = $row->getData();
        $customerId = $rowCollection['customer'];
        $customerId = explode(',',$customerId);
        $selectedCustomer[] = "<ul>";
        foreach ($customerId as $customer) {
            $getCustomer = $this->_customerFactory->getById($customer);
            $firstName = $getCustomer->getFirstname();
            $lastName = $getCustomer->getLastname();
            $name = $firstName.' '.$lastName;
            $selectedCustomer[] = "<li>".$name."</li>";
        }
        $selectedCustomer[] = "</ul>";
        $name = implode('', $selectedCustomer);
        return $name;
    }   
}