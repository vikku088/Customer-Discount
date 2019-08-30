<?php
namespace Custom\Discount\Block\Adminhtml\Discount\Edit\Tab;
class CustomerInformation extends \Magento\Backend\Block\Widget\Form\Generic implements \Magento\Backend\Block\Widget\Tab\TabInterface
{
    /**
     * @var \Magento\Store\Model\System\Store
     */
    protected $_systemStore;
    protected $_customerGroup;
    protected $_couponCodes;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Data\FormFactory $formFactory
     * @param \Magento\Store\Model\System\Store $systemStore
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Magento\Store\Model\System\Store $systemStore,
        \Magento\Customer\Model\ResourceModel\Group\Collection $customerGroup,
        \Custom\Discount\Model\Adminhtml\Config\Source\Coupons $couponCodes,
        array $data = array()
    ) {
        $this->_systemStore = $systemStore;
        $this->_customerGroup = $customerGroup;
        $this->_couponCodes = $couponCodes;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * Prepare form
     *
     * @return $this
     */
    protected function _prepareForm()
    {
		/* @var $model \Magento\Cms\Model\Page */
        $model = $this->_coreRegistry->registry('discount_discount');
        $isElementDisabled = false;
        /** @var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create();

        $form->setHtmlIdPrefix('page_');

        $fieldset = $form->addFieldset('base_fieldset', array('legend' => __('Customer Information')));

        if ($model->getId()) {
            $fieldset->addField('id', 'hidden', array('name' => 'id'));
        }

        $fieldset->addField(
            'customer_groud',
            'select',
            array(
                'name' => 'customer_groud',
                'label' => __('Customer Group'),
                'title' => __('customer group'),
                'required' => true,
                'values' => $this->_customerGroup->toOptionArray(),
            )
        );
        $fieldset->addField(
            'customer',
            'multiselect',
            array(
                'name' => 'customer',
                'label' => __('Customer'),
                'title' => __('customer'),
                'required' => true,
            )
        );
        $fieldset->addField(
            'coupon_code',
            'select',
            array(
                'name' => 'coupon_code',
                'label' => __('Coupon'),
                'title' => __('coupon'),
                'required' => true,
            )
        );
        
        if (!$model->getId()) {
            $model->setData('status', $isElementDisabled ? '2' : '1');
        }

        $form->setValues($model->getData());
        $this->setForm($form);

        return parent::_prepareForm();   
    }

    /**
     * Prepare label for tab
     *
     * @return string
     */
    public function getTabLabel()
    {
        return __('Customer Information');
    }

    /**
     * Prepare title for tab
     *
     * @return string
     */
    public function getTabTitle()
    {
        return __('Customer Information');
    }

    /**
     * {@inheritdoc}
     */
    public function canShowTab()
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function isHidden()
    {
        return false;
    }

    /**
     * Check permission for passed action
     *
     * @param string $resourceId
     * @return bool
     */
    protected function _isAllowedAction($resourceId)
    {
        return $this->_authorization->isAllowed($resourceId);
    }
}
