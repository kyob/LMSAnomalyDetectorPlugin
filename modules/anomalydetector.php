<?php

function getAnomalyDetector()
{
    $DB = LMSDB::getInstance();
    $iptv_tax_rate = ConfigHelper::getConfig('anomaly-detector.iptv_tax_rate_id');
    if (empty($iptv_tax_rate)) {
        $iptv_tax_rate = 3;
    }
    $anomaly_detector['non_stb_nodes_with_wrong_tariff_tax'] = $DB->GetAll('SELECT no.nodeid AS nodeid,t.name AS tariffname FROM nodeassignments no INNER JOIN assignments a ON no.assignmentid = a.id INNER JOIN tariffs t ON a.tariffid = t.id WHERE t.taxid=' . $iptv_tax_rate);

    return $anomaly_detector;
}

$SMARTY->assign('anomaly_detector', getAnomalyDetector());
$SMARTY->display('anomalydetector.html');
