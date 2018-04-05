<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 28/03/2018
 * Time: 09:49
 */

class checkIndicatorNameExistenceAction extends sfAction
{
    public function execute($request) {

        $this->setLayout(false);
        sfConfig::set('sf_web_debug', false);
        sfConfig::set('sf_debug', false);

        if ($this->getRequest()->isXmlHttpRequest()) {
            $this->getResponse()->setHttpHeader('Content-Type', 'application/json; charset=utf-8');
        }

        $indicatorFields = $request->getParameter('indicator');
        $indicatorService =   new IndicatorService();

        $result = $indicatorService->isExistingIndicatorName($indicatorFields['nom']);

        return $this->renderText(json_encode(!$result));

    }

}