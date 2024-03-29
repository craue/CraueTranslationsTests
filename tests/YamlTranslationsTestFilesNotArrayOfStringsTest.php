<?php

namespace Craue\TranslationsTests;

use PHPUnit\Framework\AssertionFailedError;

/**
 * @author Christian Raue <christian.raue@gmail.com>
 * @copyright 2011-2022 Christian Raue
 * @license http://opensource.org/licenses/mit-license.php MIT License
 */
class YamlTranslationsTestFilesNotArrayOfStringsTest extends YamlTranslationsTest {

	protected function defineTranslationFiles() : array {
		return [null];
	}

	public function testTranslationFilesExist() : void {
		$this->expectException(AssertionFailedError::class);
		$this->expectExceptionMessage('You need to define the translation files to be tested as an array of file names.');

		parent::testTranslationFilesExist();
	}

	public function testYamlTranslationFilesContainNoUnknownKeys() : void {
		$this->expectException(AssertionFailedError::class);
		$this->expectExceptionMessage('You need to define the translation files to be tested as an array of file names.');

		parent::testYamlTranslationFilesContainNoUnknownKeys();
	}

}
