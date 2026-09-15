<?php

namespace Craue\TranslationsTests;

use PHPUnit\Framework\AssertionFailedError;
use PHPUnit\Framework\SkippedTest;

/**
 * @author Christian Raue <christian.raue@gmail.com>
 * @copyright 2011-2026 Christian Raue
 * @license http://opensource.org/licenses/mit-license.php MIT License
 */
class YamlTranslationsTestFilesEmptyArrayTest extends YamlTranslationsTest {

	protected function defineTranslationFiles() : array {
		return [];
	}

	public function testTranslationFilesExist() : void {
		$this->expectException(AssertionFailedError::class);
		$this->expectExceptionMessage('No translation files found.');

		parent::testTranslationFilesExist();
	}

	public function testYamlTranslationFilesContainNoUnknownKeys() : void {
		try {
			parent::testYamlTranslationFilesContainNoUnknownKeys();
			self::fail();
		} catch (SkippedTest $e) {
			self::assertSame('No translation files found.', $e->getMessage());
		}
	}

}
