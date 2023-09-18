<?php
namespace abslog\tests;

use PHPUnit\Framework\TestCase;
use abslog\Record;
use PHPUnit\Framework\Attributes\DataProvider;

/**
 * Запись из сервиса
 */
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
		
		$this->host		= $host;
		$this->pid		= $pid;
		$this->name		= $name;
		$this->category	= $category;
	}
	
	/**
	 * Magic method for casting to string
	 */
	public function __toString( ) : string {
		return '['.self::LevelToString( $this->level ).']['.$this->host.']['.$this->pid.']['.$this->name.']['.$this->category.'] '.$this->message;
	}
}

/**
 * Проверка расширяемости
 */
class ExtendingTests extends TestCase {
	public static function basicValuesProvider( ) : array {
		return [
			[ 'error message',		ServiceRecord::LVL_ERROR,		'Error',	'127.0.0.1',	106458,	'service1',	ServiceRecord::CATEGORY_COMMAND,
				'[ERROR][127.0.0.1][106458][service1]['.ServiceRecord::CATEGORY_COMMAND.'] error message'
			],
			[ 'warning message',	ServiceRecord::LVL_WARNING,	'Warning',	'127.0.0.2',	106459,	'service2',	ServiceRecord::CATEGORY_EVENT,
				'[WARNING][127.0.0.2][106459][service2]['.ServiceRecord::CATEGORY_EVENT.'] warning message'
			],
			[ 'info message',		ServiceRecord::LVL_INFO,		'Info',		'127.0.0.3',	106460,	'service3',	ServiceRecord::CATEGORY_COMMAND,
				'[INFO][127.0.0.3][106460][service3]['.ServiceRecord::CATEGORY_COMMAND.'] info message'
			],
			[ 'debug message',		ServiceRecord::LVL_DEBUG,		'Debug',	'127.0.0.4',	106461,	'service4',	ServiceRecord::CATEGORY_MESSAGE,
				'[DEBUG][127.0.0.4][106461][service4]['.ServiceRecord::CATEGORY_MESSAGE.'] debug message'
			]
		];
	}
	
	/**
	 * Testing basic fields
	 */
	#[ DataProvider( 'basicValuesProvider' ) ]
	public function testValues( string $message, int $level, string $fn, string $host, int $pid, string $name, int $category, string $expected ) : void {
		$actual = ServiceRecord::$fn( $message, $host, $pid, $name, $category );
		
		$this->assertEquals( $message, $actual->message );
		$this->assertEquals( $level, $actual->level );
		$this->assertEquals( $host, $actual->host );
		$this->assertEquals( $pid, $actual->pid );
		$this->assertEquals( $name, $actual->name );
		$this->assertEquals( $category, $actual->category );
		$this->assertEquals( new ServiceRecord( $message, $level, $host, $pid, $name, $category ), $actual );
		$this->assertEquals( $expected, ( string ) $actual );
	}
}
