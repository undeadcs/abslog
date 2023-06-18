
Project info:
* status: **active**
* code style: **current**
* architecture style: **current**
* year: **2023**
* version: alpha

# Abstract Logging

Collection of classes and functions for logging.

```PHP
...autoload

use abslog\Record;
use abslog\FileLog;

// simple file log
$log = new FileLog( 'myapp.log' );

$log->Write( Record::Debug( 'lets debug this app' ) );
$log->Write( Record::Info( 'simple information message' ) );
$log->Write( Record::Warning( 'warning is here, do something' ) );
$log->Write( Record::Error( 'error, exiting' ) );

// multiple files
use abslog\MultiLog;

$log = new MultiLog( new FileLog( 'out1.log' ), new FileLog( 'out2.log' ) );
$log->Write( Record::Info( 'simple information message' ) );
```
