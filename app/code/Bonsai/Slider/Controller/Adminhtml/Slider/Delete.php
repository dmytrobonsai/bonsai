<?php

namespace Bonsai\Slider\Controller\Adminhtml\Slider;

class Delete extends \Bonsai\Slider\Controller\Adminhtml\Slider
{
    /**
     * execute action
     *
     * @return \Magento\Backend\Model\View\Result\Redirect
     */
    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $id = $this->getRequest()->getParam('slider_id');
        if ($id) {
            $name = "";
            try {
                /** @var \Bonsai\Slider\Model\Slider $slider */
                $slider = $this->sliderFactory->create();
                $slider->load($id);
                $name = $slider->getName();
                $slider->delete();
                $this->messageManager->addSuccess(__('The Slider has been deleted.'));
                $this->_eventManager->dispatch(
                    'adminhtml_bonsai_slider_slider_on_delete',
                    ['name' => $name, 'status' => 'success']
                );
                $resultRedirect->setPath('bonsai_slider/*/');
                return $resultRedirect;
            } catch (\Exception $e) {
                $this->_eventManager->dispatch(
                    'adminhtml_bonsai_slider_slider_on_delete',
                    ['name' => $name, 'status' => 'fail']
                );
                // display error message
                $this->messageManager->addError($e->getMessage());
                // go back to edit form
                $resultRedirect->setPath('bonsai_slider/*/edit', ['slider_id' => $id]);
                return $resultRedirect;
            }
        }
        // display error message
        $this->messageManager->addError(__('Slider to delete was not found.'));
        // go to grid
        $resultRedirect->setPath('bonsai_slider/*/');
        return $resultRedirect;
    }
}
