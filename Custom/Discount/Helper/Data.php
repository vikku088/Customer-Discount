<?php
/**
 * Copyright © 2015 Custom . All rights reserved.
 */
namespace Custom\Discount\Helper;
class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
	protected $_storeManager;
	protected $_discountFactory;
	protected $_customerSession;

	/**
     * @param \Magento\Framework\App\Helper\Context $context
     */
	public function __construct(\Magento\Framework\App\Helper\Context $context,
	\Magento\Store\Model\StoreManagerInterface $storeManager,
	\Custom\Discount\Model\DiscountFactory $discountFactory,
	\Magento\Customer\Model\Session $customerSession
	) {
		$this->_storeManager = $storeManager;
		$this->_discountFactory = $discountFactory;
		$this->_customerSession = $customerSession;
		parent::__construct($context);
	}
	public function getBaseUrl(){
		return $this->_storeManager->getStore()->getBaseUrl();
	}
	// For Validating Coupon Code Exist in Our Module...
	public function validateCouponCode($couponCode){
		$couponData = $this->_discountFactory->create()->getCollection()->addFieldToFilter('coupon_code',$couponCode)->addFieldToFilter('status',1);
		if(count($couponData)>0){
			return true;
		}return false;
		
	}
	public function validCustomer($couponCode){
		$customerId = $this->_customerSession->getCustomer()->getId();
		$customerGroupId = $this->_customerSession->getCustomer()->getGroupId();
		$couponData = $this->_discountFactory->create()->getCollection()->addFieldToFilter('coupon_code',$couponCode)->addFieldToFilter('status',1)->addFieldToFilter('customer_groud',$customerGroupId)->addFieldToFilter('customer',
			array('like' => '%'.$customerId.'%'));
		if(count($couponData)>0){
			return true;
		}return false;

	}
}