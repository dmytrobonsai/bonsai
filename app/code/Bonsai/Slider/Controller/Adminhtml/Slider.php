<?php

namespace Bonsai\Slider\Controller\Adminhtml;

abstract class Slider extends \Magento\Backend\App\Action
{
    /**
     * Slider Factory
     *
     * @var \Bonsai\Slider\Model\SliderFactory
     */
    protected $sliderFactory;

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
     * @param \Bonsai\Slider\Model\SliderFactory $sliderFactory
     * @param \Magento\Framework\Registry $coreRegistry
     * @param \Magento\Backend\App\Action\Context $context
     */
    public function __construct(
        \Bonsai\Slider\Model\SliderFactory $sliderFactory,
        \Magento\Framework\Registry $coreRegistry,
        \Magento\Backend\App\Action\Context $context
    ) {
    
        $this->sliderFactory         = $sliderFactory;
        $this->coreRegistry          = $coreRegistry;
        parent::__construct($context);
    }

    /**
     * Init Slider
     *
     * @return \Bonsai\Slider\Model\Slider
     */
    protected function initSlider()
    {
        $sliderId  = (int) $this->getRequest()->getParam('slider_id');
        /** @var \Bonsai\Slider\Model\Slider $slider */
        $slider    = $this->sliderFactory->create();
        if ($sliderId) {
            $slider->load($sliderId);
        }
        $this->coreRegistry->register('bonsai_slider_slider', $slider);
        return $slider;
    }
}
