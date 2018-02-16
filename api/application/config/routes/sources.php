<?php

$route['sources'] = 'sources/Source';

$route['sources/getsourcelist'] = 'sources/Source/getSourceList';
$route['sources/gettaglist'] = 'sources/Source/getTagList';
$route['sources/savenewsource'] = 'sources/Source/saveNewSource';
$route['sources/updatesource'] = 'sources/Source/updateSource';
$route['sources/deletesource'] = 'sources/Source/deleteSource';
$route['sources/sendmail'] = 'sources/Source/sendMail';
$route['sources/saveexcel']  = 'sources/Source/saveExcel';
$route['sources/addsources'] = 'sources/Source/addNewSourceView';
$route['sources/viewsourcereport'] = 'sources/Source/viewSourceReport';
$route['sources/getsourcereport'] = 'sources/Source/getSourceReport';
$route['sources/generate_source_report_manually'] = 'sources/Source/generateSourceReportManually';
$route['sources/brokensources'] = 'sources/Source/getBrokenSourceView';
$route['sources/getbrokensourcelist'] = 'sources/Source/getBrokenSourceList';