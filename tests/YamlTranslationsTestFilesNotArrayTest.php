<?php

namespace Craue\TranslationsTests;

use PHPUnit\Framework\AssertionFailedError;

/**
 * @author Christian Raue <christian.raue@gmail.com>
 * @copyright 2011-2020 Christian Raue
 * @license http://opensource.org/licenses/mit-license.php MIT License
 */
class YamlTranslationsTestFilesNotArrayTest extends YamlTranslationsTest {

	protected function defineTranslationFiles() {
		return null;
	}

	public function testTranslationFilesExist() {
		$this->expectException(AssertionFailedError::class);
		$this->expectExceptionMessage('You need to define the translation files to be tested as an array of file names.');

		parent::testTranslationFilesExist();
	}

	public function testYamlTranslationFilesContainNoUnknownKeys() {
		$this->expectException(AssertionFailedError::class);
		$this->expectExceptionMessage('You need to define the translation files to be tested as an array of file names.');

		parent::testYamlTranslationFilesContainNoUnknownKeys();
	}

}
