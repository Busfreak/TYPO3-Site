<?php
namespace FluidTYPO3\Vhs\ViewHelpers\Iterator;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2014 Claus Due <claus@namelesscoder.net>
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
 * ************************************************************* */
use FluidTYPO3\Vhs\ViewHelpers\AbstractViewHelperTest;

/**
 * @protection on
 * @author Claus Due <claus@namelesscoder.net>
 * @package Vhs
 */
class LastViewHelperTest extends AbstractViewHelperTest {

	/**
	 * @test
	 */
	public function returnsLastElement() {
		$array = array('a', 'b', 'c');
		$arguments = array(
			'haystack' => $array
		);
		$output = $this->executeViewHelper($arguments);
		$this->assertEquals('c', $output);
	}

	/**
	 * @test
	 */
	public function supportsIterators() {
		$array = new \ArrayIterator(array('a', 'b', 'c'));
		$arguments = array(
			'haystack' => $array
		);
		$output = $this->executeViewHelper($arguments);
		$this->assertEquals('c', $output);
	}

	/**
	 * @test
	 */
	public function supportsTagContent() {
		$array = array('a', 'b', 'c');
		$arguments = array(
			'haystack' => NULL
		);
		$output = $this->executeViewHelperUsingTagContent('Array', $array, $arguments);
		$this->assertEquals('c', $output);
	}

	/**
	 * @test
	 */
	public function returnsNullIfHaystackIsNull() {
		$arguments = array(
			'haystack' => NULL
		);
		$output = $this->executeViewHelper($arguments);
		$this->assertEquals(NULL, $output);
	}

	/**
	 * @test
	 */
	public function returnsNullIfHaystackIsEmptyArray() {
		$arguments = array(
			'haystack' => array()
		);
		$output = $this->executeViewHelper($arguments);
		$this->assertEquals(NULL, $output);
	}

	/**
	 * @test
	 */
	public function throwsExceptionOnUnsupportedHaystacks() {
		$arguments = array(
			'haystack' => new \DateTime('now')
		);
		$output = $this->executeViewHelper($arguments);
		$this->assertStringStartsWith('Invalid argument supplied to Iterator/LastViewHelper - expected array, Iterator or NULL but got', $output);
	}

}
