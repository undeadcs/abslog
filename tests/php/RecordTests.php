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
		
		$this->assertEquals( $message, $actual->GetMessage( ) );
		$this->assertEquals( $level, $actual->GetLevel( ) );
		$this->assertEquals( new Record( $message, $level ), $actual );
	}
}
