
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

// extending
class ServiceRecord extends Record {
    /**
     * Category: message
     */
    const CATEGORY_MESSAGE = 0;
    
    /**
     * Category: command
     */
    const CATEGORY_COMMAND = 1;
    
    /**
     * Category: event
     */
    const CATEGORY_EVENT = 2;
    
    /**
     * IP of host
     */
    public string $host = '';
    
    /**
     * Process ID
     */
    public int $pid = 0;
    
    /**
     * Service name
     */
    public string $name = '';
    
    /**
     * Message internal category
     */
    public int $category = self::CATEGORY_MESSAGE;
    
    public function __construct( string $message, int $level = self::LVL_INFO, string $host = '', int $pid = 0, string $name = '', int $category = self::CATEGORY_MESSAGE ) {
        parent::__construct( $message, $level );
        
        $this->host     = $host;
        $this->pid      = $pid;
        $this->name     = $name;
        $this->category = $category;
    }
    
    /**
     * Magic method for casting to string
     */
    public function __toString( ) : string {
        return '['.self::LevelToString( $this->level ).']['.$this->host.']['.$this->pid.']['.$this->name.']['.$this->category.'] '.$this->message;
    }
}

$log = new FileLog( 'service.log' );
$log->Write( ServiceRecord::Info( 'simple information message', '127.0.0.1', 106458, 'my-magic-service', ServiceRecord::CATEGORY_EVENT ) );
```
