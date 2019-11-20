<?php

namespace Bonsai\Slider\Controller\Adminhtml\Banner;

class Save extends \Bonsai\Slider\Controller\Adminhtml\Banner
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
     * @param \Bonsai\Slider\Model\BannerFactory $bannerFactory
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Backend\App\Action\Context $context
     */
    public function __construct(
        \Magento\Backend\Helper\Js $jsHelper,
        \Bonsai\Slider\Model\BannerFactory $bannerFactory,
        \Magento\Framework\Registry $registry,
        \Magento\Backend\App\Action\Context $context
    ) {
    
        $this->jsHelper       = $jsHelper;
        parent::__construct($bannerFactory, $registry, $context);
    }

    /**
     * run the action
     *
     * @return \Magento\Backend\Model\View\Result\Redirect
     */
    public function execute()
    {
        $data = $this->getRequest()->getPost('banner');
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($data) {
            $data = $this->filterData($data);
            $banner = $this->initBanner();
            $banner->setData($data);

            $sliders = $this->getRequest()->getPost('sliders', -1);
            if ($sliders != -1) {
                $banner->setSlidersData($this->jsHelper->decodeGridSerializedInput($sliders));
            }
            $this->_eventManager->dispatch(
                'bonsai_slider_banner_prepare_save',
                [
                    'banner' => $banner,
                    'request' => $this->getRequest()
                ]
            );
            try {
                $banner->save();
                $this->messageManager->addSuccess(__('The Banner has been saved.'));
                $this->_session->setBonsaiSliderBannerData(false);
                if ($this->getRequest()->getParam('back')) {
                    $resultRedirect->setPath(
                        'bonsai_slider/*/edit',
                        [
                            'banner_id' => $banner->getId(),
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
                $this->messageManager->addException($e, __('Something went wrong while saving the Banner.'));
            }
            $this->_getSession()->setBonsaiSliderBannerData($data);
            $resultRedirect->setPath(
                'bonsai_slider/*/edit',
                [
                    'banner_id' => $banner->getId(),
                    '_current' => true
                ]
            );
            return $resultRedirect;
        }
        $resultRedirect->setPath('bonsai_slider/*/');
        return $resultRedirect;
    }

    /**
     * filter values
     *
     * @param array $data
     * @return array
     */
    protected function filterData($data)
    {
        if (isset($data['status'])) {
            if (is_array($data['status'])) {
                $data['status'] = implode(',', $data['status']);
            }
        }
        return $data;
    }
}
