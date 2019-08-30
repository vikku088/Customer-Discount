<?php
namespace Custom\Discount\Controller\Adminhtml\Customers;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;


class Collection extends Action
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $resultPageFactory;

    protected $resultJsonFactory;

    /**
     * @var \Magento\Backend\Model\View\Result\Page
     */
    protected $resultPage;
    protected $_helper;

    /**
     * @param Context $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory,
        \Custom\Discount\Helper\Data $helper
    )
    {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
        $this->resultJsonFactory = $resultJsonFactory;
        $this->_helper = $helper;
    }

    public function execute()
    {
        $result = $this->resultJsonFactory->create();
        $customerGroupId = $this->getRequest()->getParam('customerGroupId');
        $customers = $this->_helper->getCustomersByGroupId($customerGroupId);
        if(count($customers->getData()) !== 0){
            foreach ($customers as $customerCollection ) {
                $id = $customerCollection->getId();
                $customer[$id] = $customerCollection->getName();
            }
            return $result->setData($customer);
        }
    }
}
