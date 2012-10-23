<?php

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2012 Sascha Seyfert <sef@move-elevator.de>, move:elevator
 *  			
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 * Test case for class Tx_MeShortlink_Domain_Model_Shortlink.
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @package TYPO3
 * @subpackage m:e Shortlink Manager
 *
 * @author Sascha Seyfert <sef@move-elevator.de>
 */
class Tx_MeShortlink_Domain_Model_ShortlinkTest extends Tx_Extbase_Tests_Unit_BaseTestCase {
	/**
	 * @var Tx_MeShortlink_Domain_Model_Shortlink
	 */
	protected $fixture;

	public function setUp() {
		$this->fixture = new Tx_MeShortlink_Domain_Model_Shortlink();
	}

	public function tearDown() {
		unset($this->fixture);
	}

	/**
	 * @test
	 */
	public function getTitleReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setTitleForStringSetsTitle() { 
		$this->fixture->setTitle('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getTitle()
		);
	}
	
	/**
	 * @test
	 */
	public function getPageReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setPageForStringSetsPage() { 
		$this->fixture->setPage('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getPage()
		);
	}
	
	/**
	 * @test
	 */
	public function getUrlReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setUrlForStringSetsUrl() { 
		$this->fixture->setUrl('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getUrl()
		);
	}
	
	/**
	 * @test
	 */
	public function getParamsReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setParamsForStringSetsParams() { 
		$this->fixture->setParams('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getParams()
		);
	}
	
}
?>