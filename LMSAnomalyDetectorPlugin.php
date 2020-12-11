<?php

/**
 * LMSAnomalyDetectorPlugin
 * 
 * @author Łukasz Kopiszka <lukasz@alfa-system.pl>
 */
class LMSAnomalyDetectorPlugin extends LMSPlugin
{
    const PLUGIN_NAME = 'LMS Anomaly Detector plugin';
    const PLUGIN_DESCRIPTION = 'Detection of potential anomalies according to defined rules.';
    const PLUGIN_AUTHOR = 'Łukasz Kopiszka &lt;lukasz@alfa-system.pl&gt;';
    const PLUGIN_DIRECTORY_NAME = 'LMSAnomalyDetectorPlugin';

    public function registerHandlers()
    {
        $this->handlers = array(
            'menu_initialized' => array(
                'class' => 'AnomalyDetectorHandler',
                'method' => 'menuAnomalyDetector'
            ),
            'smarty_initialized' => array(
                'class' => 'AnomalyDetectorHandler',
                'method' => 'smartyAnomalyDetector'
            ),
            'modules_dir_initialized' => array(
                'class' => 'AnomalyDetectorHandler',
                'method' => 'modulesDirAnomalyDetector'
            ),
            'welcome_before_module_display' => array(
                'class' => 'AnomalyDetectorHandler',
                'method' => 'welcomeAnomalyDetector'
            ),
            'access_table_initialized' => array(
                'class' => 'AnomalyDetectorHandler',
                'method' => 'accessTableInit'
            ),
        );
    }
}
