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
		$this->assertEquals( new Record( $message, $level, $actual->time ), $actual );
	}
	
	public static function toStringProvider( ) : array {
		$time = new \DateTime;
		$timeStr = $time->format( 'c' );
		
		return [
			[ 'error message',		Record::LVL_ERROR,		$time, '['.$timeStr.'][ERROR] error message'		],
			[ 'warning message',	Record::LVL_WARNING,	$time, '['.$timeStr.'][WARNING] warning message'	],
			[ 'info message',		Record::LVL_INFO,		$time, '['.$timeStr.'][INFO] info message'			],
			[ 'debug message',		Record::LVL_DEBUG,		$time, '['.$timeStr.'][DEBUG] debug message'		]
		];
	}
	
	/**
	 * Testing convert to string
	 */
	#[ DataProvider( 'toStringProvider' ) ]
	public function testToString( string $message, int $level, \DateTime $time, string $expected ) : void {
		$this->assertEquals( $expected, ( string ) new Record( $message, $level, $time ) );
	}
}
