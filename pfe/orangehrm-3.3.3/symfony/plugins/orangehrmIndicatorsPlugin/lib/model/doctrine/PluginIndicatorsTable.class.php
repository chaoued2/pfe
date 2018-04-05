<?php

class PluginIndicatorsTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object PluginIndicatorsTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('PluginIndicators');
    }
}