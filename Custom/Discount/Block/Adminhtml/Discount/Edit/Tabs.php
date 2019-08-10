<?php
namespace Custom\Discount\Block\Adminhtml\Discount\Edit;

class Tabs extends \Magento\Backend\Block\Widget\Tabs
{
    protected function _construct()
    {
		
        parent::_construct();
        $this->setId('checkmodule_discount_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(__('Discount Information'));
    }
}