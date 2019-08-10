<?php
namespace Custom\Discount\Controller\Adminhtml\Customers;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;


class Collection extends Action
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

    /**
     * @param Context $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        \Magento\Customer\Model\ResourceModel\Customer\CollectionFactory $customerFactory,
        \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory
    )
    {
        parent::__construct($context);
        $this->_customerCollection = $customerFactory;
        $this->resultPageFactory = $resultPageFactory;
        $this->resultJsonFactory = $resultJsonFactory;
    }

    public function execute()
    {
        $result = $this->resultJsonFactory->create();
        $customerGroupId = $this->getRequest()->getParam('customerGroupId');
        $customers = $this->_customerCollection->create()->addFieldToFilter('group_id',$customerGroupId);
        if(count($customers->getData()) !== 0){
            foreach ($customers as $customerCollection ) {
                $id = $customerCollection->getId();
                $customer[$id] = $customerCollection->getName();
            }
            return $result->setData($customer);
        }
    }
}
