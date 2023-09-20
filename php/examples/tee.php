<?php
// similar to tee, print to stdout and file
require_once( __DIR__.'/../src/Record.php' );
require_once( __DIR__.'/../src/Log.php' );
require_once( __DIR__.'/../src/logs/TextualLog.php' );
require_once( __DIR__.'/../src/logs/DescriptorLog.php' );
require_once( __DIR__.'/../src/logs/FileLog.php' );
require_once( __DIR__.'/../src/logs/StdoutLog.php' );
require_once( __DIR__.'/../src/logs/MultiLog.php' );

use abslog\Record;
use abslog\logs\FileLog;
use abslog\logs\StdoutLog;
use abslog\logs\MultiLog;

// simple file log
$filename = 'myapp.log';
$log = new FileLog( $filename );
$stdout = new StdoutLog;
$multilog = new MultiLog( $log, $stdout );

$multilog->Write( Record::Debug( 'lets debug this app' ) );
$multilog->Write( Record::Info( 'simple information message' ) );
$multilog->Write( Record::Warning( 'warning is here, do something' ) );
$multilog->Write( Record::Error( 'error, exiting' ) );

echo "\nfrom file:\n".file_get_contents( $filename )."\n";
