<?php
namespace Custom\Discount\Model\Adminhtml\Config\Source;
 
class Coupons implements \Magento\Framework\Option\ArrayInterface
{

    protected $coupon;
    protected $saleRule;

    public function __construct(
    \Magento\SalesRule\Model\Coupon $coupon,
    \Magento\SalesRule\Model\Rule $saleRule
)
{
    $this->coupon = $coupon;
    $this->saleRule = $saleRule;
}
    
    public function toOptionArray()
    {
        $couponCollection = $this->coupon->getCollection();
        foreach ($couponCollection as $couponInfo) {
            $couponArray[] = ['value' => $couponInfo->getCode(), 'label' => __($couponInfo->getCode())];
        }
        return $couponArray;           
    }
}