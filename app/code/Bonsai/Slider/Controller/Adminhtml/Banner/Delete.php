<?php

namespace Bonsai\Slider\Controller\Adminhtml\Banner;

class Delete extends \Bonsai\Slider\Controller\Adminhtml\Banner
{
    /**
     * execute action
     *
     * @return \Magento\Backend\Model\View\Result\Redirect
     */
    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $id = $this->getRequest()->getParam('banner_id');
        if ($id) {
            $name = "";
            try {
                /** @var \Bonsai\Slider\Model\Banner $banner */
                $banner = $this->bannerFactory->create();
                $banner->load($id);
                $name = $banner->getName();
                $banner->delete();
                $this->messageManager->addSuccess(__('The Banner has been deleted.'));
                $this->_eventManager->dispatch(
                    'adminhtml_bonsai_slider_banner_on_delete',
                    ['name' => $name, 'status' => 'success']
                );
                $resultRedirect->setPath('bonsai_slider/*/');
                return $resultRedirect;
            } catch (\Exception $e) {
                $this->_eventManager->dispatch(
                    'adminhtml_bonsai_slider_banner_on_delete',
                    ['name' => $name, 'status' => 'fail']
                );
                // display error message
                $this->messageManager->addError($e->getMessage());
                // go back to edit form
                $resultRedirect->setPath('bonsai_slider/*/edit', ['banner_id' => $id]);
                return $resultRedirect;
            }
        }
        // display error message
        $this->messageManager->addError(__('Banner to delete was not found.'));
        // go to grid
        $resultRedirect->setPath('bonsai_slider/*/');
        return $resultRedirect;
    }
}
