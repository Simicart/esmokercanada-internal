<?php
define( 'SITEGUARDING_FIREWALL_STATUS', true);		  // true - firewall works, false - disabled

define( 'SITEGUARDING_DIRSEP', '/');		                          // for Unix leave /

$tmp_DOCUMENT_ROOT = dirname(dirname(dirname(__FILE__))).SITEGUARDING_DIRSEP;
if (strpos( $_SERVER['SCRIPT_FILENAME'], $tmp_DOCUMENT_ROOT ) === false) $tmp_DOCUMENT_ROOT = $_SERVER['DOCUMENT_ROOT'].SITEGUARDING_DIRSEP;
define( 'SITEGUARDING_SCAN_PATH', $tmp_DOCUMENT_ROOT);		  // Full path e.g. /home/aaa/public_html/
unset($tmp_DOCUMENT_ROOT);

define( 'SITEGUARDING_IP_FINDER_METHOD', '');		// Default '' all, REMOTE_ADDR, HTTP_X_REAL_IP, HTTP_X_FORWARDED_FOR, HTTP_CF_CONNECTING_IP

define( 'SITEGUARDING_DEFAULT_ACTION', 'allow');		// Default action for session
define( 'SITEGUARDING_EMAIL_FOR_ALERTS', 'team@siteguarding.com');		// Email for alerts
define( 'SITEGUARDING_SINGLE_LOG_FILE', false);		// false - For each file creates own log file, false - single log file
define( 'SITEGUARDING_SAVE_EMPTY_REQUESTS', true);	// true - save all requests (if (count($_REQUEST) =>0)
define( 'SITEGUARDING_FLOAT_FILE_FOLDER', false);	// true - for global server analyze, false for single website
define( 'SITEGUARDING_LOG_FILE_MAX_SIZE', 3);	    // log file in Mb
define( 'SITEGUARDING_BLOCK_BASE64_REQUESTS', false);	            // will block any requests what possible to decode by base64	(default: false)
define( 'SITEGUARDING_BLOCK_REQUESTS_NOSPACES_OVER_BYTES', 50000);	// will block any requests with no spaces if the lenth over xxx bytes (0 - for not blocking)
define( 'SITEGUARDING_BLOCK_EMPTY_FILES', true);	// will block access to empty files (size 0 bytes) true - block , false - allow
define( 'SITEGUARDING_PHP_ERROR_CONTROL', false);	// will create register_shutdown_function hook, saves to _php_errors.log
define( 'SITEGUARDING_DUPS', false);
define( 'SITEGUARDING_DUPS_LOCATION', '');
define( 'SITEGUARDING_UNSET_PASSWORD_DATA', false);	// true - will unset pass, password all requests, will crypt with PGP
define( 'SITEGUARDING_HTTP_FOR_ALERTS', true);	// true - will send alert to SG server
define( 'SITEGUARDING_SAVE_BLOCKED_REQUESTS', true);	// true - will save blocked requests to _blocked.log
define( 'SITEGUARDING_TRACK_IP', false);	// true - will track IPs for specific URL
define( 'SITEGUARDING_TRACK_IP_PERIOD', 15);	// Period of time for analyze in minutes
define( 'SITEGUARDING_TRACK_IP_AMOUNT', 25);	// Amount of IPs per period to block
define( 'SITEGUARDING_BLOCK_UPLOADED_FILE', false);	// All uploaded files will be blocked (see allowed types ALLOWED_FILE_TYPES)
define( 'SITEGUARDING_MANAGE_HTTP_X_FORWARDED_FOR', false);	// All uploaded files will be blocked (see allowed types ALLOWED_FILE_TYPES)
define( 'SITEGUARDING_GEO_CONTROL', false);	// true - will filter traffic by country SITEGUARDING_GEO_BLOCK_LIST, SITEGUARDING_GEO_ALLOW_LIST
define( 'SITEGUARDING_GEO_REDIRECT', false);	// true - will redirect traffic by country (see GEO_REDIRECT)
define( 'SITEGUARDING_GEO_URL_REWRITE_REDIRECT', false);	// true - will use language URL redirect
define( 'SITEGUARDING_GEO_BLOCK_LIST', '');	// Blocks the countries from the list, other will be allowed. E.g. 'US,CA' ! no spaces
define( 'SITEGUARDING_GEO_ALLOW_LIST', '');	// Allows the countries from the list, other will be blocked. E.g. 'US,CA' ! no spaces 
define( 'SITEGUARDING_COLLECT_HTTP_USER_AGENT', false);	// true will save HTTP_USER_AGENT info in the logs
define( 'SITEGUARDING_COLLECT_COOKIE', false);	// true will save $_COOKIE info in the logs
define( 'SITEGUARDING_FILTER_BOTS', false);	// true will filer bots by rule BOTS_RULES
define( 'SITEGUARDING_SHOW_SPECIAL_HTML_FOR_BOTS', false);	// true will show html code from file firewall.bots.html
define( 'SITEGUARDING_SHOW_SPECIAL_HTML_FOR_BOTS_TILL_DATE', '');	// format: 'YYYY-MM-DD'', if '' will show forever
define( 'SITEGUARDING_LOGS_DISABLE_GZ', false);	// true - will use plain text for logs, false - will use gz format
define( 'SITEGUARDING_ACTIVE_ANTIBOT', false);	// true - will block bots, false - allow all bots, see ANTIBOT section
define( 'SITEGUARDING_ANTIBOT_ALL_SITE', true);	// true - block bots on whole website, false - block bots for specific URLs, see ANTIBOT_URLS section
define( 'SITEGUARDING_ACTIVE_AUTOBLOCK_IP', false);	// true - will add suspicion IP to block list (see BLOCK_IP_REQUESTS)
define( 'SITEGUARDING_ADD_BLOCKED_SESSIONS_IP_TO_RULES', false);	// true - will add suspicion IP to BLOCK_ALL_IP section
define( 'SITEGUARDING_ADD_BLOCKED_SESSIONS_IP_TO_HTACCESS', false);	// true - will add suspicion IP to .htaccess file
define( 'SITEGUARDING_RUN_PLUGIN', false);	// true - will load firewall.plugin.php
define( 'SITEGUARDING_HOSTING_SERVER_VERIFICATION', true);  // true - checks for own server
define( 'SITEGUARDING_LOGIN_VERIFICATION', false);  // true - adds captcha on login page
define( 'SITEGUARDING_PAGE_VERIFICATION', false);  // true - adds captcha on links from VERIFICATION_URLS
define( 'SITEGUARDING_GOOGLE_SITEKEY', '');
define( 'SITEGUARDING_GOOGLE_SECRETKEY', '');
define( 'SITEGUARDING_PASSWORD_PAGE_ALL_SITE', false);	// true - password page verification for all pages
define( 'SITEGUARDING_PASSWORD_PAGE_VERIFICATION', false); // true - adds password check on links from PASSWORD_VERIFICATION_URLS
define( 'SITEGUARDING_RUN_CRON_ACTIONS', true);

define( 'SITEGUARDING_BLOCK_MESSAGE', 'Access is not allowed. Please contact website webmaster or SiteGuarding.com support. Blocked IP address is {IP}.'."\n\n".'If you are the owner of this website, please login into your account https://www.siteguarding.com/en/login and add your IP to allow list.');	// Custom block message or reads firewall.block.html (if exists)
define( 'SITEGUARDING_CHECK_UPLOADED_FILE_EXT', false);
define( 'SITEGUARDING_ANALYZE_IP_FLOW', false);