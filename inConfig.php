<?php
//Include LinkedIn client library 
require_once 'src/http.php';
require_once 'src/oauth_client.php';

/*
 * Configuration and setup LinkedIn API
 */
$apiKey = '81iyzlfddbl3um';
$apiSecret = 'n1aUdb2k8zWKCHxG';
$redirectURL = 'http://africaglobalnetwork.com/user-edit-profile';
$scope = 'r_basicprofile r_emailaddress'; //API permissions
?>