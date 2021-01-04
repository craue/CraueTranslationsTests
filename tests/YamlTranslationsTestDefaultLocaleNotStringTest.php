<?php

namespace Craue\TranslationsTests;

use PHPUnit\Framework\AssertionFailedError;

/**
 * @author Christian Raue <christian.raue@gmail.com>
 * @copyright 2011-2021 Christian Raue
 * @license http://opensource.org/licenses/mit-license.php MIT License
 */
class YamlTranslationsTestDefaultLocaleNotStringTest extends YamlTranslationsTest {

	protected function defineDefaultLocale() {
		return null;
	}

	protected function defineTranslationFiles() {
		return glob(__DIR__ . '/Resources/translations/ok/*/*.yml');
	}

	public function testYamlTranslationFilesContainNoUnknownKeys() {
		$this->expectException(AssertionFailedError::class);
		$this->expectExceptionMessage('You need to define the default locale as a string.');

		parent::testYamlTranslationFilesContainNoUnknownKeys();
	}

}
