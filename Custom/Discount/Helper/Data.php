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
	protected $_customerCollection;
	protected $saleRule;

	/**
     * @param \Magento\Framework\App\Helper\Context $context
     */
	public function __construct(\Magento\Framework\App\Helper\Context $context,
	\Magento\Store\Model\StoreManagerInterface $storeManager,
	\Custom\Discount\Model\DiscountFactory $discountFactory,
	\Magento\Customer\Model\Session $customerSession,
	\Magento\Customer\Model\ResourceModel\Customer\CollectionFactory $customerFactory,
	\Magento\SalesRule\Model\Rule $saleRule
	) {
		$this->_storeManager = $storeManager;
		$this->_discountFactory = $discountFactory;
		$this->_customerSession = $customerSession;
		$this->_customerCollection = $customerFactory;
		$this->saleRule = $saleRule;
		parent::__construct($context);
	}
	/**
	 * return Base Url
	 * @return url
     */
	public function getBaseUrl(){
		return $this->_storeManager->getStore()->getBaseUrl();
	}
	/**
     * @param CouponCode 
	 * Validating Of Coupon Code If Exist in Our Module
	 * @return boolen
     */
	public function validateCouponCode($couponCode){
		$couponData = $this->_discountFactory->create()->getCollection()->addFieldToFilter('coupon_code',$couponCode)->addFieldToFilter('status',1);
		if(count($couponData)>0){
			return true;
		}return false;
		
	}
	/**
     * @param CouponCode 
	 * Validating Of Coupon Code according to Customer
	 * @return boolen
     */
	public function validCustomer($couponCode){
		$customerId = $this->_customerSession->getCustomer()->getId();
		$customerGroupId = $this->_customerSession->getCustomer()->getGroupId();
		$couponData = $this->_discountFactory->create()->getCollection()->addFieldToFilter('coupon_code',$couponCode)->addFieldToFilter('status',1)->addFieldToFilter('customer_groud',$customerGroupId)->addFieldToFilter('customer', $customerId);
		if(count($couponData)>0){
			return true;
		}return false;
	}
	/**
     * @param customerGroupId 
	 * Fetching Customers Collection According To GroupId
	 * @return array customers
     */
	public function getCustomersByGroupId($customerGroupId){
		$customers = $this->_customerCollection->create()->addFieldToFilter('group_id',$customerGroupId);
		return $customers;
	}
	/**
	 * Fetching Active Cart Rules Coupons
	 * @return array couponCollection
     */
	public function getCouponByGroupId(){
		$couponCollection = $this->saleRule->getCollection()->addFieldToFilter('is_active',1);
		return $couponCollection;
	}
}