<?php
namespace Custom\Discount\Block\Adminhtml\Discount;

/**
 * CMS block edit form container
 */
class Edit extends \Magento\Backend\Block\Widget\Form\Container
{
    protected $_coreRegistry = null;
    public function __construct(
        \Magento\Backend\Block\Widget\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Backend\Helper\Data $helper,
        array $data = []
    ) {
        $this->_coreRegistry = $registry;
        $this->_helper = $helper;
        parent::__construct($context, $data);
    }
    protected function _construct()
    {
		$this->_objectId = 'id';
        $this->_blockGroup = 'Custom_Discount';
        $this->_controller = 'adminhtml_discount';
        
        $model = $this->_coreRegistry->registry('discount_discount');

        parent::_construct();

        $this->buttonList->update('save', 'label', __('Save Block'));
        $this->buttonList->update('delete', 'label', __('Delete Block'));

        $this->buttonList->add(
            'saveandcontinue',
            array(
                'label' => __('Save and Continue Edit'),
                'class' => 'save',
                'data_attribute' => array(
                    'mage-init' => array('button' => array('event' => 'saveAndContinueEdit', 'target' => '#edit_form'))
                )
            ),
            -100
        );
$this->_formScripts[] = "
            require(['jquery'], function($){
                $(document).ready(function() {
                    var couponCode = '".$model->getCouponCode()."';
                    var customers = '".$model->getCustomer()."';
                    customers = JSON.parse('[' + customers + ']');
                    var customerGroupId = $('#page_customer_groud').val();
                    jQuery.ajax( {
                        url: '".$this->_helper->getUrl('discount/customers/collection')."',
                        data: {customerGroupId: customerGroupId, form_key: FORM_KEY},
                        dataType: 'json',
                        type: 'POST'
                    }).done(function(data) {
                        if(data){
                            var jsonData = [data];
                            var match;
                            for(var obj in jsonData){
                                if(jsonData.hasOwnProperty(obj)){
                                    for(var prop in jsonData[obj]){
                                        if(jsonData[obj].hasOwnProperty(prop)){
                                            match =0;
                                            customers.forEach(function(entry) {
                                                if(entry == prop){
                                                    match = 1;
                                                }
                                            });
                                            if(match == 1){
                                                $('#page_customer').append('<option value ='+ prop+' selected>'+jsonData[obj][prop]+'</option>');

                                            }else{
                                                $('#page_customer').append('<option value ='+ prop+'>'+jsonData[obj][prop]+'</option>');
                                            }
                                        }
                                    }
                                }
                            }
                        }else{
                            $('#page_customer').html(' ');
                        }
                    });

                    jQuery.ajax({
                        url: '".$this->_helper->getUrl('discount/cartrules/coupons')."',
                        data: {customerGroupId: customerGroupId, form_key: FORM_KEY},
                        dataType: 'json',
                        type: 'POST'
                    }).done(function(data) {
                        if(data){
                            $('#page_coupon_code').html(' ');
                            var jsonData = [data];
                            for(var obj in jsonData){
                                if(jsonData.hasOwnProperty(obj)){
                                    for(var prop in jsonData[obj]){
                                        if(jsonData[obj].hasOwnProperty(prop)){
                                            if(prop == couponCode){
                                                $('#page_coupon_code').append('<option value ='+ prop+' selected>'+jsonData[obj][prop]+'</option>');
                                            }else{
                                                $('#page_coupon_code').append('<option value ='+ prop+'>'+jsonData[obj][prop]+'</option>');
                                            }
                                        }
                                    }
                                }
                            }
                        }else{
                            $('#page_coupon_code').html(' ');
                        }
                    });
                    
                    
                    $('#page_customer_groud').on('change',function(){
                        var customerGroupName = $('#page_customer_groud :selected').text();
                        var customerGroupChangedId = $('#page_customer_groud').val();
                        customerAjax(customerGroupChangedId);
                        couponAjax(customerGroupChangedId);
                    });
                });
                var customerAjax = function(customerGroupId){
                    jQuery.ajax( {
                        url: '".$this->_helper->getUrl('discount/customers/collection')."',
                        data: {customerGroupId: customerGroupId, form_key: FORM_KEY},
                        dataType: 'json',
                        type: 'POST'
                    }).done(function(data) {
                        if(data){
                            $('.no-customer').hide();
                            $('#page_customer').show();
                            var jsonData = [data];
                            for(var obj in jsonData){
                                if(jsonData.hasOwnProperty(obj)){
                                    for(var prop in jsonData[obj]){
                                        if(jsonData[obj].hasOwnProperty(prop)){
                                            $('#page_customer').append('<option value ='+ prop+'>'+jsonData[obj][prop]+'</option>');
                                        }
                                    }
                                }
                            }
                        }else{
                            $('#page_customer').html(' ');
                            $('#page_customer').hide();
                            $('.field-customer').append('<div class = no-customer><h2><b><div>Sorry! No Customer Found.</div><div>Please Select Another Customer Group.</b></div></h2></div>');
                        }
                    });
                }
                var couponAjax = function(customerGroupId){
                    jQuery.ajax( {
                    
                        url: '".$this->_helper->getUrl('discount/cartrules/coupons')."',
                        data: {customerGroupId: customerGroupId, form_key: FORM_KEY},
                        dataType: 'json',
                        type: 'POST'
                    }).done(function(data) {
                        if(data){
                            $('#page_coupon_code').html(' ');
                            var jsonData = [data];
                            for(var obj in jsonData){
                                if(jsonData.hasOwnProperty(obj)){
                                    for(var prop in jsonData[obj]){
                                        if(jsonData[obj].hasOwnProperty(prop)){
                                            $('#page_coupon_code').append('<option value ='+ prop+'>'+jsonData[obj][prop]+'</option>');
                                        }
                                    }
                                }
                            }
                        }else{
                            $('#page_coupon_code').html(' ');
                        }
                    });
                }
            });
        ";
    }

    /**
     * Get edit form container header text
     *
     * @return string
     */
    public function getHeaderText()
    {
        if ($this->_coreRegistry->registry('checkmodule_checkmodel')->getId()) {
            return __("Edit Item '%1'", $this->escapeHtml($this->_coreRegistry->registry('checkmodule_checkmodel')->getTitle()));
        } else {
            return __('New Item');
        }
    }
}
