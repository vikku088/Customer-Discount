<?php
namespace Custom\Discount\Controller\Adminhtml\CartRules;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;


class Coupons extends Action
{
    protected $_customerCollection; 
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $resultPageFactory;

    protected $resultJsonFactory;

    /**
     * @var \Magento\Backend\Model\View\Result\Page
     */
    protected $resultPage;
    protected $saleRule;

    /**
     * @param Context $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        \Magento\Customer\Model\ResourceModel\Customer\CollectionFactory $customerFactory,
        \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory,
        \Magento\SalesRule\Model\Rule $saleRule
    )
    {
        parent::__construct($context);
        $this->_customerCollection = $customerFactory;
        $this->resultPageFactory = $resultPageFactory;
        $this->resultJsonFactory = $resultJsonFactory;
        $this->saleRule = $saleRule;
    }

    public function execute()
    {
        $result = $this->resultJsonFactory->create();
        $customerGroupId = $this->getRequest()->getParam('customerGroupId');
        $couponCollection = $this->saleRule->getCollection()->addFieldToFilter('is_active',1);
        $couponCode = [];
        foreach ($couponCollection as $couponInfo) {
            $customerGroupArray = $couponInfo->getCustomerGroupIds();
            if(in_array($customerGroupId,$customerGroupArray)){
                $id = $couponInfo->getCode();
                $couponCode[$id] = $couponInfo->getCode();
            }
        }
        return $result->setData($couponCode);
    }
}
