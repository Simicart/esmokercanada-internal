<?php
/**
 * Created by PhpStorm.
 * User: duongdiep
 * Date: 9/7/2560
 * Time: 12:44 น.
 */
	$s =  $_SERVER;
	$use_forwarded_host = false;
    $ssl      = ( ! empty( $s['HTTPS'] ) && $s['HTTPS'] == 'on' );
    $sp       = strtolower( $s['SERVER_PROTOCOL'] );
    $protocol = substr( $sp, 0, strpos( $sp, '/' ) ) . ( ( $ssl ) ? 's' : '' );
    $port     = $s['SERVER_PORT'];
    $port     = ( ( ! $ssl && $port=='80' ) || ( $ssl && $port=='443' ) ) ? '' : ':'.$port;
    $host     = ( $use_forwarded_host && isset( $s['HTTP_X_FORWARDED_HOST'] ) ) ? $s['HTTP_X_FORWARDED_HOST'] : ( isset( $s['HTTP_HOST'] ) ? $s['HTTP_HOST'] : null );
    $host     = isset( $host ) ? $host : $s['SERVER_NAME'] . $port;
    $baseUrl = $protocol . '://' . $host;
	$absolute_url = $baseUrl. $s['REQUEST_URI'];
	$sampleUrl = str_replace('web/magmi.php', 'plugins/magestore/general/inventoryintegrate/sample_import.csv',$absolute_url);
?>
<div class="plugin_description">This plugin will update stock level for Magestore Inventory Management extension.
    <a href="<?php echo $sampleUrl ?>">Download sample csv file</a>
</div>