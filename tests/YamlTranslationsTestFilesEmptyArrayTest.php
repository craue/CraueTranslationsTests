<?php

namespace Craue\TranslationsTests;

use PHPUnit\Framework\AssertionFailedError;
use PHPUnit\Framework\SkippedTestError;

/**
 * @author Christian Raue <christian.raue@gmail.com>
 * @copyright 2011-2021 Christian Raue
 * @license http://opensource.org/licenses/mit-license.php MIT License
 */
class YamlTranslationsTestFilesEmptyArrayTest extends YamlTranslationsTest {

	protected function defineTranslationFiles() {
		return [];
	}

	public function testTranslationFilesExist() {
		$this->expectException(AssertionFailedError::class);
		$this->expectExceptionMessage('No translation files found.');

		parent::testTranslationFilesExist();
	}

	public function testYamlTranslationFilesContainNoUnknownKeys() {
		$this->expectException(SkippedTestError::class);
		$this->expectExceptionMessage('No translation files found.');

		parent::testYamlTranslationFilesContainNoUnknownKeys();
	}

}
