<?php

function getAnomalyDetector()
{
    $DB = LMSDB::getInstance();

    $iptv_tax_rate = ConfigHelper::getConfig('anomaly-detector.iptv_tax_rate_id', 3);
    $type_voip = ConfigHelper::getConfig('anomaly-detector.voip_type_id', 4);

    $anomaly_detector['non_stb_nodes_with_wrong_tariff_tax'] = $DB->GetAll('SELECT no.nodeid AS nodeid,t.name AS tariffname FROM nodeassignments no INNER JOIN assignments a ON no.assignmentid = a.id INNER JOIN tariffs t ON a.tariffid = t.id WHERE t.taxid=' . $iptv_tax_rate);
    $anomaly_detector['voip_tariff_assigned_to_nodes'] = $DB->GetAll('SELECT no.nodeid AS nodeid,t.name AS tariffname FROM nodeassignments no INNER JOIN assignments a ON no.assignmentid = a.id INNER JOIN tariffs t ON a.tariffid = t.id WHERE t.type=' . $type_voip);

    return $anomaly_detector;
}

$SMARTY->assign('anomaly_detector', getAnomalyDetector());
$SMARTY->display('anomalydetector.html');
