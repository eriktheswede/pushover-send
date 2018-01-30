<?php
/**
 * pushover-send
 *
 * PHP script mainly to add pushover as an SMS provider for Synology NAS units
 * Can also be used add pushover notifications to anything else that can ping a URL
 *
 * @author Erik N
 * @version 0.2
 * @license BSD License
 */

// 
$debug_on = false;
if ($debug_on) {
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
}

include('library/php-pushover.php');

// **** Configuration - do not change anything above this line ****

// Allow from remote hosts or only local?
$allowremote = false;

// Notification priority
// Valid values:
// Lowest priority:   -2, no notification will be generated. App will need to be checked manually. Will increase badge number on iOS.
// Low priority: 	  -1, no sound or vibration, but will generate a notification.
// Normal priority:    0, default value. Will generate a notification with sound and vibration according to device setting.
// High priority:	   1, bypasses user's quiet hours set in the pushover settings.
// Emergency priority: 2, works like high priority, except repeated until acknowledged by user.
$priority = '0';

// Time in seconds between repeated emergency notifications
$retry = '60';

// Time in seconds before emergency notification expires
$expire = '3600';

// Notification sound
// The sound played by the pushover app when receiving this notification
// Valid values (standard):
// pushover, bike, bugle, cashregister, classical, cosmic, falling, gamelan, incoming, intermission,
// magic, mechanical, pianobar, siren, spacealarm, tugboat, alien, climb, persistent, echo, updown, none
// Default value: pushover
$sound = 'pushover';

// **** End of configuration - Do not change anything below this line ****

// Local or remote validation
if (!$allowremote) {
  if ($_SERVER['HTTP_HOST'] != 'localhost') {
    // Not locahost
    exit();
  }
}

// Set variables
$pushover = array();
$pushover['message'] = isset($_GET['text']) ? $_GET['text'] : false;
$pushover['token'] = isset($_GET['appkey']) ? $_GET['appkey'] : false;
$pushover['user'] = isset($_GET['userkey']) ? $_GET['userkey'] : false;

foreach ($pushover as $value) {
	if ($value == false) {
		exit('Error: not all values were set.');
	}
}

$po = new Pushover;
$po->setPriority($priority);
$po->setSound($sound);
if ($priority == 2) {
	$po->setRetry($retry);
	$po->setExpire($expire);
}
$po->setToken($pushover['token']);
$po->setUser($pushover['user']);
$po->setMessage($pushover['message']);
$po->send();

?>
