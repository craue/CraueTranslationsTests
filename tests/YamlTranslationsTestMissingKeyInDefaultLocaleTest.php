<?php

namespace Craue\TranslationsTests;

use PHPUnit\Framework\AssertionFailedError;

/**
 * @author Christian Raue <christian.raue@gmail.com>
 * @copyright 2011-2022 Christian Raue
 * @license http://opensource.org/licenses/mit-license.php MIT License
 */
class YamlTranslationsTestMissingKeyInDefaultLocaleTest extends YamlTranslationsTest {

	protected function defineTranslationFiles() {
		return glob(__DIR__ . '/Resources/translations/not-ok/missing-key-in-default-locale/*.yml');
	}

	public function testYamlTranslationFilesContainNoUnknownKeys() {
		$this->expectException(AssertionFailedError::class);
		$this->expectExceptionMessage('The translation file for locale "de" (domain "messages") contains message keys not available for default locale "en".');

		parent::testYamlTranslationFilesContainNoUnknownKeys();
	}

}
