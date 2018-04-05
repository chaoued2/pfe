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
class indicatorsForm extends BaseForm {
    private $indicatorService;
    public function configure() {

        $types = $this->getFieldTypes();
        $freq= $this->getFreq();

        $this->setWidgets(array(
            'id' => new sfWidgetFormInputHidden(),
            'name' => new sfWidgetFormInputText(),
            'type' => new sfWidgetFormSelect(array('choices' => $types)),
            'frequence' => new sfWidgetFormSelect(array('choices' => $freq)),
            'typeval' => new sfWidgetFormInputText(),

            'actif' => new sfWidgetFormInputCheckbox(array(), array('class' => 'actif')),


        ));
        unset($types['']);
        unset($freq['']);

        $this->setValidators(array(
            'id' => new sfValidatorNumber(array('required' => false)),
            'name' => new sfValidatorString(array('required' => true, 'max_length' => 120)),
            'type' => new sfValidatorChoice(array('choices' => array_keys($types))),
            'frequence' => new sfValidatorChoice(array('choices' => array_keys($freq))),
            'typeval' => new sfValidatorString(array('required' => false, 'trim'=>true, 'max_length'=>250)),
            'actif' => new sfValidatorPass(),

        ));


        $this->widgetSchema->setNameFormat('indicator[%s]');



        $this->setDefault('id', '');

    }
    public function getFieldTypes() {
        $types = array('' => '-- ' . __('Select') . ' --',
            Indicators::FREQ_TYPE_STRING => __('Numérique'),
            Indicators::FREQ_TYPE_STRING1 => __('Chaine de caractère'),
            Indicators::FIELD_TYPE_SELECT => __('Selection'));

        return $types;
    }
    public function getFreq() {
        $freq = array('' =>  '-- ' . __('Select') . ' --',
            Indicators::FREQ_HEBDOMADAIRE => __('Hebdomadaire'),
            Indicators::FREQ_MENSUELLE => __('Mensuelle'),
            Indicators::FREQ_TRIMESTRIELLE => __('Trimestrielle'),
            Indicators::FREQ_SEMESTRIELLE => __('Semestrielle'),
            Indicators::FREQ_ANNUELLE => __('Annuelle'),
        );
        return $freq;
    }


    public function getIndicatorService() {

        if (!($this->indicatorService instanceof IndicatorService)) {
            $this->indicatorService = new IndicatorService();
        }

        return $this->indicatorService;
    }

    public function save() {
        $posts = $this->getValues();


        $id = $this->getValue('id');

        if (empty($id)) {
            $indicator = new Indicators();
            $message = array('messageType' => 'success', 'message' => __(TopLevelMessages::SAVE_SUCCESS));
        } else {
            $indicator = $this->getIndicatorService()->getIndicatorById($id);
            $message = array('messageType' => 'success', 'message' => __(TopLevelMessages::UPDATE_SUCCESS));
        }

        $indicator->setNom($this->getValue('name'));
        $indicator->setFrequence($this->getValue('frequence'));
        $indicator->setType($this->getValue('type'));
        $indicator->setTypeval($this->getValue('typeval'));


        $indicator->setactif($this->getValue('actif'));


        $this->getIndicatorService()->saveIndicator($indicator);


        return $message;

    }
    public function getIndicatorListAsJson() {

        $list = array();
        $indicatorList = $this->getIndicatorService()->getIndicatorList();
        foreach ($indicatorList as $indicator) {
            $list[] = array('id' => $indicator->getId(), 'name' => $indicator->getNom());
        }
        return json_encode($list);
    }
}