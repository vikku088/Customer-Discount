<?php
namespace Custom\Discount\Model\Adminhtml\Config\Source;
 
class Status implements \Magento\Framework\Option\ArrayInterface
{
    const ENABLE = 1;
    const DISABLE = 0;
    
    public function toOptionArray()
    {
        return [['value' => NULL, 'label' => __('-- Select Page --')],
                ['value' => self:: ENABLE, 'label' => __('Enabled')], 
                ['value' => self:: DISABLE, 'label' => __('Disabled')],
                ];            
    }   
    public function optionArray()
    {
        return [
                self:: ENABLE => __('Enabled'), 
                self:: DISABLE => __('Disabled'),
            ];            
    } 
}