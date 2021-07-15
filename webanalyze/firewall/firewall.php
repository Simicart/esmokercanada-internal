<?php
/**
 * Collect all requests module
 * Copyright by SiteGuarding.com
 * Date: 20 Jan 2021
 * ver.: 6.0.4
 */
define( 'SITEGUARDING_FIREWALL_VERSION', '6.0.4');

define( 'SITEGUARDING_DEBUG', false);
define( 'SITEGUARDING_DEBUG_IP', '');    // 1.2.3.4

error_reporting( 0 );

if(!ini_get('date.timezone'))
{
    date_default_timezone_set('GMT');
}


if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') $DIRSEP = '\\';
else $DIRSEP = '/';

$file_firewall_class = dirname(__FILE__).$DIRSEP.'firewall.class.php';
$file_firewall_config = dirname(__FILE__).$DIRSEP.'firewall.config.php';
$file_firewall_rules = dirname(__FILE__).$DIRSEP.'rules.txt';

if (file_exists($file_firewall_config)) include_once($file_firewall_config);
else die('File is not loaded: '.$file_firewall_config);

if (!defined('SITEGUARDING_IP_FINDER_METHOD')) define( 'SITEGUARDING_IP_FINDER_METHOD', '');
if (SITEGUARDING_IP_FINDER_METHOD == '')
{
    $ip_address = $_SERVER["REMOTE_ADDR"];
    if (isset($_SERVER["HTTP_X_REAL_IP"]) && filter_var($_SERVER["HTTP_X_REAL_IP"], FILTER_VALIDATE_IP)) $ip_address = $_SERVER["HTTP_X_REAL_IP"];
    if (isset($_SERVER["HTTP_X_FORWARDED_FOR"]) && filter_var($_SERVER["HTTP_X_FORWARDED_FOR"], FILTER_VALIDATE_IP)) $ip_address = $_SERVER["HTTP_X_FORWARDED_FOR"];
    if (isset($_SERVER["HTTP_CF_CONNECTING_IP"]) && filter_var($_SERVER["HTTP_CF_CONNECTING_IP"], FILTER_VALIDATE_IP)) $ip_address = $_SERVER["HTTP_CF_CONNECTING_IP"];
}
else $ip_address = $_SERVER[SITEGUARDING_IP_FINDER_METHOD];
define( 'SITEGUARDING_THIS_SESSION_IP', $ip_address);



if (!class_exists('SiteGuarding_Firewall'))
{
	if (file_exists($file_firewall_class)) include_once($file_firewall_class);
	else die('File is not loaded: '.$file_firewall_class);
}


if (!file_exists(dirname(__FILE__).$DIRSEP.'debug.on') && SITEGUARDING_FIREWALL_STATUS === false) return; 


/**
 * Self Recovery
 */
if (!function_exists('SG_firewall_self_Recovery'))
{
	function SG_firewall_self_Recovery()
	{
        $reason = error_get_last();
        
		if (!is_null($reason))
        {
    		switch($reason['type']) 
    		{ 
    			case E_ERROR: // 1
                case E_CORE_ERROR: // 16
                case E_COMPILE_ERROR: // 64
                case E_USER_ERROR: // 256
                case E_RECOVERABLE_ERROR: // 4096
                    if (strpos($reason['file'], '/webanalyze/firewall/firewall.'))
                    {
                        $status = SiteGuarding_Firewall::CheckUpdates(5);
                        if ($status) SiteGuarding_Firewall::SelfRecoveryNotification($reason);
                    }
                    break;
    		}
        }
	}
    register_shutdown_function('SG_firewall_self_Recovery');
}


$firewall = new SiteGuarding_Firewall();

//if (SITEGUARDING_DEBUG === true && SITEGUARDING_DEBUG_IP == SITEGUARDING_THIS_SESSION_IP) $firewall->DebugTestFunctionCode();


if (!file_exists($file_firewall_rules))
{
    if (file_exists($file_firewall_rules.'.gzs')) $firewall->RestoreRulesFile($file_firewall_rules.'.gzs', $file_firewall_rules);
    else $firewall->RestoreRulesFile(true, $file_firewall_rules);
}


/**
 * Debug some values
 */
if (SITEGUARDING_DEBUG === true)
{
    $firewall->SaveDebug('Class:'.$file_firewall_class, true);
    $firewall->SaveDebug('Config: '.$file_firewall_config);
    $firewall->SaveDebug('Rules: '.$file_firewall_rules);
    $firewall->SaveDebug('__FILE__: '.__FILE__);
    $firewall->SaveDebug('IP: '.SITEGUARDING_THIS_SESSION_IP);
    $firewall->SaveDebug('SITEGUARDING_SCAN_PATH: '.SITEGUARDING_SCAN_PATH);
    $firewall->SaveDebug('Request: <br><pre>'.print_r($_REQUEST, true).'</pre>');
    $firewall->SaveDebug('Server: <br><pre>'.print_r($_SERVER, true).'</pre>');
}


// Some init constants
if (!defined('SITEGUARDING_LOG_FILE_MAX_SIZE')) define( 'SITEGUARDING_LOG_FILE_MAX_SIZE', 3);	// log file in Mb
if (!defined('SITEGUARDING_BLOCK_BASE64_REQUESTS')) define( 'SITEGUARDING_BLOCK_BASE64_REQUESTS', false);	// block any base64 requests
if (!defined('SITEGUARDING_BLOCK_REQUESTS_NOSPACES_OVER_BYTES')) define( 'SITEGUARDING_BLOCK_REQUESTS_NOSPACES_OVER_BYTES', 0);	// block any long-nospaces requests
if (!defined('SITEGUARDING_BLOCK_EMPTY_FILES')) define( 'SITEGUARDING_BLOCK_EMPTY_FILES', true);	// block access to empty files
if (!defined('SITEGUARDING_PHP_ERROR_CONTROL')) define( 'SITEGUARDING_PHP_ERROR_CONTROL', false);	// control php errors
if (!defined('SITEGUARDING_UNSET_PASSWORD_DATA')) define( 'SITEGUARDING_UNSET_PASSWORD_DATA', false);	// unset passwords
if (!defined('SITEGUARDING_DUPS')) define( 'SITEGUARDING_DUPS', false);	
if (!defined('SITEGUARDING_HTTP_FOR_ALERTS')) define( 'SITEGUARDING_HTTP_FOR_ALERTS', true);	
if (!defined('SITEGUARDING_SAVE_BLOCKED_REQUESTS')) define( 'SITEGUARDING_SAVE_BLOCKED_REQUESTS', true);	
if (!defined('SITEGUARDING_TRACK_IP')) define( 'SITEGUARDING_TRACK_IP', false);	
if (!defined('SITEGUARDING_BLOCK_UPLOADED_FILE')) define( 'SITEGUARDING_BLOCK_UPLOADED_FILE', false);	
if (!defined('SITEGUARDING_BLOCK_UPLOAD_BY_FILE_EXTENSION')) define( 'SITEGUARDING_BLOCK_UPLOAD_BY_FILE_EXTENSION', '.php,.phtml,.cgi,.pl');	
if (!defined('SITEGUARDING_MANAGE_HTTP_X_FORWARDED_FOR')) define( 'SITEGUARDING_MANAGE_HTTP_X_FORWARDED_FOR', false);	
if (!defined('SITEGUARDING_DUPS_LOCATION')) define( 'SITEGUARDING_DUPS_LOCATION', '');	
if (!defined('SITEGUARDING_GEO_CONTROL')) define( 'SITEGUARDING_GEO_CONTROL', false);	
if (!defined('SITEGUARDING_GEO_REDIRECT')) define( 'SITEGUARDING_GEO_REDIRECT', false);	
if (!defined('SITEGUARDING_GEO_URL_REWRITE_REDIRECT')) define( 'SITEGUARDING_GEO_URL_REWRITE_REDIRECT', false);	
if (!defined('SITEGUARDING_GEO_BLOCK_LIST')) define( 'SITEGUARDING_GEO_BLOCK_LIST', '');	
if (!defined('SITEGUARDING_GEO_ALLOW_LIST')) define( 'SITEGUARDING_GEO_ALLOW_LIST', '');	
if (!defined('SITEGUARDING_COLLECT_HTTP_USER_AGENT')) define( 'SITEGUARDING_COLLECT_HTTP_USER_AGENT', false);	
if (!defined('SITEGUARDING_COLLECT_COOKIE')) define( 'SITEGUARDING_COLLECT_COOKIE', false);	
if (!defined('SITEGUARDING_FILTER_BOTS')) define( 'SITEGUARDING_FILTER_BOTS', false);	
if (!defined('SITEGUARDING_SHOW_SPECIAL_HTML_FOR_BOTS')) define( 'SITEGUARDING_SHOW_SPECIAL_HTML_FOR_BOTS', false);	
if (!defined('SITEGUARDING_SHOW_SPECIAL_HTML_FOR_BOTS_TILL_DATE')) define( 'SITEGUARDING_SHOW_SPECIAL_HTML_FOR_BOTS_TILL_DATE', '');	
if (!defined('SITEGUARDING_LOGS_DISABLE_GZ')) define( 'SITEGUARDING_LOGS_DISABLE_GZ', false);	
if (!defined('SITEGUARDING_ACTIVE_ANTIBOT')) define( 'SITEGUARDING_ACTIVE_ANTIBOT', false);	
if (!defined('SITEGUARDING_ANTIBOT_ALL_SITE')) define( 'SITEGUARDING_ANTIBOT_ALL_SITE', true);	
if (!defined('SITEGUARDING_ACTIVE_AUTOBLOCK_IP')) define( 'SITEGUARDING_ACTIVE_AUTOBLOCK_IP', false);
if (!defined('SITEGUARDING_RUN_PLUGIN')) define( 'SITEGUARDING_RUN_PLUGIN', false);	
if (!defined('SITEGUARDING_ADD_BLOCKED_SESSIONS_IP_TO_RULES')) define( 'SITEGUARDING_ADD_BLOCKED_SESSIONS_IP_TO_RULES', false);	
if (!defined('SITEGUARDING_ADD_BLOCKED_SESSIONS_IP_TO_HTACCESS')) define( 'SITEGUARDING_ADD_BLOCKED_SESSIONS_IP_TO_HTACCESS', false);	
if (!defined('SITEGUARDING_HOSTING_SERVER_VERIFICATION')) define( 'SITEGUARDING_HOSTING_SERVER_VERIFICATION', true);

if (!defined('SITEGUARDING_LOGIN_VERIFICATION')) define( 'SITEGUARDING_LOGIN_VERIFICATION', false);
if (!defined('SITEGUARDING_PAGE_VERIFICATION')) define( 'SITEGUARDING_PAGE_VERIFICATION', false);
if (!defined('SITEGUARDING_GOOGLE_SITEKEY')) define( 'SITEGUARDING_GOOGLE_SITEKEY', '');
if (!defined('SITEGUARDING_GOOGLE_SECRETKEY')) define( 'SITEGUARDING_GOOGLE_SECRETKEY', '');

if (!defined('SITEGUARDING_PASSWORD_PAGE_ALL_SITE')) define( 'SITEGUARDING_PASSWORD_PAGE_ALL_SITE', false);
if (!defined('SITEGUARDING_PASSWORD_PAGE_VERIFICATION')) define( 'SITEGUARDING_PASSWORD_PAGE_VERIFICATION', false);

if (!defined('SITEGUARDING_RUN_CRON_ACTIONS')) define( 'SITEGUARDING_RUN_CRON_ACTIONS', true);
if (!defined('SITEGUARDING_CMS_CONTROL')) define( 'SITEGUARDING_CMS_CONTROL', true);
if (!defined('SITEGUARDING_CHECK_PHP_PREPEND')) define( 'SITEGUARDING_CHECK_PHP_PREPEND', true);
	
if (!defined('SITEGUARDING_BLOCK_MESSAGE')) define( 'SITEGUARDING_BLOCK_MESSAGE', 'Access is not allowed. Please contact website webmaster or SiteGuarding.com support. Blocked IP address is {IP}.'."\n\n".'If you are the owner of this website, please login into your account https://www.siteguarding.com/en/login and add your IP to allow list.');


$firewall->TraceSiteGuardingRequest();


$firewall->this_session_rule = SITEGUARDING_DEFAULT_ACTION;
$firewall->email_for_alerts = SITEGUARDING_EMAIL_FOR_ALERTS;
$firewall->save_empty_requests = SITEGUARDING_SAVE_EMPTY_REQUESTS;
$firewall->single_log_file = SITEGUARDING_SINGLE_LOG_FILE;
$firewall->scan_path = SITEGUARDING_SCAN_PATH;
$firewall->dirsep = SITEGUARDING_DIRSEP;
$firewall->float_file_folder = SITEGUARDING_FLOAT_FILE_FOLDER;

// Update by request
if (isset($_REQUEST['siteguarding_firewall_update']) && intval($_REQUEST['siteguarding_firewall_update']) == 1) $firewall->CheckUpdates(360);


$status = $firewall->CheckUpdateKey();
if ($status === false) 
{
    if (SITEGUARDING_DEBUG === true) $firewall->SaveDebug('Disabled. Not valid firewall.key.txt');
    return;
}
else {
    if ($status == 'T')
    {
        if (SITEGUARDING_DEBUG === true) $firewall->SaveDebug('[T] mode started');
        
        // Load and parse the rules
        $firewall->LoadRules();
        
        if (SITEGUARDING_DEBUG === true) $firewall->SaveDebug('Rules: '.print_r($firewall->rules, true));
        
        // Check if any action for IP is allowed
        if (SITEGUARDING_DEBUG === true) $firewall->SaveDebug('[T][Start - CheckIP_in_Allowed]');
        if ($firewall->CheckIP_in_Allowed(SITEGUARDING_THIS_SESSION_IP)) {$firewall->LogRequest(); return;}
        
        
        // GEO control
        if (SITEGUARDING_GEO_CONTROL)
        {
            if (SITEGUARDING_DEBUG === true) $firewall->SaveDebug('[T][Start - GEO Control]');
        	
            if (file_exists(dirname(__FILE__).$DIRSEP.'firewall.geo.php'))
            {
                if (!class_exists('sg_Geo_IP2Country_alone')) include_once(dirname(__FILE__).$DIRSEP.'firewall.geo.php');
        		
                if (class_exists('sg_Geo_IP2Country_alone')) $geo = new sg_Geo_IP2Country_alone;
                else if (class_exists('sg_Geo_IP2Country')) $geo = new sg_Geo_IP2Country;
                
                $firewall->UpdateGEOdatabase();
                
        		$country_code = $geo->getCountryByIP(SITEGUARDING_THIS_SESSION_IP);
        		
        		if (SITEGUARDING_DEBUG === true) $firewall->SaveDebug('GEO Your country: '.$country_code);
        
                if (SITEGUARDING_GEO_ALLOW_LIST != '')
                {
        			if (SITEGUARDING_DEBUG === true) $firewall->SaveDebug('GEO ALLOW_LIST: '.SITEGUARDING_GEO_ALLOW_LIST);
        			
                    $country_codes = explode(",", SITEGUARDING_GEO_ALLOW_LIST);
        
                    if (!in_array($country_code, $country_codes))
                    {
                        $country_name = $geo->getNameByCountryCode($country_code);
                        $geo->BlockPage(SITEGUARDING_THIS_SESSION_IP, $country_name);
                        $firewall->Block_This_Session('Country is not ALLOWED list ['.$country_code.']', false, false, true);   // the process will die
                        exit;
                    }
                }
                else if (SITEGUARDING_GEO_BLOCK_LIST != '')
                {
        			if (SITEGUARDING_DEBUG === true) $firewall->SaveDebug('GEO ALLOW_LIST: '.SITEGUARDING_GEO_BLOCK_LIST);
        			
                    $country_codes = explode(",", SITEGUARDING_GEO_BLOCK_LIST);
                    if (in_array($country_code, $country_codes))
                    {
                        $country_name = $geo->getNameByCountryCode($country_code);
                        $geo->BlockPage(SITEGUARDING_THIS_SESSION_IP, $country_name);
                        $firewall->Block_This_Session('Country is in BLOCK list ['.$country_code.']', false, false, true);   // the process will die
                        exit;
                    }
                }
                
                // GEO Redirect
                if (SITEGUARDING_GEO_REDIRECT)
                {
                    if (SITEGUARDING_DEBUG === true) $firewall->SaveDebug('[T][Start - GEO_Redirect]');
                    $firewall->GEO_Redirect($country_code);
                }
            }
            else {
                if (SITEGUARDING_DEBUG === true)
                {
                    $firewall->SaveDebug('GEO Class is absent');
                }
            }
        }
        
        
        // Check antibot session if enabled
        if (SITEGUARDING_ACTIVE_ANTIBOT === true)
        {
            if (SITEGUARDING_DEBUG === true) $firewall->SaveDebug('[T][Start - CheckAntiBot_Session]');
            if (SITEGUARDING_ANTIBOT_ALL_SITE === true) $firewall->CheckAntiBot_Session();
            else if ($firewall->Match_URL_by_rule($_SERVER['REQUEST_URI'], 'ANTIBOT_URLS') === true) $firewall->CheckAntiBot_Session();
        }
        
        
        if (SITEGUARDING_PAGE_VERIFICATION && SITEGUARDING_GOOGLE_SITEKEY != '' && SITEGUARDING_GOOGLE_SECRETKEY != '')
        {
            if (SITEGUARDING_DEBUG === true) $firewall->SaveDebug('[T][Start - PageCaptchaVerification]');
            $firewall->PageCaptchaVerification();
        }


        if (SITEGUARDING_PASSWORD_PAGE_VERIFICATION === true)
        {
            if (SITEGUARDING_DEBUG === true) $firewall->SaveDebug('[T][Start - PasswordVerificationPage]');
            if (SITEGUARDING_PASSWORD_PAGE_ALL_SITE === true) $firewall->PasswordVerificationPage();
            else if ($firewall->Match_URL_by_rule($_SERVER['REQUEST_URI'], 'PASSWORD_VERIFICATION_URLS', true) === true) $firewall->PasswordVerificationPage();
        }


        if (SITEGUARDING_DEBUG === true)
        {
            $firewall->SaveDebug('[T] mode Finished');
        }
        
        unset($firewall);
        return;
    }
    
}


$firewall->CheckUpdates();





// PHP errors control
if (SITEGUARDING_PHP_ERROR_CONTROL === true)
{
	if (!function_exists('A4C2651A109E0_PHP_error_control'))
	{
		function A4C2651A109E0_PHP_error_control()
		{
			$reason = error_get_last();
            
            if (!is_null($reason))
            {
				switch($reason['type']) 
				{ 
					case E_ERROR: // 1
						$reason['type'] = 'E_ERROR'; break;
					case E_WARNING: // 2
						$reason['type'] =  'E_WARNING';	break;
					case E_PARSE: // 4
						$reason['type'] =  'E_PARSE'; break;
					case E_NOTICE: // 8 
						$reason['type'] =  'E_NOTICE'; break;
					case E_CORE_ERROR: // 16
						$reason['type'] =  'E_CORE_ERROR'; break;
					case E_CORE_WARNING: // 32
						$reason['type'] =  'E_CORE_WARNING'; break;
					case E_COMPILE_ERROR: // 64
						$reason['type'] =  'E_COMPILE_ERROR'; break;
					case E_COMPILE_WARNING: // 128
						$reason['type'] =  'E_COMPILE_WARNING'; break;
					case E_USER_ERROR: // 256
						$reason['type'] =  'E_USER_ERROR'; break;
					case E_USER_WARNING: // 512
						$reason['type'] =  'E_USER_WARNING'; break;
					case E_USER_NOTICE: // 1024
						$reason['type'] =  'E_USER_NOTICE'; break;
					case E_STRICT: // 2048
						$reason['type'] =  'E_STRICT'; break;
					case E_RECOVERABLE_ERROR: // 4096
						$reason['type'] =  'E_RECOVERABLE_ERROR'; break;
					case E_DEPRECATED: // 8192
						$reason['type'] =  'E_DEPRECATED'; break;
					case E_USER_DEPRECATED: // 16384
						$reason['type'] =  'E_USER_DEPRECATED';break;
					default:
						$reason['type'] = '';
				} 
                
    			if ($reason['type'] != '')
    			{
    				$a = date("Y-m-d H:i:s").' '.$reason['type'].': '.$reason['message'].' File: '.$reason['file'].' Line: '.$reason['line']."\n\n";
    				$log_file = dirname(__FILE__).'/logs/'.'_php_errors.log';
    				$fp = fopen($log_file, 'a');
    				fwrite($fp, $a);
    				fclose($fp);
    			}
            }
		}
	}
    register_shutdown_function('A4C2651A109E0_PHP_error_control');
}



// Check SiteGuarding FM
if ($firewall->CheckIfOwnTools()) 
{
    $firewall->LogRequest(true);
    return;
}


// Load and parse the rules
if (!$firewall->LoadRules()) die('Rules are not loaded');
if (SITEGUARDING_DEBUG === true) $firewall->SaveDebug('Rules: '.print_r($firewall->rules, true));



// Checking if the file is empty
if (SITEGUARDING_BLOCK_EMPTY_FILES === true && file_exists($_SERVER['SCRIPT_FILENAME']) && filesize($_SERVER['SCRIPT_FILENAME']) == 0)
{
    $firewall->Block_This_Session('Access to empty file '.$_SERVER["SCRIPT_FILENAME"]);   // the process will die
    exit;
}



// Check if any action for IP is allowed
if (SITEGUARDING_DEBUG === true) $firewall->SaveDebug('[Start - CheckIP_in_Allowed]');
if ($firewall->CheckIP_in_Allowed(SITEGUARDING_THIS_SESSION_IP)) {$firewall->LogRequest(); return;}


// Run plugins 
$file_firewall_plugin = dirname(__FILE__).$DIRSEP.'firewall.plugin.php';
if (SITEGUARDING_RUN_PLUGIN === true && SITEGUARDING_ACTIVE_ANTIBOT === true && file_exists($file_firewall_plugin))
{
    if (SITEGUARDING_DEBUG === true) $firewall->SaveDebug('[Start - run plugin (before antibot)]');
    include_once($file_firewall_plugin);
}




// GEO control
if (SITEGUARDING_GEO_CONTROL)
{
    if (SITEGUARDING_DEBUG === true) $firewall->SaveDebug('[Start - GEO Control]');
	
    if (file_exists(dirname(__FILE__).$DIRSEP.'firewall.geo.php'))
    {
        if (!class_exists('sg_Geo_IP2Country_alone')) include_once(dirname(__FILE__).$DIRSEP.'firewall.geo.php');
		
        if (class_exists('sg_Geo_IP2Country_alone')) $geo = new sg_Geo_IP2Country_alone;
        else if (class_exists('sg_Geo_IP2Country')) $geo = new sg_Geo_IP2Country;
        
		$country_code = $geo->getCountryByIP(SITEGUARDING_THIS_SESSION_IP);
		
		if (SITEGUARDING_DEBUG === true) $firewall->SaveDebug('GEO Your country: '.$country_code);

        if (SITEGUARDING_GEO_ALLOW_LIST != '')
        {
			if (SITEGUARDING_DEBUG === true) $firewall->SaveDebug('GEO ALLOW_LIST: '.SITEGUARDING_GEO_ALLOW_LIST);
			
            $country_codes = explode(",", SITEGUARDING_GEO_ALLOW_LIST);

            if (!in_array($country_code, $country_codes))
            {
                $country_name = $geo->getNameByCountryCode($country_code);
                $geo->BlockPage(SITEGUARDING_THIS_SESSION_IP, $country_name);
                $firewall->Block_This_Session('Country is not ALLOWED list ['.$country_code.']', false, false, true);   // the process will die
                exit;
            }
        }
        else if (SITEGUARDING_GEO_BLOCK_LIST != '')
        {
			if (SITEGUARDING_DEBUG === true) $firewall->SaveDebug('GEO ALLOW_LIST: '.SITEGUARDING_GEO_BLOCK_LIST);
			
            $country_codes = explode(",", SITEGUARDING_GEO_BLOCK_LIST);
            if (in_array($country_code, $country_codes))
            {
                $country_name = $geo->getNameByCountryCode($country_code);
                $geo->BlockPage(SITEGUARDING_THIS_SESSION_IP, $country_name);
                $firewall->Block_This_Session('Country is in BLOCK list ['.$country_code.']', false, false, true);   // the process will die
                exit;
            }
        }
        
        // GEO Redirect
        if (SITEGUARDING_GEO_REDIRECT)
        {
            if (SITEGUARDING_DEBUG === true) $firewall->SaveDebug('[Start - GEO_Redirect]');
            $firewall->GEO_Redirect($country_code);
        }
    }
    else {
        if (SITEGUARDING_DEBUG === true)
        {
            $firewall->SaveDebug('GEO Class is absent');
        }
    }
}


// Check antibot session if enabled
if (SITEGUARDING_ACTIVE_ANTIBOT === true)
{
    if (SITEGUARDING_DEBUG === true) $firewall->SaveDebug('[Start - CheckAntiBot_Session]');
    if (SITEGUARDING_ANTIBOT_ALL_SITE === true) $firewall->CheckAntiBot_Session();
    else if ($firewall->Match_URL_by_rule($_SERVER['REQUEST_URI'], 'ANTIBOT_URLS') === true) $firewall->CheckAntiBot_Session();
}


// Check if any action for IP is blocked
if ($firewall->CheckIP_in_Blocked(SITEGUARDING_THIS_SESSION_IP))
{
    $firewall->Block_This_Session('Not allowed IP '.SITEGUARDING_THIS_SESSION_IP);   // the process will die
    exit;
}


if (SITEGUARDING_MANAGE_HTTP_X_FORWARDED_FOR === true && isset($_SERVER['HTTP_X_FORWARDED_FOR']))
{
    $firewall->Block_This_Session('HTTP_X_FORWARDED is not allowed IP '.SITEGUARDING_THIS_SESSION_IP);   // the process will die
    exit;
}


// Track DDoS
if (SITEGUARDING_TRACK_IP === true)
{
    if ( $firewall->Track_IP_check_url($_SERVER['REQUEST_URI']) )
    {
        if ($firewall->Track_IP_analyze(SITEGUARDING_THIS_SESSION_IP) == 'block')
        {
            $firewall->Ban_IP_in_rules(SITEGUARDING_THIS_SESSION_IP);
            $firewall->Block_This_Session('TRACK_IP limit '.SITEGUARDING_THIS_SESSION_IP.' is banned');   // the process will die
        }
    }
}



// Check Allowed Requests (to specific file)
if (strpos( $_SERVER['SCRIPT_FILENAME'], SITEGUARDING_SCAN_PATH) != 0)
{
	$SCRIPT_FILENAME = substr($_SERVER['SCRIPT_FILENAME'], strpos( $_SERVER['SCRIPT_FILENAME'], SITEGUARDING_SCAN_PATH));
}
else $SCRIPT_FILENAME = $_SERVER['SCRIPT_FILENAME'];
if (SITEGUARDING_DEBUG === true)
{
	$firewall->SaveDebug('$SCRIPT_FILENAME='.$SCRIPT_FILENAME);
}
$firewall->CopyStrangeFiles($SCRIPT_FILENAME);
if ($firewall->Session_Check_FilesRequests($SCRIPT_FILENAME, $_REQUEST, 'allow') === true) {$firewall->LogRequest(); return;}
if ($firewall->Session_Check_FilesRequests($SCRIPT_FILENAME, $_REQUEST, 'block') === true) 
{
    $firewall->Block_This_Session('Rules for the file with', true);   // the process will die
    exit;
}

// GEO control by file GEO_FILES
if (SITEGUARDING_GEO_CONTROL && isset($country_code))
{
    if ($firewall->CheckGEOFile($SCRIPT_FILENAME, $country_code) == 'block')
    {
        $country_name = $geo->getNameByCountryCode($country_code);
        $geo->BlockPage(SITEGUARDING_THIS_SESSION_IP, $country_name);
        $firewall->Block_This_Session('GEO_FILES Country is not ALLOWED list ['.$country_code.']', false, false, true);   // the process will die
        exit;
    }
}



// Check Allowed Requests (to any file)
if ($firewall->Session_Check_Requests_Allowed($_REQUEST)) {$firewall->LogRequest(); return;}




// Global RULES
$tmp_session_rule = $firewall->Session_Apply_Rules($SCRIPT_FILENAME);
if ($tmp_session_rule != '') $firewall->this_session_rule = $tmp_session_rule;

if ($firewall->this_session_rule == 'block')
{
    $firewall->Block_This_Session('Rules for the file');   // the process will die
    exit;
}




// Alert Requests
$tmp_session_rule = $firewall->Session_Alert_Requests($_REQUEST);
if ($tmp_session_rule == 'alert')
{
	$_FILES_tmp = '';
	if (count($_FILES) > 0)
	{
		$_FILES_tmp = 'UPLOADED FILES: '.print_r($_FILES, true)."\n";
	}
	
    $protocol = ($firewall->is_https()) ? 'https://' : 'http://';
    
    $siteguarding_log_line = "***ALERT_REQUESTS***"."\n".
        date("Y-m-d H:i:s")."\n".
    	"IP:".SITEGUARDING_THIS_SESSION_IP."\n".
    	"Link:".$protocol.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']."\n".
    	"File:".$_SERVER['SCRIPT_FILENAME']."\n".$_FILES_tmp.
    	print_r($_REQUEST, true)."\n\n";

    $firewall->SendAlert_to_SG($siteguarding_log_line);
}


// Check Requests
$tmp_session_rule = $firewall->Session_Check_Requests($_REQUEST);
if ($tmp_session_rule != '') $firewall->this_session_rule = $tmp_session_rule;

if ($firewall->this_session_rule == 'block')
{
    // Autoblock IP
    if (SITEGUARDING_ACTIVE_AUTOBLOCK_IP === true && $_SERVER['SERVER_ADDR'] != SITEGUARDING_THIS_SESSION_IP)
    {
        $status = $firewall->Check_IP_Block_rules($_REQUEST);
        if ($status) $firewall->SaveLogs_anyfile('_blocked_ip.log', SITEGUARDING_THIS_SESSION_IP);
    }
    
    $firewall->Block_This_Session('Request rule => '.$firewall->this_session_reason_to_block, true);   // the process will die
    exit;
}

// Check BLOCK_URLS
$tmp_session_rule = $firewall->Check_URLs($_SERVER['REQUEST_URI']);
if ($tmp_session_rule != '') $firewall->this_session_rule = $tmp_session_rule;

if ($firewall->this_session_rule == 'block')
{
    $firewall->Block_This_Session('Not allowed URL', false, true);   // the process will die and show 404 error
    exit;
}
if ($firewall->this_session_rule == 'block_404')
{
    header("HTTP/1.1 404");
    exit;
}


// Check if uploaded files are allowed
if (count($_FILES) > 0)
{
    if (SITEGUARDING_BLOCK_UPLOADED_FILE === true) 
    {
        if ($firewall->CheckUploadedFileTypes() === false)
        {
            $tmp_names = array();
            foreach ($_FILES as $tmp_row)
            {
                $tmp_names[] = $tmp_row['type'];
            }
            $firewall->Block_This_Session('File uploading is not allowed: '.implode("\n", $tmp_names));   // the process will die
        }
    }  
    
    
    if (SITEGUARDING_BLOCK_UPLOAD_BY_FILE_EXTENSION != '')  
    {
        if ($firewall->CheckUploadedFileExtension() === false)
        {
            $tmp_names = array();
            foreach ($_FILES as $tmp_row)
            {
                $tmp_names[] = $tmp_row['name'];
            }
            $firewall->Block_This_Session('File uploading by extension is not allowed : '.implode("\n", $tmp_names));   // the process will die
        }
    } 
}





if (SITEGUARDING_FILTER_BOTS === true)
{
    if ($firewall->FilterBots() == 'block')
    {
        $firewall->Block_This_Session('Bot: '.$_SERVER['HTTP_USER_AGENT']);   // the process will die
        exit;
    }
}


if (SITEGUARDING_SHOW_SPECIAL_HTML_FOR_BOTS === true && stripos($_SERVER['HTTP_USER_AGENT'], 'bot') !== false)
{
    if (SITEGUARDING_SHOW_SPECIAL_HTML_FOR_BOTS_TILL_DATE == '' || 
        (SITEGUARDING_SHOW_SPECIAL_HTML_FOR_BOTS_TILL_DATE != '' && date("Y-m-d") <= SITEGUARDING_SHOW_SPECIAL_HTML_FOR_BOTS_TILL_DATE)
    )
    {
        $html_file = dirname(__FILE__).$DIRSEP.'firewall.bots.html';
        if (file_exists($html_file)) die($firewall->Read_File($html_file));
        else die('firewall.bots.html is absent');
    }
}

if (SITEGUARDING_LOGIN_VERIFICATION && SITEGUARDING_GOOGLE_SITEKEY != '' && SITEGUARDING_GOOGLE_SECRETKEY != '')
{
    if (SITEGUARDING_DEBUG === true) $firewall->SaveDebug('[Start - LoginCaptchaVerification]');
    $firewall->LoginCaptchaVerification( $SCRIPT_FILENAME );
}


if (SITEGUARDING_PAGE_VERIFICATION && SITEGUARDING_GOOGLE_SITEKEY != '' && SITEGUARDING_GOOGLE_SECRETKEY != '')
{
    if (SITEGUARDING_DEBUG === true) $firewall->SaveDebug('[Start - PageCaptchaVerification]');
    $firewall->PageCaptchaVerification();
}


if (SITEGUARDING_PASSWORD_PAGE_VERIFICATION === true)
{
    if (SITEGUARDING_DEBUG === true) $firewall->SaveDebug('[Start - PasswordVerificationPage]');
    if (SITEGUARDING_PASSWORD_PAGE_ALL_SITE === true) $firewall->PasswordVerificationPage();
    else if ($firewall->Match_URL_by_rule($_SERVER['REQUEST_URI'], 'PASSWORD_VERIFICATION_URLS', true) === true) $firewall->PasswordVerificationPage();
}


if (SITEGUARDING_HOSTING_SERVER_VERIFICATION)
{
    $firewall->OwnHostingServerRules( $SCRIPT_FILENAME );
}



// Rewrite requests
if ($firewall->Session_Rewrite_Requests());



// Log the request (the request passed all the rules)
$firewall->LogRequest();



// Run plugins 
$file_firewall_plugin = dirname(__FILE__).$DIRSEP.'firewall.plugin.php';
if (SITEGUARDING_RUN_PLUGIN === true && SITEGUARDING_ACTIVE_ANTIBOT === false && file_exists($file_firewall_plugin))
{
    if (SITEGUARDING_DEBUG === true) $firewall->SaveDebug('[Start - run plugin (after antibot. End)]');
    include_once($file_firewall_plugin);
}


if (SITEGUARDING_RUN_CRON_ACTIONS === true && $firewall->Is_Cron_Time())
{
    if (SITEGUARDING_CMS_CONTROL === true)
    {
        $firewall->CMS_Control();
    } 
    
    if (SITEGUARDING_CHECK_PHP_PREPEND === true)
    {
        $firewall->Check_WAF_Prepend();
    }
}




if (SITEGUARDING_DEBUG === true)
{
    $firewall->SaveDebug('Finished');
}

unset($firewall);
if (isset($geo)) unset($geo);