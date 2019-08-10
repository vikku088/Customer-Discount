<?php
/**
 * Copyright © 2015 Custom . All rights reserved.
 */
namespace Custom\Discount\Helper;
class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
	protected $_storeManager;

	/**
     * @param \Magento\Framework\App\Helper\Context $context
     */
	public function __construct(\Magento\Framework\App\Helper\Context $context,
	\Magento\Store\Model\StoreManagerInterface $storeManager
	) {
		$this->_storeManager = $storeManager;
		parent::__construct($context);
	}
	public function getBaseUrl(){
		return $this->_storeManager->getStore()->getBaseUrl();
	}
}