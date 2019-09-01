<?php
namespace Custom\Discount\Controller\Adminhtml\Send;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;


class Sendmail extends Action
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
        $discountEntityId = $this->getRequest()->getParam('id');
        $customerCouponDetails = $this->_helper->getCustomer($discountEntityId);
        $mailSent = $this->_helper->getSendMail($customerCouponDetails);
        if($mailSent){
            return true;
        }
        return false;
    }
}
