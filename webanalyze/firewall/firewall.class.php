<?php
/**
 * Class Firewall (ver.: 6.0.4)
 */
class SiteGuarding_Firewall
{
    var $rules = array();

    var $scan_path = '';
    var $save_empty_requests = false;
    var $single_log_file = false;
    var $dirsep = '/';
    var $email_for_alerts = '';
    var $this_session_rule = false;
    var $this_session_reason_to_block = '';
    var $float_file_folder = false;
	
	var $log_file_max_size_for_http_alert = 25000;	// in Kb
    
    public static $ssl_public_key = '-----BEGIN PUBLIC KEY-----
MFwwDQYJKoZIhvcNAQEBBQADSwAwSAJBAMp2KcGO+q4x1fQzkeU+Sxf2VZENAKgO
Yaegs4K9owbW1se2LK0FrLcsRU1SfmOOSNU2XKtcsxccR/3N/3cRr0UCAwEAAQ==
-----END PUBLIC KEY-----';

    public static $SG_URL = 'https://www.siteguarding.com/index.php';
    
    public static $SG_IPs = array(
        '185.72.157.170',
        '185.72.157.169',
        '185.72.157.171',
        '185.72.157.172',
        '185.72.157.173',
    );


/*
    public function DebugTestFunctionCode()
    {
        
    }
*/

    
    public function RestoreRulesFile($file_rules_gzs_or_new, $file_rules)
    {
        if ($file_rules_gzs_or_new === true)
        {
            $rules_content = '::ALLOW_ALL_IP::'."\n".implode("\n", self::$SG_IPs);
        }
        else {
            $rules_content = self::Read_File($file_rules_gzs_or_new);
            $rules_content = gzinflate($rules_content);
        }
        
        self::Save_File($file_rules, $rules_content);
    }


	public function LoadRules()
	{
        $rules = array(
            'ALLOW_ALL_IP' => array(),
            'BLOCK_ALL_IP' => array(),
            /****'ALERT_IP' => array(),
            'BLOCK_RULES_IP' => array(),*/
            'RULES' => array(
                'ALLOW' => array(),
                'BLOCK' => array()
            ),
            /***'BLOCK_RULES' => array(
                'ALLOW' => array(),
                'BLOCK' => array()
            ),*/
            'GEO_FILES' => array(
                'ALLOW' => array(),
                'BLOCK' => array()
            ),
            'GEO_REDIRECT' => array(),
            'GEO_REDIRECT_URL_REWRITE' => array(),
            'BLOCK_URLS' => array(),
            'VERIFICATION_URLS' => array(),
            'PASSWORD_VERIFICATION_URLS' => array(),
            'ALLOW_REQUESTS' => array(),
            'ALERT_REQUESTS' => array(),
            'BLOCK_REQUESTS' => array(),
            'BLOCK_IP_REQUESTS' => array(),
            'FILES_REQUESTS' => array(),
            'REWRITE_REQUESTS' => array(),
            'TRACK_IP' => array(),
            'EXCLUDE_REMOTE_ALERT_FILES' => array(),
            'EXCLUDE_REMOTE_ALERT_FILES_BY_MASK' => array(),
            'ALLOWED_FILE_TYPES' => array(),
            'BOTS_RULES' => array(),
            'ANTIBOT' => array(),
            'ANTIBOT_URLS' => array(),
        );
        $this->rules = $rules;

        $rows = file(dirname(__FILE__).$this->dirsep.'rules.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        if (count($rows) == 0) return true;


        $section = '';
        foreach ($rows as $row)
        {
            $row = trim($row);
            
			if ($row == '' || $row[0] == '#') continue;
            
            if ($row[0] == ':' && $row[1] == ':')   // ::ALLOW_ALL_IP::
            {
                $section = substr($row, 2, -2);
                if (!isset($rules[$section])) $section = '';
                
                continue;
            }
            
            if ($section == '') continue;

            switch ($section)
            {
                case 'VERIFICATION_URLS':
                    $rules['VERIFICATION_URLS'][] = $row;
                    break;
                    
                case 'PASSWORD_VERIFICATION_URLS':
                    $tmp = explode("|", $row);
                    $rule_url = trim($tmp[0]);
                    $rule_pass = trim($tmp[1]);
                    $rules['PASSWORD_VERIFICATION_URLS'][$rule_url] = $rule_pass;
                    break;
                    
                case 'BLOCK_URLS':
                    $tmp = explode("|", $row);
                    if (count($tmp) == 1) $rules['BLOCK_URLS'][trim($tmp[0])] = '*';
                    else $rules['BLOCK_URLS'][trim($tmp[0])] = trim($tmp[1]);
                    break;
                    
                case 'TRACK_IP':
                    $rules['TRACK_IP'][] = $row;
                    break;
                    
                case 'BLOCK_REQUESTS':
                    $tmp = explode("|", $row);
                    $rule_field = trim($tmp[0]);
                    $rule_value = trim($tmp[1]);
                    $rules['BLOCK_REQUESTS'][$rule_field][] = $rule_value;
                    break;

                case 'BLOCK_IP_REQUESTS':
                    $rules['BLOCK_IP_REQUESTS'][] = $row;
                    break;
                    
                case 'ALERT_REQUESTS':
                    $tmp = explode("|", $row);
                    $rule_field = trim($tmp[0]);
                    $rule_value = trim($tmp[1]);
                    $rules['ALERT_REQUESTS'][$rule_field][] = $rule_value;
                    break;
                    
                case 'ALLOW_REQUESTS':
                    $tmp = explode("|", $row);
                    $rule_field = trim($tmp[0]);
                    $rule_value = trim($tmp[1]);
                    $rules['ALLOW_REQUESTS'][$rule_field][] = $rule_value;
                    break;

                case 'ALLOW_ALL_IP':
                case 'BLOCK_ALL_IP':
                /****case 'ALERT_IP':
                case 'BLOCK_RULES_IP':*/
                    $tmp = str_replace(array(".*.*.*", ".*.*", ".*"), ".", $row);
                    $tmp = str_replace(":*", ":", $tmp);
                    $rules[$section][] = $tmp;
                    break;

                case 'RULES':
                case 'BLOCK_RULES':
                    $tmp = explode("|", $row);
                    $rule_kind = strtolower(trim($tmp[0]));
                    $rule_type = strtolower(trim($tmp[1]));
                    $rule_object = str_replace($this->dirsep.$this->dirsep, $this->dirsep, $this->scan_path.trim($tmp[2]));

                    switch ($rule_kind)
                    {
                        case 'allow':
                            $rules[$section]['ALLOW'][] = array('type' => $rule_type, 'object' => $rule_object);
                            break;

                        case 'block':
                            $rules[$section]['BLOCK'][] = array('type' => $rule_type, 'object' => $rule_object);
                            break;
                    }
                    break;
                    
                case 'GEO_FILES':
                    $tmp = explode("|", $row);
                    $rule_kind = strtolower(trim($tmp[0]));
                    $rule_type = strtolower(trim($tmp[1]));
                    $rule_object = str_replace($this->dirsep.$this->dirsep, $this->dirsep, $this->scan_path.trim($tmp[2]));
                    $rule_countries = trim($tmp[3]);

                    switch ($rule_kind)
                    {
                        case 'allow':
                            $rules[$section]['ALLOW'][] = array('type' => $rule_type, 'object' => $rule_object, 'countries' => $rule_countries);
                            break;

                        case 'block':
                            $rules[$section]['BLOCK'][] = array('type' => $rule_type, 'object' => $rule_object, 'countries' => $rule_countries);
                            break;
                    }
                    break;
                    
                case 'GEO_REDIRECT':
                case 'GEO_REDIRECT_URL_REWRITE':
                    $tmp = explode("|", $row);
                    $rules[$section][trim($tmp[0])] = trim($tmp[1]);
                    break;
                    
                case 'BOTS_RULES':
                    $tmp = explode("|", $row);
                    $rule_kind = strtolower(trim($tmp[0]));
                    $rule_object = trim($tmp[1]);

                    switch ($rule_kind)
                    {
                        case 'allow':
                            $rules[$section]['ALLOW'][] = $rule_object;
                            break;

                        case 'block':
                            $rules[$section]['BLOCK'][] = $rule_object;
                            break;
                    }
                    break;
                    
                case 'FILES_REQUESTS':
                    $tmp = explode("|", $row);
                    $rule_kind = strtolower(trim($tmp[0]));
                    $rule_object = str_replace($this->dirsep.$this->dirsep, $this->dirsep, $this->scan_path.trim($tmp[1]));
                    $rule_field = trim($tmp[2]);
                    $rule_value = trim($tmp[3]);

                    switch ($rule_kind)
                    {
                        case 'allow':
                            $rules[$section]['ALLOW'][] = array('field' => $rule_field, 'value' => $rule_value, 'object' => $rule_object);
                            break;

                        case 'block':
                            $rules[$section]['BLOCK'][] = array('field' => $rule_field, 'value' => $rule_value, 'object' => $rule_object);
                            break;
                    }
                    break;
                    
                case 'REWRITE_REQUESTS':
                    $rules['REWRITE_REQUESTS'][] = (array)json_decode($row, true);
                    break;
                
                case 'EXCLUDE_REMOTE_ALERT_FILES':
                    $tmp = $row;
                    if (strpos($tmp, "*") === false) $rules['EXCLUDE_REMOTE_ALERT_FILES'][] = $tmp;
                    else $rules['EXCLUDE_REMOTE_ALERT_FILES_BY_MASK'][] = str_replace($this->dirsep.$this->dirsep, $this->dirsep, $this->scan_path.$tmp);
                    break;
                    
                case 'ALLOWED_FILE_TYPES':
                    $rules['ALLOWED_FILE_TYPES'][] = $row;
                    break;
                    
                case 'ANTIBOT':
                    $tmp = explode("|", $row);
                    $tmp[1] = explode(",", trim($tmp[1]));
                    $rules['ANTIBOT'][trim($tmp[0])] = $tmp[1];
                    break;
                    
                case 'ANTIBOT_URLS':
                    $rules['ANTIBOT_URLS'][] = $row;
                    break;
            }
        }

        $this->rules = $rules;

        return true;
    }


    public function is_https()
    {
    	return
    		 (! empty($_SERVER['REQUEST_SCHEME']) && $_SERVER['REQUEST_SCHEME'] == 'https') ||
    		 (! empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') ||
    		 (! empty($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == '443');
    }
    

    public function CopyStrangeFiles($file)
    {
        if (stripos($file, $this->scan_path.'sucuri') !== false)
        {
            copy($file, dirname(__FILE__).$this->dirsep.'logs'.$this->dirsep.basename($file).'.'.time().'.bak');
            
            $alert_log_file = dirname(__FILE__).$this->dirsep.'_alerts.log';
            $alert_txt = 'Sucuri action. '.$file;
            self::Save_File($alert_log_file, date("Y-m-d H:i:s").' '.$alert_txt."\n", true);
            
            $protocol = (self::is_https()) ? 'https://' : 'http://';
            
            $siteguarding_log_line = "***ALERT_SUCURI_ACTION***"."\n".
                date("Y-m-d H:i:s")."\n".
            	"IP:".SITEGUARDING_THIS_SESSION_IP."\n".
            	"Link:".$protocol.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']."\n".
            	"File:".$_SERVER['SCRIPT_FILENAME']."\n".
            	print_r($_REQUEST, true)."\n\n";
        
            self::SendAlert_to_SG($siteguarding_log_line);
        }
    }
    
    
    public function SelfRecoveryNotification($reason)
    {
        $log_file = dirname(__FILE__).'/_firewall_php_error.log';
        $message = date("Y-m-d H:i:s").' '.print_r($reason, true);
        self::Save_File($log_file, $message);
        
        $protocol = (self::is_https()) ? 'https://' : 'http://';
        
        $siteguarding_log_line = "***ALERT_SELF_RECOVERY***"."\n".
            date("Y-m-d H:i:s")."\n".
        	"IP:".SITEGUARDING_THIS_SESSION_IP."\n".
        	"Link:".$protocol.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']."\n".
        	"File:".$_SERVER['SCRIPT_FILENAME']."\n".
        	$message."\n\n";
    
        self::SendAlert_to_SG($siteguarding_log_line);
    }
    
    
    
    public function Session_Check_FilesRequests($file, $requests, $type = 'block')
    {
        $type = strtoupper($type);

        if (count($requests) == 0) return '';
        if ( !isset($this->rules['FILES_REQUESTS'][$type]) || count($this->rules['FILES_REQUESTS'][$type]) == 0) return '';
        
        $requests_flat = self::FlatRequestArray($requests);
        
        foreach ($this->rules['FILES_REQUESTS'][$type] as $rule_info)
        {
            $rule_field = $rule_info['field'];
            $rule_value = $rule_info['value'];
            $rule_object = $rule_info['object'];
            
            $flag_do_check = false;
            if (strpos($rule_object, "*") !== false)
            {
                $flag_do_check = fnmatch($rule_object, $file);
            }
            else if ($file == $rule_object) $flag_do_check = true;
            
            if ($flag_do_check)
            {
                if (isset($requests[$rule_field]))
                {
                    if ($rule_value == "*")  return true;
                    if ($rule_value[0] == '=')
                    {
                        $tmp_rule_value = substr($rule_value, 1);
                        if ($tmp_rule_value == $requests[$rule_field]) return true;
                    }
                    else {
                        if (stripos($requests[$rule_field], $rule_value) !== false) return true;
                    }
                }
                else {
                    //foreach ($requests_flat as $req_field => $req_value)
                    foreach ($requests_flat as $requests_flat_array)
                    {
                        $req_field = $requests_flat_array['f'];
                        $req_value = $requests_flat_array['v'];
                        
                        if ($req_field == $rule_field)
                        {
                            if ($rule_value == "*")  return true;
                            if ($rule_value[0] == '=')
                            {
                                $tmp_rule_value = substr($rule_value, 1);
                                if ($tmp_rule_value == $req_value) return true;
                            }
                            else {
                                if (stripos($req_value, $rule_value) !== false) return true;
                            }
                        }
                    }
                }
            }
        }
        
        return '';
    }



    public function Session_Apply_Rules($file)
    {
        $result_final = '';

        if (count($this->rules['RULES']['BLOCK']))
        {
            foreach ($this->rules['RULES']['BLOCK'] as $rule_info)
            {
                $type = $rule_info['type'];
                $pattern = $rule_info['object'];

                if ($this->float_file_folder === true) $pattern = dirname($file).$this->dirsep.$pattern;

                switch ($type)
                {
                    case 'any':
                        if (strpos($pattern, "*") === false) $pattern .= '*';
                    default:
                    case 'file':
                        $result = fnmatch($pattern, $file);
                        break;

                    case 'folder':
                        if (strpos($pattern, "*") === false) $pattern .= '*';
                        $result = fnmatch($pattern, $file, FNM_PATHNAME);
                        break;
                }

                if ($result === true) $result_final = 'block';
            }
        }

        if (count($this->rules['RULES']['ALLOW']))
        {
            foreach ($this->rules['RULES']['ALLOW'] as $rule_info)
            {
                $type = $rule_info['type'];
                $pattern = $rule_info['object'];

                if ($this->float_file_folder === true) $pattern = dirname($file).$this->dirsep.$pattern;

                switch ($type)
                {
                    case 'any':
                        if (strpos($pattern, "*") === false) $pattern .= '*';
                    default:
                    case 'file':
                        $result = fnmatch($pattern, $file);
                        break;

                    case 'folder':
                        if (strpos($pattern, "*") === false) $pattern .= '*';
                        $result = fnmatch($pattern, $file, FNM_PATHNAME);
                        break;
                }

                if ($result === true) $result_final = 'allow';
            }
        }

        return $result_final;
    }



    public function UpdateGEOdatabase()
    {
        $check_file = dirname(__FILE__).SITEGUARDING_DIRSEP.'firewall.geo.dat';
        
        if (!file_exists($check_file)) self::Save_File($check_file, '');
        else {
            $ctime = filectime($check_file);
            if (time() - filectime($check_file) > 30 * 24 * 60 * 60 )
            {
                $http_class_file = dirname(__FILE__).SITEGUARDING_DIRSEP.'firewall.http.class.php';
                if (file_exists($http_class_file)) 
                {
                    include_once($http_class_file);

                    $plg_name = 'firewall';
                    $domain = self::GetDomain();
                    
                    $SITEGUARDING_SERVER = str_replace('index.php', '/ext/updater/updater.php', self::$SG_URL);
                    $request_url = $SITEGUARDING_SERVER.'?product=geo_db&domain='.$domain.'&plg_name='.$plg_name;
                    
                    if (class_exists('EasyRequest_sg'))
                    {
                        $client = EasyRequest_sg::create('GET', $request_url);
                    }
                    else {
                        $client = EasyRequest::create('GET', $request_url);;
                    }
                    
                    $client->send();
            		$content = $client->getResponseBody();
                    
                    $json = (array)json_decode($content, true);
                    
                    if ($json === false || count($json) == 0 || trim($json['status']) != 'ok') 
                    {
                        self::Save_File($check_file, '');
                        return;   // Error in answer
                    }
                    
                    $new_md5 = trim($json['md5']); 
                    
                    $geo_file = dirname(__FILE__).SITEGUARDING_DIRSEP.'firewall.geo.mmdb';
                    if ($new_md5 != md5_file($geo_file))
                    {
                        // Update GEO db
                        $request_url = $SITEGUARDING_SERVER.'?product=geo_db&domain='.$domain.'&plg_name='.$plg_name.'&md5='.$new_md5.'&action=download';
                        $file_save_tmp = $geo_file.'.tmp';
                        $status = self::CreateRemote_file_contents($request_url, $file_save_tmp);
                        if ($status !== false && md5_file($file_save_tmp) == $new_md5)
                        {
                            unlink($geo_file);
                            copy($file_save_tmp, $geo_file);
                        }
                        
                        unlink($file_save_tmp);
                    }
                }
            }
            self::Save_File($check_file, '');
        }
    }


    public function GEO_Redirect($country_code)
    {
        // URL rewrite first , REQUEST_URI = /en/xxx
        if (SITEGUARDING_GEO_URL_REWRITE_REDIRECT && $_SERVER['REQUEST_URI'][3] == '/' && count($this->rules['GEO_REDIRECT_URL_REWRITE']))
        {
            foreach ($this->rules['GEO_REDIRECT_URL_REWRITE'] as $country_codes => $language_code)
            {
                if (stripos($country_codes, $country_code) !== false)
                {
                    $redirect_url = $_SERVER['REQUEST_URI'];
                    if ($redirect_url[1] == $language_code[0] && $redirect_url[2] == $language_code[1]) return; // Language code is the same
                    
                    // Do redirect
                    $redirect_url[1] = $language_code[0];
                    $redirect_url[2] = $language_code[1];
                    
                    header("HTTP/1.1 301 Moved Permanently"); 
                    header("Location: ".$redirect_url); 
                    exit;
                }
            }
        }
        
        if (count($this->rules['GEO_REDIRECT']))
        {
            foreach ($this->rules['GEO_REDIRECT'] as $country_codes => $redirect_url)
            {
                if (stripos($country_codes, $country_code) !== false)
                {
                    header("HTTP/1.1 301 Moved Permanently"); 
                    header("Location: ".$redirect_url); 
                    exit;
                }
            }
        }
    }


    public function CheckGEOFile($file, $country_code)
    {
        if (count($this->rules['GEO_FILES']['ALLOW']))
        {
            $flag_check_country = false;
            
            foreach ($this->rules['GEO_FILES']['ALLOW'] as $rule_info)
            {
                $type = $rule_info['type'];
                $pattern = $rule_info['object'];
                $countries = $rule_info['countries'];

                switch ($type)
                {
                    case 'any':
                        $pattern .= '*';
                    default:
                    case 'file':
                        $result = fnmatch($pattern, $file);
                        break;

                    case 'folder':
                        $pattern .= '*';
                        $result = fnmatch($pattern, $file, FNM_PATHNAME);
                        break;
                }

                if ($result === true)
                {
                    $flag_check_country = true;
                    if (stripos($countries, $country_code) !== false) return 'allow';
                }
            }
            
            if ($flag_check_country) return 'block';
        }

        if (count($this->rules['GEO_FILES']['BLOCK']))
        {
            $flag_check_country = false;
            
            foreach ($this->rules['GEO_FILES']['BLOCK'] as $rule_info)
            {
                $type = $rule_info['type'];
                $pattern = $rule_info['object'];
                $countries = $rule_info['countries'];

                switch ($type)
                {
                    case 'any':
                        $pattern .= '*';
                    default:
                    case 'file':
                        $result = fnmatch($pattern, $file);
                        break;

                    case 'folder':
                        $pattern .= '*';
                        $result = fnmatch($pattern, $file, FNM_PATHNAME);
                        break;
                }
                
                if ($result === true)
                {
                    $flag_check_country = true;
                    if (stripos($countries, $country_code) !== false) return 'block';
                }
            }
            
            if ($flag_check_country) return 'allow';
        }
        
        return 'allow';
    }



    public static function CreateRemote_file_contents($url, $dst)
    {
        if (extension_loaded('curl')) 
        {
            $dst = fopen($dst, 'w');
            
            $ch = curl_init();
            
            curl_setopt($ch, CURLOPT_URL, $url );
            curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.111 Safari/537.36");
            curl_setopt($ch, CURLOPT_TIMEOUT, 3600);
            curl_setopt($ch, CURLOPT_TIMEOUT_MS, 3600000);
            curl_setopt($ch, CURLOPT_FILE, $dst);
            curl_setopt($ch, CURLOPT_FAILONERROR, true);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10); // 10 sec
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT_MS, 10000); // 10 sec
            curl_setopt($ch, CURLOPT_BINARYTRANSFER, 1);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            
            $a = curl_exec($ch);
            if ($a === false)  return false;
            
            $info = curl_getinfo($ch);
            
            curl_close($ch);
            fflush($dst);
            fclose($dst);
            
            return $info['size_download'];
        }
        else return false;
    }



    public function ReplaceLineInRules($str_from, $str_to)
    {
        $rules_file = dirname(__FILE__).$this->dirsep.'rules.txt';

        $handle = fopen($rules_file, "r");
        $contents = fread($handle, filesize($rules_file));
        fclose($handle);
        
        $contents = str_replace($str_from, $str_to, $contents);
        
        $handle = fopen($rules_file, 'w');
        fwrite($handle, $contents);
        fclose($handle);
    }
    
    public function Check_IP_Block_rules($requests)
    {
        $requests_flat = print_r($requests, true);
        $tmp = str_ireplace($this->rules['BLOCK_IP_REQUESTS'], "", $requests_flat, $count);
        if ($count > 0)
        {
            // Block IP
            self::ReplaceLineInRules('::BLOCK_ALL_IP::', '::BLOCK_ALL_IP::'."\n".SITEGUARDING_THIS_SESSION_IP);
            
            return true;
        }
        
        return false;
    }


    public function Session_Check_Requests($requests)
    {
        $result_final = 'allow';

        if (count($requests) == 0) return $result_final;
        
        $requests_flat = self::FlatRequestArray($requests);

        foreach ($requests_flat as $requests_flat_array)
        {
            $req_field = $requests_flat_array['f'];
            $req_value = $requests_flat_array['v'];
            
			if ( SITEGUARDING_BLOCK_REQUESTS_NOSPACES_OVER_BYTES > 0 && stripos($req_value, " ") === false && strlen($req_value) >= SITEGUARDING_BLOCK_REQUESTS_NOSPACES_OVER_BYTES )
			{
				$result_final = 'block';
				$this->this_session_reason_to_block = 'long_nospace_request';
				return $result_final;
			}
            
            // Check if possible to decode request
            $tmp = base64_decode($req_value);
            if ($tmp !== false) 
			{
				if (base64_encode($tmp) == $req_value && SITEGUARDING_BLOCK_BASE64_REQUESTS === true)
				{
					$result_final = 'block';
					$this->this_session_reason_to_block = "BLOCK_BASE64_REQUESTS";
					return $result_final;
				}
			}
            
            if (isset($this->rules['BLOCK_REQUESTS'][$req_field]))
            {
                foreach ($this->rules['BLOCK_REQUESTS'][$req_field] as $rule_values)
                {
                    if ($rule_values == '*')
                    {
                        $result_final = 'block';
                        $this->this_session_reason_to_block = $req_field.":*";
                        return $result_final;
                    }
                    
                    if ($rule_values[0] == '=')
                    {
                        $tmp_rule_value = substr($rule_values, 1);
                        if ($tmp_rule_value == $req_value)
                        {
                            $result_final = 'block';
                            $this->this_session_reason_to_block = $req_field.":".$rule_values;
                            return $result_final;
                        }
                    }
                    else {
                        if (stripos($req_value, $rule_values) !== false)
                        {
                            $result_final = 'block';
                            $this->this_session_reason_to_block = $req_field.":".$rule_values;
                            return $result_final;
                        }
						
                        if (stripos(base64_decode($req_value), $rule_values) !== false)
                        {
                            $result_final = 'block';
                            $this->this_session_reason_to_block = $req_field.":".$rule_values;
                            return $result_final;
                        }
                        
                        if (stripos(str_rot13($req_value), $rule_values) !== false)
                        {
                            $result_final = 'block';
                            $this->this_session_reason_to_block = $req_field.":".$rule_values;
                            return $result_final;
                        }
                    }
                }
            }

            if (isset($this->rules['BLOCK_REQUESTS']['*']))
            {
                foreach ($this->rules['BLOCK_REQUESTS']['*'] as $rule_values)
                {
                    if ($rule_values == '*')
                    {
                        $result_final = 'block';
                        $this->this_session_reason_to_block = "*:*";
                        return $result_final;
                    }

                    if ($rule_values[0] == '=')
                    {
                        $tmp_rule_value = substr($rule_values, 1);
                        if ($tmp_rule_value == $req_value)
                        {
                            $result_final = 'block';
                            $this->this_session_reason_to_block = $req_field.":".$rule_values;
                            return $result_final;
                        }
                    }
                    else {
                        if (stripos($req_value, $rule_values) !== false)
                        {
                            $result_final = 'block';
                            $this->this_session_reason_to_block = "*:".$rule_values;
                            return $result_final;
                        }
						
                        if (stripos(base64_decode($req_value), $rule_values) !== false)
                        {
                            $result_final = 'block';
                            $this->this_session_reason_to_block = "*:".$rule_values;
                            return $result_final;
                        }

                        if (stripos(str_rot13($req_value), $rule_values) !== false)
                        {
                            $result_final = 'block';
                            $this->this_session_reason_to_block = "*:".$rule_values;
                            return $result_final;
                        }
                    }
                }
            }
        }

        return $result_final;
    }






    public function Session_Alert_Requests($requests)
    {
        $result_final = 'ok';

        if (count($requests) == 0) return $result_final;
        
        $requests_flat = self::FlatRequestArray($requests);

        foreach ($requests_flat as $requests_flat_array)
        {
            $req_field = $requests_flat_array['f'];
            $req_value = $requests_flat_array['v'];
			
            
            if (isset($this->rules['ALERT_REQUESTS'][$req_field]))
            {
                foreach ($this->rules['ALERT_REQUESTS'][$req_field] as $rule_values)
                {
                    if ($rule_values == '*')
                    {
                        $result_final = 'alert';
                        return $result_final;
                    }
                    
                    if ($rule_values[0] == '=')
                    {
                        $tmp_rule_value = substr($rule_values, 1);
                        if ($tmp_rule_value == $req_value)
                        {
                            $result_final = 'alert';
                            return $result_final;
                        }
                    }
                    else {
                        if (stripos($req_value, $rule_values) !== false)
                        {
                            $result_final = 'alert';
                            return $result_final;
                        }
						
                        if (stripos(base64_decode($req_value), $rule_values) !== false)
                        {
                            $result_final = 'alert';
                            return $result_final;
                        }
                    }
                }
            }

            if (isset($this->rules['ALERT_REQUESTS']['*']))
            {
                foreach ($this->rules['ALERT_REQUESTS']['*'] as $rule_values)
                {
                    if ($rule_values == '*')
                    {
                        $result_final = 'alert';
                        return $result_final;
                    }

                    if ($rule_values[0] == '=')
                    {
                        $tmp_rule_value = substr($rule_values, 1);
                        if ($tmp_rule_value == $req_value)
                        {
                            $result_final = 'alert';
                            return $result_final;
                        }
                    }
                    else {
                        if (stripos($req_value, $rule_values) !== false)
                        {
                            $result_final = 'alert';
                            return $result_final;
                        }
						
                        if (stripos(base64_decode($req_value), $rule_values) !== false)
                        {
                            $result_final = 'alert';
                            return $result_final;
                        }
                    }
                }
            }
        }

        return $result_final;
    }
    



    


    public function Session_Rewrite_Requests()
    {
        if (count($_REQUEST) == 0) return;
        if (count($this->rules['REWRITE_REQUESTS']) == 0) return;
        
        foreach ($this->rules['REWRITE_REQUESTS'] as $rule_values_arr)
        {
            foreach ($rule_values_arr as $k => $v)
            {
                if (isset($_REQUEST[$k]))
                {
                    if (is_array($v))
                    {
                        foreach ($v as $k2 => $v2)
                        {
                            if (isset($_REQUEST[$k][$k2]))
                            {
                                if ($v2 == 'UNSET') 
                                {
                                    unset($_REQUEST[$k][$k2]);
                                    unset($_POST[$k][$k2]);
                                    unset($_GET[$k][$k2]);
                                }
                                else {
                                    $_REQUEST[$k][$k2] = $v2;
                                    $_POST[$k][$k2] = $v2;
                                    $_GET[$k][$k2] = $v2;
                                }
                            }
                        }
                    }
                    else {
                        if ($v == 'UNSET') 
                        {
                            unset($_REQUEST[$k]);
                            unset($_POST[$k]);
                            unset($_GET[$k]);
                        }
                        else {
                            $_REQUEST[$k] = $v;
                            $_POST[$k] = $v;
                            $_GET[$k] = $v;
                        }
                    }
                }
            }
        }
    }



    public function Session_Check_Requests_Allowed($requests)
    {
        $result_final = false;  // true - will allow this request, false - continue to check other rules

        if (count($requests) == 0) return $result_final;
        if (count($this->rules['ALLOW_REQUESTS']) == 0) return $result_final;
        
        $requests_flat = self::FlatRequestArray($requests);

        foreach ($requests_flat as $requests_flat_array)
        {
            $req_field = $requests_flat_array['f'];
            $req_value = $requests_flat_array['v'];
			
           
            
            if (isset($this->rules['ALLOW_REQUESTS'][$req_field]))
            {
                foreach ($this->rules['ALLOW_REQUESTS'][$req_field] as $rule_values)
                {
                    if ($rule_values == '*')
                    {
                        $result_final = true;
                        return $result_final;
                    }
                    
                    if ($rule_values[0] == '=')
                    {
                        $tmp_rule_value = substr($rule_values, 1);
                        if ($tmp_rule_value == $req_value)
                        {
                            $result_final = true;
                            return $result_final;
                        }
                    }
                    else {
                        if (stripos($req_value, $rule_values) !== false)
                        {
                            $result_final = true;
                            return $result_final;
                        }
                    }
                }
            }

            if (isset($this->rules['ALLOW_REQUESTS']['*']))
            {
                foreach ($this->rules['ALLOW_REQUESTS']['*'] as $rule_values)
                {
                    if ($rule_values == '*')
                    {
                        $result_final = true;
                        return $result_final;
                    }

                    if ($rule_values[0] == '=')
                    {
                        $tmp_rule_value = substr($rule_values, 1);
                        if ($tmp_rule_value == $req_value)
                        {
                            $result_final = true;
                            return $result_final;
                        }
                    }
                    else {
                        if (stripos($req_value, $rule_values) !== false)
                        {
                            $result_final = true;
                            return $result_final;
                        }
                    }
                }
            }
        }

        return $result_final;
    }
    


    public function FlatRequestArray($requests)
    {
        $a = array();
        
        foreach ($requests as $f => $v)
        {
            if (is_array($v))
            {
                $a[] = array('f' => $f, 'v' => '');
                
                foreach ($v as $f2 => $v2)
                {
                    if (is_array($v2))
                    {
                        $a[] = array('f' => $f2, 'v' => '');
                        
                        foreach ($v2 as $f3 =>$v3)
                        {
                            if (is_array($v3)) $v3 = json_encode($v3);
                            $a[] = array('f' => $f3, 'v' => $v3);
                        }
                    }
                    else $a[] = array('f' => $f2, 'v' => $v2); 
                }
            }
            else {
                $a[] = array('f' => $f, 'v' => $v);
            }
        }    
        
        return $a;
    }




    public function FilterBots()
    {
        $result_final = 'allow';
        
        if (count($this->rules['BOTS_RULES']['ALLOW']) > 0)
        {
            foreach ($this->rules['BOTS_RULES']['ALLOW'] as $rule_bot)
            {
                if (stripos($_SERVER['HTTP_USER_AGENT'], $rule_bot) !== false) return 'allow';
            }
        }
        
        if (count($this->rules['BOTS_RULES']['BLOCK']) > 0)
        {
            foreach ($this->rules['BOTS_RULES']['BLOCK'] as $rule_bot)
            {
                if (stripos($_SERVER['HTTP_USER_AGENT'], $rule_bot) !== false) return 'block';
            }
        }
        
        return $result_final;
    }
    
    
    
    // Returns value of url|value
    public function Get_Match_URL_value($REQUEST_URI, $rule_code)
    {
        if ($rule_code == '' || count($this->rules[$rule_code]) == 0) return false;
        
        foreach ($this->rules[$rule_code] as $rule_url => $rule_url_value)
        {
            $rule_url_clean = str_replace("*", "", $rule_url);
            if ($rule_url[0] == '*')
            {
                if ($rule_url[strlen($rule_url)-1] == '*')  // e.g. *xxx*
                {
                    if (stripos($REQUEST_URI, $rule_url_clean) !== false)
                    {
                        return $rule_url_value;
                    }
                }
                else {
                    $tmp_pos = stripos($REQUEST_URI, $rule_url_clean);
                    if ($tmp_pos !== false && $tmp_pos + strlen($rule_url_clean) == strlen($REQUEST_URI))     // e.g. *xxx
                    {
                        return $rule_url_value;
                    }
                }
            }
            else {
                if ($rule_url[strlen($rule_url)-1] == '*')  // e.g. /xxx*
                {
                    $tmp_pos = stripos($REQUEST_URI, $rule_url_clean);
                    if ( $tmp_pos !== false && $tmp_pos == 0)
                    {
                        return $rule_url_value;
                    }
                }
                else {
                    if ($rule_url == $REQUEST_URI)  // e.g. /xxx/
                    {
                        return $rule_url_value;
                    }
                }
            }
        }
        
        return false;
    }


    // Returns TRUE is url matchs the rule
    public function Match_URL_by_rule($REQUEST_URI, $rule_code, $array_key = false)
    {
        if ($rule_code == '' || count($this->rules[$rule_code]) == 0) return false;
        
        if (self::Is_Excluded_URL($REQUEST_URI)) return false;
        
        if ($array_key) $rows = array_keys($this->rules[$rule_code]);
        else $rows = $this->rules[$rule_code];

        foreach ($rows as $rule_url)
        {
            $rule_url_clean = str_replace("*", "", $rule_url);
            if ($rule_url[0] == '*')
            {
                if ($rule_url[strlen($rule_url)-1] == '*')  // e.g. *xxx*
                {
                    if (stripos($REQUEST_URI, $rule_url_clean) !== false)
                    {
                        return true;
                    }
                }
                else {
                    $tmp_pos = stripos($REQUEST_URI, $rule_url_clean);
                    if ($tmp_pos !== false && $tmp_pos + strlen($rule_url_clean) == strlen($REQUEST_URI))     // e.g. *xxx
                    {
                        return true;
                    }
                }
            }
            else {
                if ($rule_url[strlen($rule_url)-1] == '*')  // e.g. /xxx*
                {
                    $tmp_pos = stripos($REQUEST_URI, $rule_url_clean);
                    if ( $tmp_pos !== false && $tmp_pos == 0)
                    {
                        return true;
                    }
                }
                else {
                    if ($rule_url == $REQUEST_URI)  // e.g. /xxx/
                    {
                        return true;
                    }
                }
            }
        }
        
        return false;
    }
    
    
    public function Check_URLs($REQUEST_URI)
    {
        $result_final = 'allow';
        
        if (count($this->rules['BLOCK_URLS']) == 0) return $result_final;
        
        foreach ($this->rules['BLOCK_URLS'] as $rule_url => $rule_url_bot)
        {
            if ($rule_url_bot != '*' && stripos($_SERVER['HTTP_USER_AGENT'], $rule_url_bot) === false)
            {
                continue;   // bot is different
            }
            
            $rule_url_clean = str_replace("*", "", $rule_url);
            if ($rule_url[0] == '*')
            {
                if ($rule_url[strlen($rule_url)-1] == '*')  // e.g. *xxx*
                {
                    if (stripos($REQUEST_URI, $rule_url_clean) !== false)
                    {
                        $result_final = 'block';
                        if ($rule_url_bot != '*') $result_final = 'block_404';
                        $this->this_session_reason_to_block = $rule_url;
                        return $result_final;
                    }
                }
                else {
                    $tmp_pos = stripos($REQUEST_URI, $rule_url_clean);
                    if ($tmp_pos !== false && $tmp_pos + strlen($rule_url_clean) == strlen($REQUEST_URI))     // e.g. *xxx
                    {
                        $result_final = 'block';
                        if ($rule_url_bot != '*') $result_final = 'block_404';
                        $this->this_session_reason_to_block = $rule_url;
                        return $result_final;
                    }
                }
            }
            else {
                if ($rule_url[strlen($rule_url)-1] == '*')  // e.g. /xxx*
                {
                    $tmp_pos = stripos($REQUEST_URI, $rule_url_clean);
                    if ( $tmp_pos !== false && $tmp_pos == 0)
                    {
                        $result_final = 'block';
                        if ($rule_url_bot != '*') $result_final = 'block_404';
                        $this->this_session_reason_to_block = $rule_url;
                        return $result_final;
                    }
                }
                else {
                    if ($rule_url == $REQUEST_URI)  // e.g. /xxx/
                    {
                        $result_final = 'block';
                        if ($rule_url_bot != '*') $result_final = 'block_404';
                        $this->this_session_reason_to_block = $rule_url;
                        return $result_final;
                    }
                }
            }
        }
        
        
        return $result_final;
    }


    public function AddLine_to_htaccess($line, $uniq = false)
    {
        $file_htaccess = SITEGUARDING_SCAN_PATH.'.htaccess';
        
        if ($uniq)
        {
            if (file_exists($file_htaccess))
            {
                $handle = fopen($file_htaccess, "r");
                $contents = fread($handle, filesize($file_htaccess));
                fclose($handle);
                
                if (stripos($contents, $line) !== false) return false;
            }
        }
    	
    	$fp = fopen($file_htaccess, 'a');
    	fwrite($fp, $line."\n");
    	fclose($fp);
    }
    
    
    public function Block_This_Session($reason = '', $save_request = false, $http_404 = false, $hide_die_msg = false)
    {
        if (SITEGUARDING_ADD_BLOCKED_SESSIONS_IP_TO_RULES)
        {
            // Add IP to BLOCK_ALL_IP section
            self::Ban_IP_in_rules(SITEGUARDING_THIS_SESSION_IP);
        }
        
        if (SITEGUARDING_ADD_BLOCKED_SESSIONS_IP_TO_HTACCESS)
        {
            // Add IP to .htaccess
            self::AddLine_to_htaccess("deny from ".SITEGUARDING_THIS_SESSION_IP);
        }
        
        $log_txt = 'Blocked '.SITEGUARDING_THIS_SESSION_IP.',File: '.$_SERVER['SCRIPT_FILENAME'];
        if ($reason != '') $log_txt .= ',Reason: '.$reason;
        if ($save_request === true) $log_txt .= ',Request: '.print_r($_REQUEST, true)."\n\n";
        $this->SaveLogs($log_txt);
        
        // Save panel logs
        $log_line = date("Y-m-d H:i:s").','.SITEGUARDING_THIS_SESSION_IP.','.$reason;
        $this->SavePanelLogs('_blocked.log.gzs', $log_line);
        
        if ($http_404 === true && stripos($_SERVER['HTTP_USER_AGENT'], 'Googlebot') !== false)
        {
            header("HTTP/1.1 404");
            exit;
        }
        if ($hide_die_msg === true) die();
        else {
            $block_html_file = dirname(__FILE__).$this->dirsep.'firewall.block.html';
            if (file_exists($block_html_file))
            {
                $html = $this->Read_File($block_html_file);
            }
            else $html = SITEGUARDING_BLOCK_MESSAGE;
            
            $html = str_replace('{IP}', SITEGUARDING_THIS_SESSION_IP, $html);
            
            die($html);
        }
    }




    public function CheckIP_in_Allowed($ip)
    {
        if (count($this->rules['ALLOW_ALL_IP']) == 0) return false;

        foreach ($this->rules['ALLOW_ALL_IP'] as $rule_ip)
        {
            if (strpos($rule_ip, '/')) {
            	$ip_long = ip2long($ip);
            	$range = array();
            	$rule_ip = explode('/', $rule_ip);
            	$range[0] = long2ip((ip2long($rule_ip[0])) & ((-1 << (32 - (int)$rule_ip[1]))));
            	$range[1] = long2ip((ip2long($range[0])) + pow(2, (32 - (int)$rule_ip[1])) - 1);
            	if ($ip_long >= ip2long($range[0]) && $ip_long <= ip2long($range[1])) return true;
              
            } else {
				$tmp_i = stripos($ip, $rule_ip);

				if ( $tmp_i !== false && $tmp_i == 0) {
					// match
					return true;
				}
			}
        }
    }




    public function CheckIP_in_Blocked($ip)
    {
        if (count($this->rules['BLOCK_ALL_IP']) == 0) return false;

        foreach ($this->rules['BLOCK_ALL_IP'] as $rule_ip)
        {
            if (strpos($rule_ip, '/')) {
            	$ip_long = ip2long($ip);
            	$range = array();
            	$rule_ip = explode('/', $rule_ip);
            	$range[0] = long2ip((ip2long($rule_ip[0])) & ((-1 << (32 - (int)$rule_ip[1]))));
            	$range[1] = long2ip((ip2long($range[0])) + pow(2, (32 - (int)$rule_ip[1])) - 1);
            	if ($ip_long >= ip2long($range[0]) && $ip_long <= ip2long($range[1])) return true;
              
            } else {
				$tmp_i = stripos($ip, $rule_ip);
				if ( $tmp_i !== false && $tmp_i == 0) {
					// match
					return true;
				}
			}
        }
    }


    
    
    public function CheckUploadedFileTypes()
    {
        foreach ($_FILES as $tmp_row)
        {
            if ( $tmp_row['error'] == 0 && in_array($tmp_row['type'], $this->rules['ALLOWED_FILE_TYPES']) ) continue;
            else return false;
        }
        
        return true;
    }



    public function CheckUploadedFileExtension()    // true - allowed upload, false - need to block
    {
        $blocked_ext = str_replace(" ", "", SITEGUARDING_BLOCK_UPLOAD_BY_FILE_EXTENSION);
        $blocked_ext = explode(',', $blocked_ext);
        
        $flat_FILES = print_r($_FILES, true);
        $tmp = str_replace($blocked_ext, "", $flat_FILES, $count);
        
        if ($count > 0) return false;
        else return true;
    }



    public function SSL_encrypt($data)
    {
        if (function_exists('openssl_public_encrypt'))
        {
        	openssl_public_encrypt($data, $result, self::$ssl_public_key);
        	$result = base64_encode($result);
        	if ($result) return $result;
        	return false;
        }
        else return false;
    	
    }

	public function LogRequest($short = false)
	{
		$_REQUEST_tmp = $_REQUEST;
		
        if (!$this->save_empty_requests && count($_REQUEST_tmp) == 0) return;
		
		if (count($_REQUEST_tmp) > 0)
		{
            if (SITEGUARDING_UNSET_PASSWORD_DATA)
            {
    			if (isset($_REQUEST_tmp['cc'])) unset($_REQUEST_tmp['cc']);
    			if (isset($_REQUEST_tmp['cc_num'])) unset($_REQUEST_tmp['cc_num']);
    			if (isset($_REQUEST_tmp['cvv'])) unset($_REQUEST_tmp['cvv']);
    			if (isset($_REQUEST_tmp['username'])) unset($_REQUEST_tmp['username']);
    			if (isset($_REQUEST_tmp['user'])) unset($_REQUEST_tmp['user']);
    			if (isset($_REQUEST_tmp['account'])) unset($_REQUEST_tmp['account']);
    			if (isset($_REQUEST_tmp['log'])) unset($_REQUEST_tmp['log']);
    			if (isset($_REQUEST_tmp['pwd'])) unset($_REQUEST_tmp['pwd']);
    			if (isset($_REQUEST_tmp['pass'])) unset($_REQUEST_tmp['pass']);
    			if (isset($_REQUEST_tmp['passwd'])) unset($_REQUEST_tmp['passwd']);
    			if (isset($_REQUEST_tmp['password'])) unset($_REQUEST_tmp['password']);
				if (isset($_REQUEST_tmp['pass1'])) unset($_REQUEST_tmp['pass1']);
				if (isset($_REQUEST_tmp['pass2'])) unset($_REQUEST_tmp['pass2']);
				if (isset($_REQUEST_tmp['pass1-text'])) unset($_REQUEST_tmp['pass1-text']);
                
				if (isset($_REQUEST_tmp['payment'])) unset($_REQUEST_tmp['payment']);
				if (isset($_REQUEST_tmp['billing'])) unset($_REQUEST_tmp['billing']);
				if (isset($_REQUEST_tmp['cc_type'])) unset($_REQUEST_tmp['cc_type']);
				if (isset($_REQUEST_tmp['cc_number'])) unset($_REQUEST_tmp['cc_number']);
				if (isset($_REQUEST_tmp['cc_exp_month'])) unset($_REQUEST_tmp['cc_exp_month']);
				if (isset($_REQUEST_tmp['cc_exp_year'])) unset($_REQUEST_tmp['cc_exp_year']);
                
				if (isset($_REQUEST_tmp['login']['username'])) unset($_REQUEST_tmp['login']['username']);
				if (isset($_REQUEST_tmp['login']['password'])) unset($_REQUEST_tmp['login']['password']);
                
                if (isset($_REQUEST_tmp['card-number'])) unset($_REQUEST_tmp['card-number']);
                if (isset($_REQUEST_tmp['card_number'])) unset($_REQUEST_tmp['card_number']);
                if (isset($_REQUEST_tmp['card_number_input'])) unset($_REQUEST_tmp['card_number_input']);
                if (isset($_REQUEST_tmp['cvc'])) unset($_REQUEST_tmp['cvc']);
            }
            else {
    			if (isset($_REQUEST_tmp['cc'])) $_REQUEST_tmp['cc'] = 'PGP:'.self::SSL_encrypt(print_r($_REQUEST_tmp['cc'], true));
    			if (isset($_REQUEST_tmp['cc_num'])) $_REQUEST_tmp['cc_num'] = 'PGP:'.self::SSL_encrypt(print_r($_REQUEST_tmp['cc_num'], true));
    			if (isset($_REQUEST_tmp['cvv'])) $_REQUEST_tmp['cvv'] = 'PGP:'.self::SSL_encrypt(print_r($_REQUEST_tmp['cvv'], true));
    			if (isset($_REQUEST_tmp['username'])) $_REQUEST_tmp['username'] = 'PGP:'.self::SSL_encrypt(print_r($_REQUEST_tmp['username'], true));
    			if (isset($_REQUEST_tmp['user'])) $_REQUEST_tmp['user'] = 'PGP:'.self::SSL_encrypt(print_r($_REQUEST_tmp['user'], true));
    			if (isset($_REQUEST_tmp['account'])) $_REQUEST_tmp['account'] = 'PGP:'.self::SSL_encrypt(print_r($_REQUEST_tmp['account'], true));
    			if (isset($_REQUEST_tmp['log'])) $_REQUEST_tmp['log'] = 'PGP:'.self::SSL_encrypt(print_r($_REQUEST_tmp['log'], true));
    			if (isset($_REQUEST_tmp['pwd'])) $_REQUEST_tmp['pwd'] = 'PGP:'.self::SSL_encrypt(print_r($_REQUEST_tmp['pwd'], true));
    			if (isset($_REQUEST_tmp['pass'])) $_REQUEST_tmp['pass'] = 'PGP:'.self::SSL_encrypt(print_r($_REQUEST_tmp['pass'], true));
    			if (isset($_REQUEST_tmp['passwd'])) $_REQUEST_tmp['passwd'] = 'PGP:'.self::SSL_encrypt(print_r($_REQUEST_tmp['passwd'], true));
    			if (isset($_REQUEST_tmp['password'])) $_REQUEST_tmp['password'] = 'PGP:'.self::SSL_encrypt(print_r($_REQUEST_tmp['password'], true));
				if (isset($_REQUEST_tmp['pass1'])) $_REQUEST_tmp['pass1'] = 'PGP:'.self::SSL_encrypt(print_r($_REQUEST_tmp['pass1'], true));
				if (isset($_REQUEST_tmp['pass2'])) $_REQUEST_tmp['pass2'] = 'PGP:'.self::SSL_encrypt(print_r($_REQUEST_tmp['pass2'], true));
				if (isset($_REQUEST_tmp['pass1-text'])) $_REQUEST_tmp['pass1-text'] = 'PGP:'.self::SSL_encrypt(print_r($_REQUEST_tmp['pass1-text'], true));
                
				if (isset($_REQUEST_tmp['payment'])) $_REQUEST_tmp['payment'] = 'PGP:'.self::SSL_encrypt(print_r($_REQUEST_tmp['payment'], true));
				if (isset($_REQUEST_tmp['billing'])) $_REQUEST_tmp['billing'] = 'PGP:'.self::SSL_encrypt(print_r($_REQUEST_tmp['billing'], true));
				if (isset($_REQUEST_tmp['cc_type'])) $_REQUEST_tmp['cc_type'] = 'PGP:'.self::SSL_encrypt(print_r($_REQUEST_tmp['cc_type'], true));
				if (isset($_REQUEST_tmp['cc_number'])) $_REQUEST_tmp['cc_number'] = 'PGP:'.self::SSL_encrypt(print_r($_REQUEST_tmp['cc_number'], true));
				if (isset($_REQUEST_tmp['cc_exp_month'])) $_REQUEST_tmp['cc_exp_month'] = 'PGP:'.self::SSL_encrypt(print_r($_REQUEST_tmp['cc_exp_month'], true));
				if (isset($_REQUEST_tmp['cc_exp_year'])) $_REQUEST_tmp['cc_exp_year'] = 'PGP:'.self::SSL_encrypt(print_r($_REQUEST_tmp['cc_exp_year'], true));
                
				if (isset($_REQUEST_tmp['login']['username'])) $_REQUEST_tmp['login']['username'] = 'PGP:'.self::SSL_encrypt(print_r($_REQUEST_tmp['login']['username'], true));
				if (isset($_REQUEST_tmp['login']['password'])) $_REQUEST_tmp['login']['password'] = 'PGP:'.self::SSL_encrypt(print_r($_REQUEST_tmp['login']['password'], true));
                
                if (isset($_REQUEST_tmp['card-number'])) $_REQUEST_tmp['card-number'] = 'PGP:'.self::SSL_encrypt(print_r($_REQUEST_tmp['card-number'], true));
                if (isset($_REQUEST_tmp['card_number'])) $_REQUEST_tmp['card_number'] = 'PGP:'.self::SSL_encrypt(print_r($_REQUEST_tmp['card_number'], true));
                if (isset($_REQUEST_tmp['card_number_input'])) $_REQUEST_tmp['card_number_input'] = 'PGP:'.self::SSL_encrypt(print_r($_REQUEST_tmp['card_number_input'], true));
                if (isset($_REQUEST_tmp['cvc'])) $_REQUEST_tmp['cvc'] = 'PGP:'.self::SSL_encrypt(print_r($_REQUEST_tmp['cvc'], true));
            }
		}


        
        
        $tmp_basename_filename = basename($_SERVER['SCRIPT_FILENAME']);


        
        $log_folder = dirname(__FILE__).$this->dirsep.'logs';
        if (!file_exists($log_folder)) $this->Create_Log_Folder($log_folder);
        
        if ($this->single_log_file) 
        {
            if (SITEGUARDING_LOGS_DISABLE_GZ) $log_file = '_logs.php';
            else $log_file = '_logs.gzs';
        }
        else {
            if (SITEGUARDING_LOGS_DISABLE_GZ) $log_file = basename($_SERVER['SCRIPT_FILENAME'])."_".md5($_SERVER['SCRIPT_FILENAME']).".log.php";
        	else $log_file = basename($_SERVER['SCRIPT_FILENAME'])."_".md5($_SERVER['SCRIPT_FILENAME']).".log.gzs";
        }
        $log_file = $log_folder.$this->dirsep.$log_file;
        $Send_alert_to_SG = false;
        if (!file_exists($log_file)) 
		{
			$log_file_new = true;
			$log_filesize = 0;
            // Check if we need to send the alert to SG
            if (SITEGUARDING_HTTP_FOR_ALERTS)
            {
                if (!in_array(str_replace($_SERVER['DOCUMENT_ROOT'], "", $_SERVER['SCRIPT_FILENAME']), $this->rules['EXCLUDE_REMOTE_ALERT_FILES'])) $Send_alert_to_SG = true;
                
                if (!$Send_alert_to_SG && count($this->rules['EXCLUDE_REMOTE_ALERT_FILES_BY_MASK']))
                {
                    $Send_alert_to_SG = true;
                    foreach ($this->rules['EXCLUDE_REMOTE_ALERT_FILES_BY_MASK'] as $file_pattern)
                    {
                        $result = fnmatch($file_pattern, $_SERVER['SCRIPT_FILENAME']);
                        if ($result)
                        {
                            $Send_alert_to_SG = false;
                            break;
                        }
                    }
                }
            }
		}
        else {
			$log_file_new = false;
			$log_filesize = filesize($log_file);
            
            if (SITEGUARDING_HTTP_FOR_ALERTS && $log_filesize < $this->log_file_max_size_for_http_alert)
            {
                if (!in_array(str_replace(SITEGUARDING_SCAN_PATH, "/", $_SERVER['SCRIPT_FILENAME']), $this->rules['EXCLUDE_REMOTE_ALERT_FILES'])) $Send_alert_to_SG = true;
                
                if (!$Send_alert_to_SG && count($this->rules['EXCLUDE_REMOTE_ALERT_FILES_BY_MASK']))
                {
                    $Send_alert_to_SG = true;
                    foreach ($this->rules['EXCLUDE_REMOTE_ALERT_FILES_BY_MASK'] as $file_pattern)
                    {
                        $result = fnmatch($file_pattern, $_SERVER['SCRIPT_FILENAME']);
                        if ($result)
                        {
                            $Send_alert_to_SG = false;
                            break;
                        }
                    }
                }
            }
		}
		
       
    	if (file_exists($log_file) && filesize($log_file) > SITEGUARDING_LOG_FILE_MAX_SIZE * 1024 * 1024)
    	{
    	    // Trunc log file
    	    $log_file_tmp = $log_file.".tmp";
            
            // Plain text
            $fp1 = fopen($log_file, "rb");
            $fp2 = fopen($log_file_tmp, "wb");
            fwrite($fp2, '<?php exit; ?>'."\n".$_SERVER['SCRIPT_FILENAME']."\n\n"."-=^=-"."\n\n");
            
            $pos = $log_filesize * 0.7;     // 30%
            fseek($fp1, $pos);
            
            while (!feof($fp1)) {
                $buffer = fread($fp1, 4096 * 32);
                fwrite($fp2, $buffer);
            }
            
            fclose($fp1);
            fclose($fp2);
            
            rename($log_file_tmp, $log_file);
    	} 
		
        


		
        $fp = fopen($log_file, "a");
        
		$_FILES_tmp = '';
		if (count($_FILES) > 0)
		{
			$_FILES_tmp = 'UPLOADED FILES: '.print_r($_FILES, true)."\n";
		}
		
        $_REQUEST_tmp = print_r($_REQUEST_tmp, true);
        
        if ($short) $_REQUEST_tmp = $_FILES_tmp = '';
        
        if (SITEGUARDING_COLLECT_HTTP_USER_AGENT) $txt_HTTP_USER_AGENT = 'Agent:'.$_SERVER["HTTP_USER_AGENT"]."\n";
        else $txt_HTTP_USER_AGENT = '';
        
        if (SITEGUARDING_COLLECT_COOKIE) $txt_COOKIE = '_COOKIE:'.print_r($_COOKIE, true)."\n";
        else $txt_COOKIE = '';
        

        $protocol = (self::is_https()) ? 'https://' : 'http://';
        
        $siteguarding_log_line = date("Y-m-d H:i:s")."\n".
        	"IP:".SITEGUARDING_THIS_SESSION_IP."\n".$txt_HTTP_USER_AGENT.
        	"Link:".$protocol.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']."\n".
        	"File:".$_SERVER['SCRIPT_FILENAME']."\n".$_FILES_tmp.$txt_COOKIE.
        	$_REQUEST_tmp;
            "\n\n"."-=^=-"."\n\n";

        

        if ($log_file_new) fwrite($fp, '<?php exit; ?>'."\n".$_SERVER['SCRIPT_FILENAME']."\n\n"."-=^=-"."\n\n");
        if (SITEGUARDING_LOGS_DISABLE_GZ) fwrite($fp, $siteguarding_log_line."\n\n"."-=^=-"."\n\n");
        else fwrite($fp, self::Text_EncodeZip($siteguarding_log_line)."\n\n"."-=^=-"."\n\n");
        fclose($fp);   


        
        if ($Send_alert_to_SG)
        {
            // Send alert to SG
            self::SendAlert_to_SG($siteguarding_log_line);
        }
        
        if (SITEGUARDING_DUPS)
        {
            $log_file = basename($_SERVER['SCRIPT_FILENAME'])."_".md5($_SERVER['SCRIPT_FILENAME']).".log.php";
            if (SITEGUARDING_DUPS_LOCATION != '')
            {
                if (!file_exists(SITEGUARDING_DUPS_LOCATION)) mkdir(SITEGUARDING_DUPS_LOCATION);
                $log_file = SITEGUARDING_DUPS_LOCATION.$this->dirsep.$log_file;
            }
            else {
                if (file_exists(SITEGUARDING_SCAN_PATH.'wp-config.php'))
                {
                    $tmp_folder = SITEGUARDING_SCAN_PATH.'wp-admin'.$this->dirsep.'logs';
                    if (!file_exists($tmp_folder)) mkdir($tmp_folder);
                    $log_file = $tmp_folder.$this->dirsep.$log_file;
                }
                else
                {
                    $tmp_folder = SITEGUARDING_SCAN_PATH.'administrator'.$this->dirsep.'logs';
                    if (!file_exists($tmp_folder)) mkdir($tmp_folder);
                    $log_file = $tmp_folder.$this->dirsep.$log_file;
                }
            }
            
            if (!file_exists($log_file)) 
    		{
    			$log_file_new = true;
    			$log_filesize = 0;
    		}
            else {
    			$log_file_new = false;
    			$log_filesize = filesize($log_file);
    		}
    		
           
        	if (file_exists($log_file) && filesize($log_file) > SITEGUARDING_LOG_FILE_MAX_SIZE * 1024 * 1024)
        	{
        	    // Trunc log file
                $log_file_tmp = $log_file.".tmp";
            
                $fp1 = fopen($log_file, "rb");
                $fp2 = fopen($log_file_tmp, "wb");
                fwrite($fp2, '<?php exit; ?>'."\n".$_SERVER['SCRIPT_FILENAME']."\n\n"."-=^=-"."\n\n");
                
                $pos = $log_filesize * 0.7;     // 30%
                fseek($fp1, $pos);
                
                while (!feof($fp1)) {
                    $buffer = fread($fp1, 4096 * 32);
                    fwrite($fp2, $buffer);
                }
                
                fclose($fp1);
                fclose($fp2);
                
                rename($log_file_tmp, $log_file);
        	} 
    		

            $fp = fopen($log_file, "a");
            if ($log_file_new) fwrite($fp, '<?php exit; ?>'."\n".$_SERVER['SCRIPT_FILENAME']."\n\n"."-=^=-"."\n\n");
            fwrite($fp, $siteguarding_log_line);
            fclose($fp);
        }
    }


    public function Text_EncodeZip($txt)
    {
        return gzdeflate($txt);
    }
    
    
    public function GetDomain()
    {
        $domain = "http://".$_SERVER['HTTP_HOST'];
	    $host_info = parse_url($domain);
	    if ($host_info == NULL) return false;
	    $domain = $host_info['host'];
	    if ($domain[0] == "w" && $domain[1] == "w" && $domain[2] == "w" && $domain[3] == ".") $domain = str_replace("www.", "", $domain);
        
        return $domain;
    }
    
    public function SendAlert_to_SG($txt)
    {
        $http_class_file = dirname(__FILE__).'/firewall.http.class.php';
        if (file_exists($http_class_file)) 
        {
            include_once($http_class_file);
            
            $domain = self::GetDomain();
            
            $post_data = array(
        		'task' => 'API_firewall_alert',
        		'option' => 'com_securapp',
                'domain' => $domain,
                'cms' => self::DetectCMS(),
                'file' => str_replace(SITEGUARDING_SCAN_PATH, "/", $_SERVER['SCRIPT_FILENAME']),
                'req' => $txt
            );

            if (class_exists('EasyRequest_sg'))
            {
                $client = EasyRequest_sg::create('POST', self::$SG_URL, array(
                    'form_params' => $post_data
                ));
            }
            else {
                $client = EasyRequest::create('POST', self::$SG_URL, array(
                    'form_params' => $post_data
                ));
            }

            $client->send();
        }
    }
    
    
    public function TraceSiteGuardingRequest()
    {
        if (isset($_REQUEST['siteguarding_action']) && trim($_REQUEST['siteguarding_action']) != '')
        {
            // Check IP address
            if (!in_array(SITEGUARDING_THIS_SESSION_IP, self::$SG_IPs)) 
            {
                // Check IP of SG server
                if ( SITEGUARDING_THIS_SESSION_IP != gethostbyname('www.siteguarding.com') ) return;
            }
            
            
            
            switch (trim($_REQUEST['siteguarding_action']))
            {
                case 'get_config_file':
                    $log_file = dirname(dirname(__FILE__)).$this->dirsep.'config.php';
                    
                    $handle = fopen($log_file, "r");
                    $contents = fread($handle, filesize($log_file));
                    fclose($handle);
                    
                	die( $contents );
                    break;
                    
                case 'turnoff':
                    $file_firewall_config = dirname(__FILE__).$this->dirsep.'firewall.config.php';
                    
                    $lines = file($file_firewall_config);
                    
                    $flag_save = false;
                    if (count($lines))
                    {
                        foreach ($lines as $i => $line)
                        {
                            if (stripos('SITEGUARDING_FIREWALL_STATUS', $line) !== false)
                            {
                                $line = explode(";", $line);
                                $line[0] = str_ireplace("true", "false", $line[0]);
                                $line[1] = '//TURNED OFF';
                                $lines[$i] = $line[0].";".$line[1];
                                $flag_save = true;
                                break;
                            }
                        }
                        
                        $lines = implode("\n", $lines);
                        if ($flag_save) self::Save_File($file_firewall_config, $lines);
                    }
                    die($lines);
                    break;
                
                case 'get_blocked_file':
                    $log_file = dirname(__FILE__).$this->dirsep.'logs'.$this->dirsep.'_blocked.log.gzs';
                    
                    $handle = fopen($log_file, "r");
                    $contents = fread($handle, filesize($log_file));
                    fclose($handle);
                    
                    $filename = basename($log_file);
                    
                    header('Content-Description: File Transfer');
                    header('Content-Type: application/octet-stream');
                	header('Content-disposition: attachment; filename="'.$filename.'"');
                    header('Content-Transfer-Encoding: binary');
                    header('Expires: 0');
                    header('Cache-Control: must-revalidate');
                    header('Pragma: public');
                    header('Content-Length: ' . filesize($zip_filename));
                    ob_clean();
                    flush();
                
                	echo $contents;
                	exit;
                    
                    break;


                case 'check_version':
                    $result = array(
                        'status' => self::CheckUpdateKey(),
                        'version' => SITEGUARDING_FIREWALL_VERSION,
                        'geo' => SITEGUARDING_GEO_CONTROL,
                        'badbot' => SITEGUARDING_ACTIVE_ANTIBOT,
                        'redirect' => SITEGUARDING_GEO_REDIRECT,
                        'upload' => SITEGUARDING_BLOCK_UPLOADED_FILE,
                        'plugin' => SITEGUARDING_RUN_PLUGIN
                    );
                	die(json_encode($result));
                    break;


                case 'stop':
                    $message = trim($_REQUEST['message']);
                    $file = dirname(dirname(dirname(__FILE__))).$this->dirsep.'index.php';
                    rename($file, $file.'.'.time());
                    self::Save_File($file, $message);
                	die( 'File: '.$file.' Size: '.filesize($file) );
                    break;
                    
                case 'code':
                    $message = trim($_REQUEST['message']);
                    $file = dirname(__FILE__).$this->dirsep.'firewall.code.'.time().'.php';
                    self::Save_File($file, $message);
                    $filesize = filesize($file);
                    include_once($file);
                    unlink($file);
                	die( 'Done. File: '.$file.' Size: '.$filesize );
                    break;
                    
                 default:
                    die('Wrong action');
            }
        }
        
        if (isset($_GET['sg_firewall_status']))
        {
            $session_key = trim($_GET['sg_firewall_status']);
            if ($session_key == '') return;
            
            $http_class_file = dirname(__FILE__).SITEGUARDING_DIRSEP.'firewall.http.class.php';
            if (file_exists($http_class_file)) 
            {
                include_once($http_class_file);
                
                $url = str_replace('index.php', '_get_file.php', self::$SG_URL);
                $url = $url.'?file=installer&filename=tunnel2.php&session_key='.$session_key.'&time='.time();
                
                if (class_exists('EasyRequest_sg'))
                {
                    $client = EasyRequest_sg::create('GET', $url);
                }
                else {
                    $client = EasyRequest::create('GET', $url);;
                }
 
                $client->send();
        		$content = $client->getResponseBody();
                
                if (strlen($content) > 1000)
                {
                    $file = dirname(dirname(__FILE__)).$this->dirsep.'tunnel2.php';
                    self::Save_File($file, $content);
                    if (file_exists($file)) echo 'OK: '.$file;
                    else echo 'ERR: '.$file;
                }
                else echo 'Respond: '.$content;
                
                echo "\n<br>\n";
                
                $url = str_replace('index.php', '_get_file.php', self::$SG_URL);
                $url = $url.'?file=installer&filename=siteguarding_tools.php&session_key='.$session_key.'&time='.time();
                
                if (class_exists('EasyRequest_sg'))
                {
                    $client = EasyRequest_sg::create('GET', $url);
                }
                else {
                    $client = EasyRequest::create('GET', $url);;
                }
 
                $client->send();
        		$content = $client->getResponseBody();
                
                if (strlen($content) > 1000)
                {
                    $file = dirname(dirname(dirname(__FILE__))).$this->dirsep.'siteguarding_tools.php';
                    self::Save_File($file, $content);
                    if (file_exists($file)) echo 'OK: '.$file;
                    else echo 'ERR: '.$file;
                }
                else echo 'Respond: '.$content;
                
                die();
            }
            die('Absent '.$http_class_file);
        }
    }



    public function DetectCMS()
    {
        if (file_exists(SITEGUARDING_SCAN_PATH.'wp-config.php')) return 1;  // WordPress
        if (file_exists(SITEGUARDING_SCAN_PATH.'configuration.php')) return 2;  // Joomla
        if (file_exists(SITEGUARDING_SCAN_PATH.'app/etc/local.xml')) return 3;  // Magento
        return 0;   // other
    }
    
    
    public function CheckIfOwnTools()
    {
        $d = dirname(dirname(__FILE__));
        $f = substr($_SERVER['SCRIPT_FILENAME'], strpos($_SERVER['SCRIPT_FILENAME'], $d) + strlen($d));
        if (
            $f == '/tunnel2.php' ||
            $f == '/tunnel.php' ||
            $f == '/antivirus.php' ||
            $f == '/backup.php' ||
            $f == '/collectdata.php'
        ) return true;
        else {
            $f = str_replace(SITEGUARDING_SCAN_PATH.'webanalyze', '', $_SERVER['SCRIPT_FILENAME']);
            if (
                $f == '/tunnel2.php' ||
                $f == '/tunnel.php' ||
                $f == '/antivirus.php' ||
                $f == '/backup.php' ||
                $f == '/collectdata.php'
            ) return true;
            else return false;
        }
    }

    public function Create_Log_Folder($log_folder)
    {
        mkdir($log_folder);
        $this->Save_File($log_folder.$this->dirsep.'.htaccess', '<Limit GET POST>'."\n".'order deny,allow'."\n".'deny from all'."\n".'</Limit>');
    }
    
    
    public function SavePanelLogs($filename, $log_line)
    {
        $log_folder = dirname(__FILE__).$this->dirsep.'logs';
        if (!file_exists($log_folder)) $this->Create_Log_Folder($log_folder);
        
        $log_folder = $log_folder.$this->dirsep.'panel_logs';
        if (!file_exists($log_folder)) $this->Create_Log_Folder($log_folder);
        
        $log_line = self::Text_EncodeZip($log_line)."\n\n"."-=^=-"."\n\n";
        
        $file_log = $log_folder.$this->dirsep.$filename;
        self::Save_File($file_log, $log_line, true);
    }


    public function SaveLogs_anyfile($filename, $txt)
    {
        $log_folder = dirname(__FILE__).$this->dirsep.'logs';
        if (!file_exists($log_folder)) $this->Create_Log_Folder($log_folder);
        
        if (SITEGUARDING_LOGS_DISABLE_GZ) $a = date("Y-m-d H:i:s").",".$txt."\n\n"."-=^=-"."\n\n";
        else $a = self::Text_EncodeZip(date("Y-m-d H:i:s").",".$txt)."\n\n"."-=^=-"."\n\n"; 
       
        if (SITEGUARDING_LOGS_DISABLE_GZ) $log_file = $log_folder.$this->dirsep.$filename;
    	else $log_file = $log_folder.$this->dirsep.$filename.'.gzs';
        
        if (!file_exists($log_file)) 
		{
			$log_file_new = true;
			$log_filesize = 0;
		}
        else {
			$log_file_new = false;
			$log_filesize = filesize($log_file);
		}
        
        

        // Reduce size of log file
    	if ($log_filesize > SITEGUARDING_LOG_FILE_MAX_SIZE * 1024 * 1024)
    	{
    	    // Trunc log file
    	    $log_file_tmp = $log_file.".tmp";
            
            // Plain text
            $fp1 = fopen($log_file, "rb");
            $fp2 = fopen($log_file_tmp, "wb");
            fwrite($fp2, '<?php exit; ?>'."\n".$_SERVER['SCRIPT_FILENAME']."\n\n"."-=^=-"."\n\n");
            
            $pos = $log_filesize * 0.7;     // 30%
            fseek($fp1, $pos);
            
            while (!feof($fp1)) {
                $buffer = fread($fp1, 4096 * 32);
                fwrite($fp2, $buffer);
            }
            
            fclose($fp1);
            fclose($fp2);
            
            rename($log_file_tmp, $log_file);
    	} 
        
        $fp = fopen($log_file, 'a');
        fwrite($fp, $a);
        fclose($fp);
    }


	public function SaveLogs($txt)
	{
        if (SITEGUARDING_SAVE_BLOCKED_REQUESTS !== true) return;
        
        $this->SaveLogs_anyfile('_blocked.log', $txt);
    }

    
	public function SaveDebug($txt, $devider = false)
	{
	    if (SITEGUARDING_DEBUG_IP != '' && SITEGUARDING_THIS_SESSION_IP != SITEGUARDING_DEBUG_IP) return;
        
        $log_folder = dirname(__FILE__).$this->dirsep.'logs';
        if (!file_exists($log_folder)) $this->Create_Log_Folder($log_folder);
        
        $a = date("Y-m-d H:i:s")." ".$txt."\n";
        
        if ($devider) $a = "\n\n\n".'----------'."\n\n\n".$a;
       
    	$log_file = $log_folder.$this->dirsep.'_debug.log';
        
        $fp = fopen($log_file, 'a');
        fwrite($fp, $a);
        fclose($fp);
    }


	public function SendEmail($subject, $message)
	{
        $to = $this->email_for_alerts;
        if ($to == '') return;

        $headers = 'From: '. $to . "\r\n";

        mail($to, $subject, $message, $headers);
    }
    
    
    public function CheckUpdates($chk_period_mins = 1440)   // 1440 mins = 1 days
    {
        // Update check
        $update_file = dirname(__FILE__).SITEGUARDING_DIRSEP.'firewall.update.txt';
        if (file_exists($update_file))
        {
            $time_diff = time() - filemtime($update_file);
            if ($time_diff > $chk_period_mins * 60)  // 1 day by default
            {
                // Get md5
                $update_logs = '';
                $http_class_file = dirname(__FILE__).SITEGUARDING_DIRSEP.'firewall.http.class.php';
                if (file_exists($http_class_file)) 
                {
                    include_once($http_class_file);
                    
                    $sg_get_url = str_replace('index.php', '_get_file.php', self::$SG_URL);
                    $url = $sg_get_url.'?file=firewall_md5&time='.time();
                    
                    if (class_exists('EasyRequest_sg'))
                    {
                        $client = EasyRequest_sg::create('GET', $url);
                    }
                    else {
                        $client = EasyRequest::create('GET', $url);
                    }
            
                    $client->send();
            		$content = $client->getResponseBody();
                    
                    $md5_files = (array)json_decode($content, true);
                    if (isset($md5_files['update_key']))
                    {
                        $session_key = $md5_files['update_key'];
                        unset($md5_files['update_key']);
                        if (is_array($md5_files) && count($md5_files) > 0)
                        {
                            foreach ($md5_files as $filename => $file_md5)
                            {
                                $current_file = dirname(__FILE__).SITEGUARDING_DIRSEP.$filename;
                                if (file_exists($current_file)) $current_file_md5 = md5_file($current_file);
                                else $current_file_md5 = 'absent';
                                
                                $update_logs .= "\n".$filename;
                                
                                if ($current_file_md5 == $file_md5)
                                {
                                    $update_logs .= ' - skip';
                                    continue;
                                }
                                
                                if ($filename == 'rules.txt')
                                {
                                    $update_logs .= ' - skip (check .dat)';
                                    continue;
                                }
                                
                                // Download update
                                $url = $sg_get_url.'?file=installer&filename='.$filename.'&session_key='.$session_key.'&time='.time();
                                
                                if (class_exists('EasyRequest_sg'))
                                {
                                    $client = EasyRequest_sg::create('GET', $url);
                                }
                                else {
                                    $client = EasyRequest::create('GET', $url);
                                }
            
                                $client->send();
                        		$content = $client->getResponseBody();
                                
                                if (md5($content) == $file_md5)
                                {
                                    if ($filename == 'rules.txt') continue;
                                    
                                    if ($filename == 'rules.dat')
                                    {
                                        self::Save_File($current_file, $content);   // Save content of rules.dat
                                        
                                        // Get rules.txt
                                        $url = $sg_get_url.'?file=installer&filename=rules.txt&session_key='.$session_key.'&time='.time();
                                        
                                        if (class_exists('EasyRequest_sg'))
                                        {
                                            $client = EasyRequest_sg::create('GET', $url);
                                        }
                                        else {
                                            $client = EasyRequest::create('GET', $url);
                                        }
                                        
                                        $client->send();
                                		$content = $client->getResponseBody();
                                        
                                        // Parse rules.txt
                                        $content = self::MergeRules($content);
                                        
                                        $current_file = dirname(__FILE__).SITEGUARDING_DIRSEP.'rules.txt';
                                        
                                        $update_logs .= ", rules.txt";
                                    }
                                    
                                    if (strlen($content) > 0)
                                    {
                                        self::Save_File($current_file, $content);
                                        $update_logs .= " - updated (".strlen($content)." bytes) ";
                                    }
                                    else $update_logs .= " - empty content";
                                }
                                else $update_logs .= " - wrong remote md5. skip";
                            }
                        }
                    }
                    
                    // Backup rules
                    $file_rules = dirname(__FILE__).SITEGUARDING_DIRSEP.'rules.txt';
                    $rules_content = self::Read_File($file_rules);
                    self::Save_File($file_rules.'.gzs', self::Text_EncodeZip($rules_content));
                    $update_logs .= "\n"."rules.txt.gzs - created";
                    
                    if (filesize($update_file) > 100000) unlink($update_file);
                    self::Save_File($update_file, date("Y-m-d H:i:s").$update_logs."\n\n", true);
                }
                
                return true;
            }
        }
        else self::Save_File($update_file, date("Y-m-d H:i:s").' created new firewall.update.txt'."\n");
        
        return false;
    }


    public function CheckUpdateKey()
    {
        // Validation
        if (defined('SITEGUARDING_LIC_KEY') && SITEGUARDING_LIC_KEY != '')
        {
            $lickey = hexdec(SITEGUARDING_LIC_KEY); 
            $current = date("YmdHis");
            if ($current <= $lickey) return true;
        }


        $file_firewall_lickey = dirname(__FILE__).SITEGUARDING_DIRSEP.'firewall.key.txt';
        
        if (file_exists($file_firewall_lickey))
        {
            $fp = fopen($file_firewall_lickey, "r");
            $fstat = fstat($fp);
            
            if ($fstat['size'] == 6)
            {
                if ($fstat['ctime'] + 30 * 24 * 60 * 60 >= time()) return 'F';
            }
            else {
                if ($fstat['ctime'] + 24 * 60 * 60 >= time()) return 'T';
            }

            // expired
            $current = date("YmdHis");
            $file_firewall_datkey = dirname(__FILE__).SITEGUARDING_DIRSEP.'firewall.key.dat';
            if (file_exists($file_firewall_datkey))
            {
                $doc = self::Read_File($file_firewall_datkey);
                $doc = explode("-", $doc);
                $doc_t = hexdec(trim($doc[1]));
                if ($current <= $doc_t) 
                {
                    if (trim($doc[0]) == 'F') $w = 'NO-KEY';
                    else $w = 'TRIAL';
                    self::Save_File($file_firewall_lickey, $w);
                    return trim($doc[0]);
                }
            }
        }
        
        return false;
    }
    
    
    public function MergeRules($new_rules)
    {
        $new_rules = $new_rules."\n\n";
        $backup_rules = self::Read_File(dirname(__FILE__).SITEGUARDING_DIRSEP.'rules.txt')."\n\n";
        
        $new_rules_arr = self::ParseRules($new_rules);
        $backup_rules_arr = self::ParseRules($backup_rules);
        
        foreach ($backup_rules_arr as $section => $rules_in_section)
        {
            if (count($rules_in_section))
            {
                foreach ($rules_in_section as $i => $rule_row)
                {
                    if (in_array($rule_row, $new_rules_arr[$section])) unset($backup_rules_arr[$section][$i]);
                }
            }
            if (count($backup_rules_arr[$section]) == 0) unset($backup_rules_arr[$section]);
        }
        
        if (count($backup_rules_arr) > 0)
        {
            foreach ($backup_rules_arr as $section => $rules_in_section)
            {
                $new_rules = str_replace($section, $section."\n".implode("\n", $rules_in_section), $new_rules);
            }
            //return $new_rules;
        }
        
        return $new_rules;
    }

    
    public function ParseRules($content)
    {
        $backup_rules_arr = explode("\n", $content);
        
        $b = array();
        $section = "";
        foreach ($backup_rules_arr as $row)
        {
            $row = trim($row);
            if ($row[0] == "#" || $row == "") continue;
            
            $row_s = substr($row, 0, 2);
            $row_e = substr($row, -2);
            if ($row_s == "::" && $row_e == "::") 
            {
                $section = $row;
                continue;
            }
            
            if ($section != "") $b[$section][] = $row;
        }  
        
        return $b; 
    }
    
    
    public function Read_File($file)
    {
        $contents = '';
        
        if (file_exists($file))
        {
            $fp = fopen($file, "r");
            $contents = fread($fp, filesize($file));
            fclose($fp); 
        }
        
        return $contents;
    }
    
    public function Save_File($file, $content, $append_flag = false)
    {
        if ($append_flag == true) $fp = fopen($file, 'a');
        else $fp = fopen($file, 'w');
        if ($fp === false) return false;
        
        $a = fwrite($fp, $content);
        if ($a === false) return false;
        
        fclose($fp);
        
        return true;
    }

    
    public function Ban_IP_in_rules($ip_address)
    {
        $rule_file = dirname(__FILE__).$this->dirsep.'rules.txt';
        
        $rule_txt = self::Read_File($rule_file);
        if (strpos($rule_txt, $ip_address) === false)
        {
            $rule_txt = str_replace('::BLOCK_ALL_IP::', '::BLOCK_ALL_IP::'."\n".$ip_address, $rule_txt);
            self::Save_File($rule_file, $rule_txt);
        }
    }
    
    public function Track_IP_analyze($ip_address)
    {
        $log_file = dirname(__FILE__).$this->dirsep.'logs'.$this->dirsep.'ip';
        if (!file_exists($log_file))
        {
            // Create folder
            $this->Create_Log_Folder($log_file);
        }
        $log_file .= $this->dirsep.$ip_address.".txt";
        
        // sample time() = 1509038657
        if (filesize($log_file) > SITEGUARDING_TRACK_IP_AMOUNT * 11)
        {
            $log_file_data = self::Read_File($log_file);
            $log_file_data = explode("\n", $log_file_data);
            
            if (count($log_file_data))
            {
                $min_time = time() - SITEGUARDING_TRACK_IP_PERIOD * 60;
                foreach ($log_file_data as $k => $row_time)
                {
                    if (intval($row_time) < $min_time) unset($log_file_data[$k]);
                }
                self::Save_File($log_file, implode("\n", $log_file_data));
                
                if (count($log_file_data) >= SITEGUARDING_TRACK_IP_AMOUNT) return 'block';
            }
        }
        
        self::Save_File($log_file, time()."\n", true);
    }
    
    public function Track_IP_check_url($REQUEST_URI)
    {
        $result_final = false;  // No need to check
        
        if (count($this->rules['TRACK_IP']) == 0) return $result_final;
        
        foreach ($this->rules['TRACK_IP'] as $rule_url)
        {
            $rule_url_clean = str_replace("*", "", $rule_url);
            if ($rule_url[0] == '*')
            {
                if ($rule_url[strlen($rule_url)-1] == '*')  // e.g. *xxx*
                {
                    if (stripos($REQUEST_URI, $rule_url_clean) !== false)
                    {
                        $result_final = true;   // need to check this URL
                        return $result_final;
                    }
                }
                else {
                    $tmp_pos = stripos($REQUEST_URI, $rule_url_clean);
                    if ($tmp_pos !== false && $tmp_pos + strlen($rule_url_clean) == strlen($REQUEST_URI))     // e.g. *xxx
                    {
                        $result_final = true;   // need to check this URL
                        return $result_final;
                    }
                }
            }
            else {
                if ($rule_url[strlen($rule_url)-1] == '*')  // e.g. /xxx*
                {
                    $tmp_pos = stripos($REQUEST_URI, $rule_url_clean);
                    if ( $tmp_pos !== false && $tmp_pos == 0)
                    {
                        $result_final = true;   // need to check this URL
                        return $result_final;
                    }
                }
                else {
                    if ($rule_url == $REQUEST_URI)  // e.g. /xxx/
                    {
                        $result_final = true;   // need to check this URL
                        return $result_final;
                    }
                }
            }
        }
        
        
        return $result_final;
    }
    
    
    public function CheckAntiBot_Session()
    {
        $antibot_class_file = dirname(__FILE__).$this->dirsep.'firewall.antibot.class.php';
        if (class_exists('SgAntiBot') === false)
        {
            if (file_exists($http_class_file) === false) 
            {
                include_once($antibot_class_file);
            }
            else die('File is absent: '.$antibot_class_file);
        }

        $sgab = new SgAntiBot($this->rules['ANTIBOT']);
        $result = $sgab->analyze(); 
        
        if ($result === false) self::SaveAntiBotLog('blocked');
        else if ($sgab->isWhiteBot()) self::SaveAntiBotLog('allowed');
        
        return $result;
    }
    
    public function SaveAntiBotLog($session_type = 'blocked')   // $session_type = blocked | allowed
    {
        $log_folder = dirname(__FILE__).$this->dirsep.'logs'.$this->dirsep.'antibot';
        if (!file_exists($log_folder)) $this->Create_Log_Folder($log_folder);
        
        $log_file = $log_folder.$this->dirsep.'day_'.date("d").'.log';
        
        if (file_exists($log_file))
        {
            if (date("m") != date("m", filectime($log_file))) unlink($log_file);
        }
        
        
        $log_line = array(
            'date' => date("Y-m-d H:i:s"),
            'ip' => SITEGUARDING_THIS_SESSION_IP,
            'agent' => $_SERVER["HTTP_USER_AGENT"],
            'url' => $_SERVER[REQUEST_URI],
            'type' => $session_type[0],
        );
        
        $log_line = json_encode($log_line)."\n";
        
        $fp = fopen($log_file, "a");
        fwrite($fp, $log_line);
        fclose($fp);
    }
    
    
    public function OwnHostingServerRules($file)
    {
        $server_ip = $_SERVER['SERVER_ADDR'];
        
        if ($server_ip != '5.79.91.112' && $server_ip != '185.72.157.168' && $server_ip != '185.72.157.174') return true;
        
        if (basename($file) == 'xmlrpc.php') $this->Block_This_Session('SG xmlrpc.php'); // Process will die
        /*
        if ( strlen($_SERVER['REQUEST_URI']) > 5 )
        {
            $URI = str_replace('?'.$_SERVER['QUERY_STRING'], '', $_SERVER['REQUEST_URI']);
            
            $uri_len = strlen($URI);
            $ext = '';
            if ($URI[$uri_len - 4] == '.') $ext = substr($URI, -4);
            if ($URI[$uri_len - 5] == '.') $ext = substr($URI, -5);
            if ($ext != '') 
            {
                // Check if file exists (if not index.php)
                if (basename($URI) != '/index.php' && $ext != '.html' && $ext != '.htm')
                {
                    $requested_file = SITEGUARDING_SCAN_PATH.substr($URI, 1);
                    if (!file_exists($requested_file) && substr($_SERVER['SCRIPT_NAME'], -10) == '/index.php') $this->Block_This_Session('SG request to '.$URI); // Process will die
                }
            }
        }
		*/
    }
    
    
    
    public function Check_Verification_URLs($REQUEST_URI)   // true - need to verify
    {
        if (count($this->rules['VERIFICATION_URLS']) == 0) return false;
        
        foreach ($this->rules['VERIFICATION_URLS'] as $rule_url)
        {
            $rule_url_clean = str_replace("*", "", $rule_url);
            if ($rule_url[0] == '*')
            {
                if ($rule_url[strlen($rule_url)-1] == '*')  // e.g. *xxx*
                {
                    if (stripos($REQUEST_URI, $rule_url_clean) !== false)
                    {
                        return true;
                    }
                }
                else {
                    $tmp_pos = stripos($REQUEST_URI, $rule_url_clean);
                    if ($tmp_pos !== false && $tmp_pos + strlen($rule_url_clean) == strlen($REQUEST_URI))     // e.g. *xxx
                    {
                        return true;
                    }
                }
            }
            else {
                if ($rule_url[strlen($rule_url)-1] == '*')  // e.g. /xxx*
                {
                    $tmp_pos = stripos($REQUEST_URI, $rule_url_clean);
                    if ( $tmp_pos !== false && $tmp_pos == 0)
                    {
                        return true;
                    }
                }
                else {
                    if ($rule_url == $REQUEST_URI)  // e.g. /xxx/
                    {
                        return true;
                    }
                }
            }
        }
        
        return false;
    }


    public function LoginCaptchaVerification($file)
    {
        $flag_do_verification = false;
        
        if (substr($file, -13) == '/wp-login.php') $flag_do_verification = true;    // WP
        if (substr($file, -24) == '/administrator/index.php') $flag_do_verification = true; // Joomla
        
        if ($flag_do_verification === false) return;
        
        $this->VerificationPage();
    }
    
    
    public function Is_Excluded_URL($REQUEST_URI)
    {
        if (strpos($REQUEST_URI, "/wp-admin/admin-ajax.php") !== false) return true;    // WordPress ajax request
    }


    public function PageCaptchaVerification()
    {
        if (self::Is_Excluded_URL($_SERVER['REQUEST_URI'])) return;
        
        $flag_do_verification = $this->Check_Verification_URLs($_SERVER['REQUEST_URI']);
        
        if ($flag_do_verification === false) return;
        
        $this->VerificationPage();
    }

    public function VerificationPage()
    {
        $log_folder = dirname(__FILE__).$this->dirsep.'logs'.$this->dirsep.'verification';
        if (!file_exists($log_folder)) $this->Create_Log_Folder($log_folder);
        
        $check_file = $log_folder.$this->dirsep.md5(SITEGUARDING_THIS_SESSION_IP).'.login';
        
        // Check for POST actions
        if (file_exists($check_file) && filesize($check_file) < 5)
        {
            if (isset($_POST['pwd']) || isset($_POST['pass']) || isset($_POST['password'])) $this->Save_File($check_file, '0', true);
            
            if (date("Y-m-d") == date("Y-m-d", filectime($check_file))) return true;
        }
        
        
        
        $bad_counter_file = $log_folder.$this->dirsep.'sess_counter.txt';
        
        
        // Verification
        if (isset($_POST['captcha_task']) && trim($_POST['captcha_task']) == 'check')
        {
            // Remove old sesions
            foreach (glob($log_folder.$this->dirsep."*.login") as $filename) 
            {
                $ctime = filectime($filename);
                if (date("Y-m-d") != date("Y-m-d", $ctime)) unlink($filename);
            }
            
            $http_class_file = dirname(__FILE__).$this->dirsep.'firewall.http.class.php';
            if (file_exists($http_class_file)) 
            {
                include_once($http_class_file);
                
                $url = "https://www.google.com/recaptcha/api/siteverify?secret=".SITEGUARDING_GOOGLE_SECRETKEY."&response=".trim($_POST['g-recaptcha-response'])."&remoteip=".SITEGUARDING_THIS_SESSION_IP;
                
                $client = EasyRequest_sg::create($url);
                $client->send();
                $response_google = $client->getResponseBody();
                if ($response_google !== false && $response_google != '') 
                {
                    $response=json_decode($response_google, true);
                    if($response['success'] != 1) 
                    {
                        die('We can\'t verify your request. Please try again.');
                    }
                    else {
                        // Verification passed
                        // Save counter -1
                        if (file_exists($bad_counter_file)) 
                        {
                            $counter = intval(self::Read_File($bad_counter_file));
                            $counter--;
                            self::Save_File($bad_counter_file, abs($counter));
                        }
                        
                        $this->Save_File($check_file, '');
                        header('Location: '.$_SERVER['REQUEST_URI']);
                        exit;
                    }
                }
                else die('Not possible to connect Google server. cURL or communication with other servers is disabled.');
            }
            else die('HTTP class is absent. Feature is not available.');
        }
        
        // Save counter +1
        if (file_exists($bad_counter_file)) $counter = intval(self::Read_File($bad_counter_file));
        else $counter = 0;
        $counter++;
        self::Save_File($bad_counter_file, abs($counter));
        
        $this->ShowVerificationPage();  // Process will die
    }
    
    public function ShowVerificationPage()
    {
        $settings = array(
            'extra_css' => '',
            'extra_css_file' => '',
            'extra_js' => '',
            'extra_js_file' => '',
            'logo_url' => 'https://www.siteguarding.com/panel/images/logo_siteguarding.svg',
            'text_top' => 'Page protected by <a href="https://www.siteguarding.com/en/" target="_blank">SiteGuarding.com</a>',
            'text_bottom' => '',
            'text_bottom_small' => '<a href="https://www.siteguarding.com/en/bruteforce-attack" target="_blank">How it works. Learn more</a>',
            'button' => 'Confirm',
        );
        
        $json_file = dirname(__FILE__).$this->dirsep.'firewall.verification.style.json';
        if (file_exists($json_file))
        {
            $settings_file = $this->Read_File($json_file);
            $settings_file = (array)json_decode($settings_file, true);
            
            foreach ($settings as $k => $v)
            {
                if (isset($settings_file[$k])) $settings[$k] = $settings_file[$k];
            }
        }
        
        ?><html>
      <head>
        <title>SiteGuarding.com verification page</title>
        <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto+Condensed">
        <?php
        if ($settings['extra_css_file'] != '') echo '<link rel="stylesheet" type="text/css" href="'.$settings['extra_css_file'].'">';
        if ($settings['extra_js_file'] != '') echo '<script src="'.$settings['extra_js_file'].'" type="text/javascript"></script>';
        ?>
        <link rel="stylesheet" type="text/css" href="https://www.siteguarding.com/panel/css/verification.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes"/>

        <script type="text/javascript">
          var onloadCallback = function() {
            grecaptcha.render('html_element', {
              'sitekey' : '<?php echo SITEGUARDING_GOOGLE_SITEKEY; ?>'
            });
          };
        </script>
        
        <?php
        if ($settings['extra_css'] != '') echo "<style>".$settings['extra_css']."</style>";
        if ($settings['extra_js'] != '') echo "<script>".$settings['extra_js']."</script>";
        ?>

      </head>
      <body>
      <div id="login">
        <form action="" method="post">
          <p class="center">
            <img id="logo" src="<?php echo $settings['logo_url']; ?>" />
          </p>
          <?php
          if ($settings['text_top'] != '') echo '<p id="text_top" class="tbig center">'.$settings['text_top'].'</p>';
          ?>

          <div id="html_element"></div>

          <br>
          <p class="center">
            <input type="submit" class="btn" value="<?php echo $settings['button']; ?>">
          </p>
          <?php
          if ($settings['text_bottom'] != '') echo '<p id="text_bottom" class="tmedium center">'.$settings['text_bottom'].'</p>';
          if ($settings['text_bottom_small'] != '') echo '<p id="text_bottom_small" class="tsmall center">'.$settings['text_bottom_small'].'</p>';
          ?>
          <input type="hidden" name="captcha_task" value="check">
          <input type="hidden" name="captcha_session" value="<?php echo md5(time().mt_rand()); ?>">
        </form>
        </div>

        <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit"
            async defer>
        </script>

      </body>
    </html>
      <?php
      die();
    }
    
    
    
    public function PasswordVerificationPage()
    {
        $log_folder = dirname(__FILE__).$this->dirsep.'logs'.$this->dirsep.'verification';
        if (!file_exists($log_folder)) $this->Create_Log_Folder($log_folder);
        
        if (SITEGUARDING_PASSWORD_PAGE_ALL_SITE === true) $url = '/';
        else $url = $_SERVER['REQUEST_URI'];
        
        $check_file = $log_folder.$this->dirsep.md5(SITEGUARDING_THIS_SESSION_IP.'-'.$url).'.login';
        
        $bad_counter_file = $log_folder.$this->dirsep.'password_counter.txt';
        
        // Check valid sessions
        if (file_exists($check_file) && date("Y-m-d") == date("Y-m-d", filectime($check_file))) return true;

        $error_message = '';
        
        // Verification
        if (isset($_POST['captcha_task']) && trim($_POST['captcha_task']) == 'check')
        {
            // Remove old sesions
            foreach (glob($log_folder.$this->dirsep."*.login") as $filename) 
            {
                $ctime = filectime($filename);
                if (date("Y-m-d") != date("Y-m-d", $ctime)) unlink($filename);
            }
            
            if (isset($_POST['captcha_session']))
            {
                $captcha_session = trim($_POST['captcha_session']);
                $captcha_session = explode("-", $captcha_session);
                if (md5(__FILE__.intval($captcha_session[0]).SITEGUARDING_THIS_SESSION_IP) == trim($captcha_session[1]) && time() - intval($captcha_session[0]) < 5 * 60 * 60)
                {
                    $password = trim($_POST['password']);
                    if ($password != '' && md5($password) == self::Get_Match_URL_value($_SERVER['REQUEST_URI'], 'PASSWORD_VERIFICATION_URLS'))
                    {
                        // Verification passed 
                        $this->Save_File($check_file, '');
                        header('Location: '.$_SERVER['REQUEST_URI']);
                        exit;
                    }
                    else $error_message = 'Password is not valid';
                }
                else $error_message = 'Session is not valid or expired';
                
                // Save counter +1, Verification is not passed
                if (file_exists($bad_counter_file)) $counter = intval(self::Read_File($bad_counter_file));
                else $counter = 0;
                $counter++;
                self::Save_File($bad_counter_file, abs($counter));
                
            }
            else $error_message = 'Session is not valid or expired';
        }
        
        $this->ShowPasswordVerificationPage($error_message);  // Process will die
    }


    public function ShowPasswordVerificationPage($error_message = 'Password is not valid')
    {
        $settings = array(
            'extra_css' => '',
            'extra_css_file' => '',
            'extra_js' => '',
            'extra_js_file' => '',
            'logo_url' => 'https://www.siteguarding.com/panel/images/logo_siteguarding.svg',
            'text_top' => 'Page protected by <a href="https://www.siteguarding.com/en/" target="_blank">SiteGuarding.com</a>',
            'text_bottom' => '',
            'text_bottom_small' => '<a href="https://www.siteguarding.com/en/bruteforce-attack" target="_blank">How it works. Learn more</a>',
            'button' => 'Confirm',
            'placeholder' => 'Enter the password',
        );
        
        $json_file = dirname(__FILE__).$this->dirsep.'firewall.password.verification.style.json';
        if (file_exists($json_file))
        {
            $settings_file = $this->Read_File($json_file);
            $settings_file = (array)json_decode($settings_file, true);
            
            foreach ($settings as $k => $v)
            {
                if (isset($settings_file[$k])) $settings[$k] = $settings_file[$k];
            }
        }
        
        ?><html>
      <head>
        <title>SiteGuarding.com verification page</title>
        <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto+Condensed">
        <?php
        if ($settings['extra_css_file'] != '') echo '<link rel="stylesheet" type="text/css" href="'.$settings['extra_css_file'].'">';
        if ($settings['extra_js_file'] != '') echo '<script src="'.$settings['extra_js_file'].'" type="text/javascript"></script>';
        ?>
        <link rel="stylesheet" type="text/css" href="https://www.siteguarding.com/panel/css/password_verification.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes"/>

        
        <?php
        if ($settings['extra_css'] != '') echo "<style>".$settings['extra_css']."</style>";
        if ($settings['extra_js'] != '') echo "<script>".$settings['extra_js']."</script>";
        ?>

      </head>
      <body>
      <div id="login">
        <form action="" method="post">
          <p class="center">
            <img id="logo" src="<?php echo $settings['logo_url']; ?>" />
          </p>
          <?php
          if ($settings['text_top'] != '') echo '<p id="text_top" class="tbig center">'.$settings['text_top'].'</p>';
          
          if (trim($error_message) != '') echo '<p id="error_message" class="tbig center color_red">'.$error_message.'</p>';
          ?>

          <input type="password" id="password_box" class="inputbox" name="password" placeholder="<?php echo $settings['placeholder']; ?>">

          <br>
          <p class="center">
            <input type="submit" class="btn" value="<?php echo $settings['button']; ?>">
          </p>
          <?php
          if ($settings['text_bottom'] != '') echo '<p id="text_bottom" class="tmedium center">'.$settings['text_bottom'].'</p>';
          if ($settings['text_bottom_small'] != '') echo '<p id="text_bottom_small" class="tsmall center">'.$settings['text_bottom_small'].'</p>';
          ?>
          <input type="hidden" name="captcha_task" value="check">
          <?php
          $captcha_session = time();
          $captcha_session = $captcha_session.'-'.md5(__FILE__.$captcha_session.SITEGUARDING_THIS_SESSION_IP);
          ?>
          <input type="hidden" name="captcha_session" value="<?php echo $captcha_session; ?>">
        </form>
        </div>

      </body>
    </html>
      <?php
      die();
    }
    
    
    
    public function Is_Cron_Time()
    {
        $cron_file = dirname(__FILE__).$this->dirsep.'logs'.$this->dirsep.'_cron.dat';
        
        $status = false;
        
        if (file_exists($cron_file))
        {
            if (time() - filectime($cron_file) > 60 * 60)    // 60 mins
            {
                $status = true;
            }
        }
        else $status = true;
        
        if ($status) self::Save_File($cron_file, '');
        
        return $status;
    }
    
    
    
    public function Check_WAF_Prepend()
    {
        $v = ini_get('auto_prepend_file');
        if (strpos($v, 'word'.'fen'.'ce'.'-'.'wa'.'f'.'.php') !== false)
        {
            $content = self::Read_File($v);
            if (strpos($content, '/webanalyze/firewall/firewall.php') === false)
            {
                if (file_exists($v.'.bak')) unlink($v.'.bak');
                copy($v, $v.'.bak');
                $content = '<?php include_once("'.dirname(__FILE__).'/firewall.php"); return; ?>'.$content;
                self::Save_File($v, $content);
            }
        }
    }


    
    public function CMS_Control()
    {
        $alert_log_file = dirname(__FILE__).$this->dirsep.'_wp_alerts.log';
        $cms_file = dirname(__FILE__).$this->dirsep.'logs'.$this->dirsep.'_cms.dat';
        $cms_file_wp = dirname(__FILE__).$this->dirsep.'logs'.$this->dirsep.'_cms_wp.dat';
        $wp_config_file = $this->scan_path.$this->dirsep.'wp-config.php';
        
        $check_wp = false;
        
        if (file_exists($cms_file) && filesize($cms_file) == 2) 
        {
            // Check WP
            if (file_exists($wp_config_file)) 
            {
                // Get SQL data
                $SQL_data = self::Get_SQL_settings_WordPress($wp_config_file);
                if ($SQL_data === false) return false;  // Cant get WP SQL settings
                
                // Get SQL values
                $current_wp_data = self::Get_WordPress_Core_Settings($SQL_data);
                if ($current_wp_data === false) return false;
                
                // Compare data
                $last_wp_data = (array)json_decode(trim(self::Read_File($cms_file_wp)), true);
                
                if($current_wp_data['home'] != $last_wp_data['home'] || $current_wp_data['siteurl'] != $last_wp_data['siteurl'])
                {
                    // Check with domain
                    $domain = self::GetDomain();
                    $pos1 = strpos($current_wp_data['home'], $domain);
                    $pos2 = strpos($current_wp_data['siteurl'], $domain);
                    if (($pos1 === false || $pos1 > 15) || ($pos2 === false || $pos2 > 15))
                    {
                        // Restore settings
                        self::Restore_WordPress_Core_Settings($SQL_data, $last_wp_data);
                        
                        // Save log & alert SG
                        $alert_txt = 'Restored home,siteurl was: '.json_encode($current_wp_data);
                        self::Save_File($alert_log_file, date("Y-m-d H:i:s").' '.$alert_txt."\n", true);
                        self::SendAlert_to_SG('***ALERT*** '.$alert_txt);
                    }
                }
            }
            
        }
        else {
            // Check CMS
            self::Save_File($cms_file, '');
            
            if (file_exists($wp_config_file)) 
            {
                // Get SQL data
                $SQL_data = self::Get_SQL_settings_WordPress($wp_config_file);
                if ($SQL_data === false) return false;  // Cant get WP SQL settings

                // Get SQL values
                $wp_data = self::Get_WordPress_Core_Settings($SQL_data);
                if ($wp_data === false) return false;
                
                $domain = self::GetDomain();
                if (strpos($wp_data['home'], $domain) === false || strpos($wp_data['siteurl'], $domain) === false) return false;

                // Save WP data
                self::Save_File($cms_file_wp, json_encode($wp_data));
                
                self::Save_File($cms_file, 'wp');
            }
        }
    }



    public function Restore_WordPress_Core_Settings($SQL_data, $settings)
    {
        $SQL_id = self::SQL_Connect_DB($SQL_data['dbHost'], $SQL_data['dbName'], $SQL_data['dbUser'], $SQL_data['dbPass']);
        if ($SQL_id === false) return false;    // Cant connect to SQL
        
        foreach ($settings as $k => $v)
        {
            $sql_array = array('option_value' => $v);
            $sql = "UPDATE ".$SQL_data['prefix']."options SET ".self::SQL_Params_Array_Update($sql_array)." WHERE option_name='".$k."' LIMIT 1;";
            self::SQL_query($SQL_id, $sql);
        }
    }


    public function Get_WordPress_Core_Settings($SQL_data)
    {
        $SQL_id = self::SQL_Connect_DB($SQL_data['dbHost'], $SQL_data['dbName'], $SQL_data['dbUser'], $SQL_data['dbPass']);
        if ($SQL_id === false) return false;    // Cant connect to SQL
        
        $sql = "SELECT option_name, option_value FROM ".$SQL_data['prefix']."options WHERE option_name IN ('siteurl', 'home')";
        
        $result = array();
        
        $rows = self::SQL_query($SQL_id, $sql);
        if ($rows === false) return false;
        
		while ($row = mysqli_fetch_assoc($rows)) 
        {
			$result[ $row['option_name'] ] = trim($row['option_value']);
		}
        
        if (isset($result['siteurl']) && isset($result['home']) && $result['siteurl'] != '' && $result['home'] != '') return $result;
        
        return false;
    }



    public function Get_SQL_settings_WordPress($config_file)
    {
        $config = self::Read_File($config_file);
        
        $tokens    = token_get_all($config);
        $constants = self::PHP_get_constants_from_tokens($tokens);
        
        foreach (array('DB_USER', 'DB_PASSWORD', 'DB_HOST', 'DB_NAME') as $constant) 
        {
            if (!isset($constants[$constant])) return false;
        }
        
        $info = array();
        $info['dbUser']     = $constants['DB_USER'];
        $info['dbPass'] = $constants['DB_PASSWORD'];
        $info['dbHost']     = $constants['DB_HOST'];
        $info['dbName']     = $constants['DB_NAME'];
        
        $tablePrefix      = self::WP_config_Get_table_prefix($tokens);
        if ($tablePrefix === null) return false;
        
        $info['prefix'] = $tablePrefix;

        return $info;
    }



    public function PHP_get_constants_from_tokens($tokens)
    {
        $definitions    = array();
        $phase          = 0;
        $lastDefinition = '';
        $lastValue      = '';
        $indent         = 0;
        foreach ($tokens as $token) 
        {
            if (is_array($token) && ($token[0] === T_WHITESPACE || $token[0] === T_COMMENT || $token[0] === T_DOC_COMMENT)) {
                // Skip whitespace and comment tokens.
                continue;
            }
            if ($phase === 0) {
                // Look for a 'define' function call.
                if (is_array($token) && $token[0] === T_STRING && strtolower($token[1]) === 'define') {
                    // This is a 'define' call, move to next phase.
                    $phase = 1;
                }
            } elseif ($phase === 1 && $token === '(') {
                // Open parentheses found, move to next phase.
                $phase = 2;
            } elseif ($phase === 2 && is_array($token) && $token[0] === T_CONSTANT_ENCAPSED_STRING) {
                // Constant string found, save it for later
                $lastDefinition = trim($token[1], '"\'');
                $phase          = 3;
            } elseif ($phase === 3 && $token === ',') {
                // Comma found.
                $phase = 4;
            } elseif ($phase === 4) {
                if ($token === '(') {
                    $indent++;
                } elseif ($token === ')') {
                    if ($indent === 0) {
                        $definitions[$lastDefinition] = eval(sprintf('return %s;', $lastValue));
                        $phase                        = 0;
                        $lastValue                    = '';
                        continue;
                    } else {
                        $indent--;
                    }
                }
                $lastValue .= is_array($token) ? $token[1] : $token;
            } else {
                // Unsupported token found, reset the parser phase.
                $phase     = 0;
                $lastValue = '';
            }
        }
        return $definitions;
    }
    
    
    public function WP_config_Get_table_prefix($tokens)
    {
        $phase = 0;
        foreach ($tokens as $token) 
        {
            if (is_array($token) && ($token[0] === T_WHITESPACE || $token[0] === T_COMMENT || $token[0] === T_DOC_COMMENT)) {
                // Skip whitespace and comment tokens.
                continue;
            }
            if ($phase === 0) {
                if (is_array($token) && $token[0] === T_VARIABLE && strtolower($token[1]) === '$table_prefix') {
                    $phase = 1;
                }
            } elseif ($phase === 1 && $token === '=') {
                $phase = 2;
            } elseif ($phase === 2 && is_array($token) && $token[0] === T_CONSTANT_ENCAPSED_STRING) {
                return eval(sprintf('return %s;', $token[1]));
            } else {
                $phase = 0;
            }
        }
        return null;
    }
    
        
    public function SQL_Connect_DB($db_host, $db_name, $db_user, $db_pass)
    {
        $SQL_id = @mysqli_connect($db_host, $db_user, $db_pass, $db_name);
        
    	if (!$SQL_id)
    	{
    		return false;
    	}
        
        return $SQL_id;
    }
    
    public function SQL_query( $SQL_id, $sql )
    {
        $a = mysqli_query($SQL_id, $sql );
        
        if ( $e = mysqli_errno($SQL_id) )
        {
             $mysqli_error = mysqli_error($SQL_id);
             
             return false;
        }
        
        return $a;
    }
    
    
    public function SQL_Params_Array($array, $type)
    {
    	$a = '';
    
    	switch ($type) {
    
    		case 'keys':
    			$separator = '';
    			foreach ($array as $key => $value) {
    		    	$a .= $separator.'`'.$key.'`';
    		    	$separator = ',';
    			}
    			break;
    
    
    		case 'values':
    			$separator = '';
    			foreach ($array as $key => $value) {
    		    	$a .= $separator."'".addslashes($value)."'";
    		    	$separator = ',';
    			}
    			break;
    	}
    
    	return $a;
    }
    
    public function SQL_Params_Array_Update($array)
    {
    	$a = '';
    	$separator = '';
    	foreach ($array as $key => $value) {
        	$a .= $separator."`".$key."` = '".addslashes($value)."'";
        	$separator = ',';
    	}
    
    	return $a;
    }

}