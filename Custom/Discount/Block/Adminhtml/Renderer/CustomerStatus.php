<?php
namespace Custom\Discount\Block\Adminhtml\Adminhtml\Renderer;

use Magento\Backend\Block\Widget\Grid\Column\Renderer\AbstractRenderer;
use Magento\Framework\DataObject;
use Magento\Store\Model\StoreManagerInterface;
 
class CustomerStatus extends AbstractRenderer
{
    public function __construct(
        \Magento\Backend\Block\Context $context,
        StoreManagerInterface $storemanager,
        array $data = array()
    ) {
        parent::__construct($context, $data);
        $this->_storeManager = $storemanager;
    }
    
    public function render(DataObject $row)
    {       
        $rowCollection = $row->getData();
        // $statusId = $rowCollection['status'];
        echo "<pre>";
        print_r($rowCollection);
        // if($statusId == '1'){
        //     $subscribe = 'Subscribe';
        // }else{
        //     $subscribe = 'UnSubscribe';
        // }
        // return $subscribe;
    }   
}