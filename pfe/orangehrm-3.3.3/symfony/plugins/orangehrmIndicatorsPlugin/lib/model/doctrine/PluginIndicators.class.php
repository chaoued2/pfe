<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 27/02/2018
 * Time: 14:55
 */

abstract class PluginIndicators extends BaseIndicators
{

    const FREQ_TYPE_STRING = 'Numérique';
    const FREQ_TYPE_STRING1 = 'Chaine de Caractère';
    const FIELD_TYPE_SELECT = 1;

    const FREQ_HEBDOMADAIRE   = 'Hebdomadaire';
    const FREQ_MENSUELLE    = 'Mensuelle';
    const FREQ_TRIMESTRIELLE    = 'Trimestrielle';
    const FREQ_SEMESTRIELLE    = 'Semestrielle';
    const FREQ_ANNUELLE    = 'Annuelle';

    public function getOptions() {

        $options = array();

        if (($this->type == self::FIELD_TYPE_SELECT) && !empty($this->type_val)) {
            $options = explode(',', $this->type_val);
        }

        for ($i=0; $i<count($options); $i++) {
            $options[$i] = trim($options[$i]);
        }

        sort($options);

        return $options;

    }
}