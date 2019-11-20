<?php

namespace Bonsai\Slider\Controller\Adminhtml;

abstract class Banner extends \Magento\Backend\App\Action
{
    /**
     * Banner Factory
     *
     * @var \Bonsai\Slider\Model\BannerFactory
     */
    protected $bannerFactory;

    /**
     * Core registry
     *
     * @var \Magento\Framework\Registry
     */
    protected $coreRegistry;

    /**
     * Result redirect factory
     *
     * @var \Magento\Backend\Model\View\Result\RedirectFactory
     */

    /**
     * constructor
     *
     * @param \Bonsai\Slider\Model\BannerFactory $bannerFactory
     * @param \Magento\Framework\Registry $coreRegistry
     * @param \Magento\Backend\Model\View\Result\RedirectFactory $resultRedirectFactory
     * @param \Magento\Backend\App\Action\Context $context
     */
    public function __construct(
        \Bonsai\Slider\Model\BannerFactory $bannerFactory,
        \Magento\Framework\Registry $coreRegistry,
        \Magento\Backend\App\Action\Context $context
    ) {
    
        $this->bannerFactory         = $bannerFactory;
        $this->coreRegistry          = $coreRegistry;
        parent::__construct($context);
    }

    /**
     * Init Banner
     *
     * @return \Bonsai\Slider\Model\Banner
     */
    protected function initBanner()
    {
        $bannerId  = (int) $this->getRequest()->getParam('banner_id');
        /** @var \Bonsai\Slider\Model\Banner $banner */
        $banner    = $this->bannerFactory->create();
        if ($bannerId) {
            $banner->load($bannerId);
        }
        $this->coreRegistry->register('bonsai_slider_banner', $banner);
        return $banner;
    }
}
