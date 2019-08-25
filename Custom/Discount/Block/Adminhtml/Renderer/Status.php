<?php
namespace Custom\Discount\Block\Adminhtml\Renderer;

use Magento\Backend\Block\Widget\Grid\Column\Renderer\AbstractRenderer;
use Magento\Framework\DataObject;
use Magento\Store\Model\StoreManagerInterface;
 
class Status extends AbstractRenderer
{
    protected $_status;
    public function __construct(
        \Magento\Backend\Block\Context $context,
        StoreManagerInterface $storemanager,
        \Custom\Discount\Model\Adminhtml\Config\Source\Status $Status,
        array $data = array()
    ) {
        parent::__construct($context, $data);
        $this->_storeManager = $storemanager;
        $this->_status = $Status;
    }
    
    public function render(DataObject $row)
    {       
        $rowCollection = $row->getData();
        $statusId = $rowCollection['status'];
        $getStatus = $this->_status->optionArray();
        return $getStatus[$statusId];
    }   
}