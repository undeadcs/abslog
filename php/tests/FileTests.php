<?php
namespace abslog\tests;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\DataProvider;
use abslog\Record;
use abslog\logs\FileLog;
use abslog\logs\DescriptorLog;
use abslog\logs\MultiLog;

/**
 * Testing file logs
 */
class FileTests extends TestCase {
	/**
	 * @var string filename of tmp file
	 */
	protected string $tmpFile;
	
	/**
	 * @var resource descriptor of tmp file
	 */
	protected $tmpFd;
	
	protected function SetUp( ) : void {
		$this->tmpFilename = tempnam( __DIR__, 'abslogtest_' );
		$this->tmpFd = fopen( $this->tmpFilename, 'wb' );
	}
	
	protected function tearDown( ) : void {
		fclose( $this->tmpFd );
		unlink( $this->tmpFilename );
		$this->tmpFilename = null;
	}
	
	public static function fileMessagesProvider( ) : array {
		$time = new \DateTime;
		$timeStr = $time->format( 'c' );
		
		return [
			[ 'error message',		Record::LVL_ERROR,		'Error',	$time, "[$timeStr][ERROR] error message\n"		],
			[ 'warning message',	Record::LVL_WARNING,	'Warning',	$time, "[$timeStr][WARNING] warning message\n"	],
			[ 'info message',		Record::LVL_INFO,		'Info',		$time, "[$timeStr][INFO] info message\n"		],
			[ 'debug message',		Record::LVL_DEBUG,		'Debug',	$time, "[$timeStr][DEBUG] debug message\n"		]
		];
	}
	
	/**
	 * Test file by name
	 */
	#[ DataProvider( 'fileMessagesProvider' ) ]
	public function testFile( string $message, int $level, string $fn, \DateTime $time, string $expected ) : void {
		$log = new FileLog( $this->tmpFilename );
		$record = Record::$fn( $message );
		$record->time = $time; // just for equals
		$log->Write( $record );
		
		$actual = file_get_contents( $this->tmpFilename );
		$this->assertEquals( $expected, $actual );
	}
	
	/**
	 * Test file by descriptor
	 */
	#[ DataProvider( 'fileMessagesProvider' ) ]
	public function testDescriptor( string $message, int $level, string $fn, \DateTime $time, string $expected ) : void {
		$log = new DescriptorLog( $this->tmpFd );
		$record = Record::$fn( $message );
		$record->time = $time; // just for equals
		$log->Write( $record );
		
		$actual = file_get_contents( $this->tmpFilename );
		$this->assertEquals( $expected, $actual );
	}
	
	/**
	 * Test multiple output logs
	 */
	protected function testMultilog( ) : void {
		$filename1 = tempnam( __DIR__, 'abslogtest1_' );
		$filename2 = tempnam( __DIR__, 'abslogtest2_' );
		$time = new \DateTime;
		$timeStr = $time->format( 'c' );
		
		$log = new MultiLog( new FileLog( $filename1 ), new FileLog( $filename2 ) );
		$record = Record::Info( 'info message' );
		$record->time = $time; // just for equals
		$log->Write( $record );
		
		$actual1 = file_get_contents( $filename1 );
		$actual2 = file_get_contents( $filename2 );
		unlink( $filename1 );
		unlink( $filename2 );
		
		$expected = "[$timeStr][INFO] info message\n";
		$this->assertEquals( $expected, $actual1 );
		$this->assertEquals( $expected, $actual2 );
	}
}
