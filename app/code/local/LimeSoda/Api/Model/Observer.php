<?php

class LimeSoda_Api_Model_Observer
{
        /**
         * Fixes magento bug #26770 (SOAP Response truncated for V2 WS-I call).
         *
         * @param Varien_Event_Observer $observer
         * @return LimeSoda_Api_Model_Observer
         */
        public function controllerActionPostdispatchApiV2SoapIndex(Varien_Event_Observer $observer)
        {
                $controller = $observer->getEvent()->getControllerAction();
                if ($controller->getRequest()->getParam('wsdl') !== null) {
                        return;
                }
                $controller->getResponse()->setHeader('Content-Length',strlen($controller->getResponse()->getBody()), true);
                return $this;
        }
}