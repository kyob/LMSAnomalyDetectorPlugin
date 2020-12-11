<?php

class AnomalyDetectorHandler
{
    public function menuAnomalyDetector(array $hook_data = array())
    {
        $submenus = array(
            array(
                'name' => trans('Anomaly detector'),
                'link' => '?m=anomalydetector',
                'tip' => trans('Anomaly detector'),
                'prio' => 150,
            ),
        );
        $hook_data['admin']['submenu'] = array_merge($hook_data['admin']['submenu'], $submenus);
        return $hook_data;
    }

    public function smartyAnomalyDetector(Smarty $hook_data)
    {
        $template_dirs = $hook_data->getTemplateDir();
        $plugin_templates = PLUGINS_DIR . DIRECTORY_SEPARATOR . LMSAnomalyDetectorPlugin::PLUGIN_DIRECTORY_NAME . DIRECTORY_SEPARATOR . 'templates';
        array_unshift($template_dirs, $plugin_templates);
        $hook_data->setTemplateDir($template_dirs);
        return $hook_data;
    }

    public function modulesDirAnomalyDetector(array $hook_data = array())
    {
        $plugin_modules = PLUGINS_DIR . DIRECTORY_SEPARATOR . LMSAnomalyDetectorPlugin::PLUGIN_DIRECTORY_NAME . DIRECTORY_SEPARATOR . 'modules';
        array_unshift($hook_data, $plugin_modules);
        return $hook_data;
    }

    public function welcomeAnomalyDetector(array $hook_data = array())
    {
        $SMARTY = LMSSmarty::getInstance();
        $DB = LMSDB::getInstance();
        $iptv_tax_rate = ConfigHelper::getConfig('anomaly-detector.iptv_tax_rate_id');
        if (empty($iptv_tax_rate)) $iptv_tax_rate = 3;
        // lista komputerów, które mają przypisane taryfy telewizyjne z VAT 8%
        $anomaly_detector['non_stb_nodes_with_wrong_tariff_tax'] = $DB->GetAll('SELECT no.nodeid AS nodeid,t.name AS tariffname FROM nodeassignments no INNER JOIN assignments a ON no.assignmentid = a.id INNER JOIN tariffs t ON a.tariffid = t.id WHERE t.taxid='.$iptv_tax_rate);

        $SMARTY->assign('anomaly_detector', $anomaly_detector);
        return $hook_data;
    }

    public function accessTableInit()
    {
        $access = AccessRights::getInstance();
        $access->insertPermission(new Permission(
            'anomalydetector_full_access',
            trans('Anomaly Detector'),
            '^anomalydetector$'
        ), AccessRights::FIRST_FORBIDDEN_PERMISSION);
    }
}
