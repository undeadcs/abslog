<?php
namespace abslog\tests;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\DataProvider;
use abslog\Record;

/**
 * Testing record class
 */
class RecordTests extends TestCase {
	public static function basicValuesProvider( ) : array {
		return [
			[ 'error message',		Record::LVL_ERROR,		'Error'		],
			[ 'warning message',	Record::LVL_WARNING,	'Warning'	],
			[ 'info message',		Record::LVL_INFO,		'Info'		],
			[ 'debug message',		Record::LVL_DEBUG,		'Debug'		]
		];
	}
	
	/**
	 * Testing basic fields
	 */
	#[ DataProvider( 'basicValuesProvider' ) ]
	public function testValues( string $message, int $level, string $fn ) : void {
		$actual = Record::$fn( $message );
		
		$this->assertEquals( $message, $actual->message );
		$this->assertEquals( $level, $actual->level );
		$this->assertEquals( new Record( $message, $level ), $actual );
	}
	
	public static function toStringProvider( ) : array {
		return [
			[ 'error message',		Record::LVL_ERROR,		'[ERROR] error message'		],
			[ 'warning message',	Record::LVL_WARNING,	'[WARNING] warning message'	],
			[ 'info message',		Record::LVL_INFO,		'[INFO] info message'		],
			[ 'debug message',		Record::LVL_DEBUG,		'[DEBUG] debug message'		]
		];
	}
	
	/**
	 * Testing convert to string
	 */
	#[ DataProvider( 'toStringProvider' ) ]
	public function testToString( string $message, int $level, string $expected ) : void {
		$this->assertEquals( $expected, ( string ) new Record( $message, $level ) );
	}
}
