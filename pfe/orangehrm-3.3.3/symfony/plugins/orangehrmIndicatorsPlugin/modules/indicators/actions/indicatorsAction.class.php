<?php
/**
 * OrangeHRM is a comprehensive Human Resource Management (HRM) System that captures
 * all the essential functionalities required for any enterprise.
 * Copyright (C) 2006 OrangeHRM Inc., http://www.orangehrm.com
 *
 * OrangeHRM is free software; you can redistribute it and/or modify it under the terms of
 * the GNU General Public License as published by the Free Software Foundation; either
 * version 2 of the License, or (at your option) any later version.
 *
 * OrangeHRM is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY;
 * without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 * See the GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along with this program;
 * if not, write to the Free Software Foundation, Inc., 51 Franklin Street, Fifth Floor,
 * Boston, MA  02110-1301, USA
 */
class indicatorsAction extends sfAction {

    private $indicatorService;
    /**
     * @param sfForm $form
     * @return
     */
    public function setForm(sfForm $form) {
        if (is_null($this->form)) {
            $this->form = $form;
        }
    }

    /**
     * Get ConfigService
     * @return ConfigService
     */
    public function getConfigService() {
        if (is_null($this->configService)) {
            $this->configService = new ConfigService();
        }
        return $this->configService;
    }
    public function getIndicatorService() {

        if (!($this->indicatorService instanceof IndicatorService)) {
            $this->indicatorService = new IndicatorService();
        }

        return $this->indicatorService;
    }

    public function setIndicatorService($indicatorService) {
        $this->indicatorService = $indicatorService;
    }

    public function execute($request) {
        $this->form = new indicatorsForm();
        $this->records= $this->getIndicatorService()->getIndicatorList();
        if ($request->isMethod('post')) {
            echo "post";
            $this->form->bind($request->getParameter($this->form->getName()));
            if ($this->form->isValid()) {
                $values = $this->form->getValues();
                echo "true";

                $templateMessage = $this->form->save();
                $this->getUser()->setFlash($templateMessage['messageType'], $templateMessage['message']);

                $this->redirect('indicators/indicators');

            }
            else{
                echo "not valid" ;
                if ($this->form->hasErrors()) {
                    echo "yes error";
                    echo $this->form->renderGlobalErrors();
                    foreach ($this->form->getWidgetSchema()->getPositions() as $widgetName) {
                        echo $widgetName . '--[' . $this->form[$widgetName]->renderError() . "]<br/>";
                    }

                }else {echo "no error";}

            }
        }
    }


}

