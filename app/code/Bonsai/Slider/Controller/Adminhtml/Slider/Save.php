<?php

namespace Bonsai\Slider\Controller\Adminhtml\Slider;

class Save extends \Bonsai\Slider\Controller\Adminhtml\Slider
{

    /**
     * JS helper
     *
     * @var \Magento\Backend\Helper\Js
     */
    protected $jsHelper;

    /**
     * constructor
     *
     * @param \Magento\Backend\Helper\Js $jsHelper
     * @param \Bonsai\Slider\Model\SliderFactory $sliderFactory
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Backend\App\Action\Context $context
     */
    public function __construct(
        \Magento\Backend\Helper\Js $jsHelper,
        \Bonsai\Slider\Model\SliderFactory $sliderFactory,
        \Magento\Framework\Registry $registry,
        \Magento\Backend\App\Action\Context $context
    ) {
    
        $this->jsHelper       = $jsHelper;
        parent::__construct($sliderFactory, $registry, $context);
    }

    /**
     * run the action
     *
     * @return \Magento\Backend\Model\View\Result\Redirect
     */
    public function execute()
    {
        $data = $this->getRequest()->getPost('slider');
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($data) {
            $slider = $this->initSlider();
            // convert store ids to string
            $data['store_ids'] = implode(',', $data['store_ids']);
            $slider->setData($data);
            $banners = $this->getRequest()->getPost('banners', -1);
            if ($banners != -1) {
                $slider->setBannersData($this->jsHelper->decodeGridSerializedInput($banners));
            }
            $this->_eventManager->dispatch(
                'bonsai_slider_slider_prepare_save',
                [
                    'slider' => $slider,
                    'request' => $this->getRequest()
                ]
            );
            try {
                $slider->save();
                $this->messageManager->addSuccess(__('The Slider has been saved.'));
                $this->_session->setBonsaiSliderSliderData(false);
                if ($this->getRequest()->getParam('back')) {
                    $resultRedirect->setPath(
                        'bonsai_slider/*/edit',
                        [
                            'slider_id' => $slider->getId(),
                            '_current' => true
                        ]
                    );
                    return $resultRedirect;
                }
                $resultRedirect->setPath('bonsai_slider/*/');
                return $resultRedirect;
            } catch (\Magento\Framework\Exception\LocalizedException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\RuntimeException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addException($e, __($e->getMessage()));
            }
            $this->_getSession()->setBonsaiSliderSliderData($data);
            $resultRedirect->setPath(
                'bonsai_slider/*/edit',
                [
                    'slider_id' => $slider->getId(),
                    '_current' => true
                ]
            );
            return $resultRedirect;
        }
        $resultRedirect->setPath('bonsai_slider/*/');
        return $resultRedirect;
    }
}
