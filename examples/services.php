<?php

include('../GoogleAnalyticsAPI.class.php');

$ga = new GoogleAnalyticsAPI('service');
$ga->auth->setClientId('XXXXXXXXXXXXXXXXX.apps.googleusercontent.com'); // From the JSON key file
$ga->auth->setEmail('XXXXXXXXXXXXXXXXX@developer.gserviceaccount.com'); // From the APIs console or JSON key file
$ga->auth->setPrivateKey('p12_key_file_generated_from_APIs_console.p12'); // Path to the .p12 file

$auth = $ga->auth->getAccessToken();

// Try to get the AccessToken
if ($auth['http_code'] == 200) {
    $accessToken = $auth['access_token'];
    $tokenExpires = $auth['expires_in'];
    $tokenCreated = time();
} else {
    print_r($auth);
    die();
}

$ga->setAccessToken($accessToken);
$ga->setAccountId('ga:XXXXXXXX'); // your GA account ID,

$params = array(
    'metrics' => 'ga:users,ga:sessions,ga:pageviews',
    'dimensions' => 'ga:source,ga:medium,ga:eventCategory,ga:eventAction,ga:eventLabel',
    'max-results' => 30,
    'start-date' => date('Y-m-d',time()-7*86400)
);

$visitsData = $ga->query($params);
print_r($visitsData);
