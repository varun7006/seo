<?php

$route['reports/brokenlinks'] = 'report/Report/brokenLinkReport';
$route['reports/link_status_report_view'] = 'report/Report/linkStatusReportView';
$route['reports/getlinkstatusreport'] = 'report/Report/getLinkStatusReport';
$route['reports/savenewlinkreport'] = 'report/Report/saveNewLinkReport';
$route['reports/updatelinkreport'] = 'report/Report/updateLinkReport';
$route['reports/deletebacklink'] = 'report/Report/deleteBackLink';
$route['reports/getlinkstatusexcel/(:num)'] = 'report/Report/generateLinkStatusExcel/$1';

