<?php
// single file example
require_once( __DIR__.'/../src/Record.php' );
require_once( __DIR__.'/../src/Log.php' );
require_once( __DIR__.'/../src/logs/TextualLog.php' );
require_once( __DIR__.'/../src/logs/FileLog.php' );

use abslog\Record;
use abslog\logs\FileLog;

$filename = 'myapp.log';
$log = new FileLog( $filename );

$log->Write( Record::Debug( 'lets debug this app' ) );
$log->Write( Record::Info( 'simple information message' ) );
$log->Write( Record::Warning( 'warning is here, do something' ) );
$log->Write( Record::Error( 'error, exiting' ) );

echo file_get_contents( $filename )."\n";
