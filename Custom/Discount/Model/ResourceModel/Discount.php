<?php
/**
 * Copyright © 2015 Custom. All rights reserved.
 */
namespace Custom\Discount\Model\ResourceModel;

/**
 * Discount resource
 */
class Discount extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * Initialize resource
     *
     * @return void
     */
    public function _construct()
    {
        $this->_init('discount_discount', 'id');
    }

  
}
