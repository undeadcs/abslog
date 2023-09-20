<?php
// extended example
// logging with additional values in log structure
require_once( __DIR__.'/../src/Record.php' );
require_once( __DIR__.'/../src/Log.php' );
require_once( __DIR__.'/../src/logs/TextualLog.php' );
require_once( __DIR__.'/../src/logs/FileLog.php' );
require_once( __DIR__.'/ServiceRecord.php' );
require_once( __DIR__.'/ServiceLog.php' );

$filename = 'service.log';
$log = new ServiceLog( $filename, 'my-service', trim( shell_exec( 'hostname' ) ) );
$n = mt_rand( 1, 12 );

for( $i = 0; $i < $n; ++$i ) {
	$log->Write( ServiceRecord::Info( 'message '.$i, ServiceRecord::CATEGORY_MESSAGE ) );
}

echo file_get_contents( $filename )."\n";
