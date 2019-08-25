<?php
namespace Custom\Discount\Block\Adminhtml\Renderer;

use Magento\Backend\Block\Widget\Grid\Column\Renderer\AbstractRenderer;
use Magento\Framework\DataObject;
use Magento\Store\Model\StoreManagerInterface;
 
class Storeview extends AbstractRenderer
{
    protected $_systemStore;
    public function __construct(
        \Magento\Backend\Block\Context $context,
        StoreManagerInterface $storemanager,
        \Magento\Store\Model\System\Store $systemStore,
        array $data = array()
    ) {
        parent::__construct($context, $data);
        $this->_storeManager = $storemanager;
        $this->_systemStore = $systemStore;
    }
    
    public function render(DataObject $row)
    {       
        $rowCollection = $row->getData();
        $storeView = $this->_systemStore->getStoreValuesForForm(false, true);
        $storeViewId = $rowCollection['store_view'];
        $storeViewId = explode(',',$storeViewId);
        $selectedStoreView[] = "<ul>";
        foreach ($storeViewId as $storeViewCollection) {
            $selectedStoreView[] = "<li>".$storeView[$storeViewCollection]['label']."</li>";
        }
        $selectedStoreView[] = "</ul>";
        $store = implode('', $selectedStoreView);
        return $store;
    }   
}