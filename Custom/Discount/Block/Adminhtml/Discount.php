<?php
namespace Custom\Discount\Block\Adminhtml;
class Discount extends \Magento\Backend\Block\Widget\Grid\Container
{
    /**
     * Constructor
     *
     * @return void
     */
    protected function _construct()
    {
		
        $this->_controller = 'adminhtml_discount';/*block grid.php directory*/
        $this->_blockGroup = 'Custom_Discount';
        $this->_headerText = __('Discount');
        $this->_addButtonLabel = __('Create Customer Coupon'); 
        parent::_construct();
		
    }
}
