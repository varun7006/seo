<?php
	include '../bootstrap.php';

	// Add your accessID here
	$AccessID = 'mozscape-c3c9b9264';

	// Add your secretKey here
	$SecretKey = '57fd4ff492e9d3f6549382ce2879632c';

	// Set the rate limit
	$rateLimit = 10;

	$authenticator = new Authenticator();
	$authenticator->setAccessID($AccessID);
	$authenticator->setSecretKey($SecretKey);
	$authenticator->setRateLimit($rateLimit);

	// URL to query
	$objectURL = "www.seomoz.org";

	// Metrics to retrieve (url_metrics_constants.php)
	$cols = URLMETRICS_COL_DEFAULT;

	$urlMetricsService = new URLMetricsService($authenticator);
	$response = $urlMetricsService->getUrlMetrics($objectURL, $cols);

	echo "<pre>";
	print_r($response);
?>