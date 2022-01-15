<?php

namespace Craue\TranslationsTests;

use Symfony\Component\Translation\Exception\InvalidResourceException;

/**
 * @author Christian Raue <christian.raue@gmail.com>
 * @copyright 2011-2022 Christian Raue
 * @license http://opensource.org/licenses/mit-license.php MIT License
 */
class YamlTranslationsTestInvalidYamlTest extends YamlTranslationsTest {

	protected function defineTranslationFiles() {
		return glob(__DIR__ . '/Resources/translations/not-ok/invalid-yaml/*.yml');
	}

	public function testYamlTranslationFilesContainNoUnknownKeys() {
		$this->expectException(InvalidResourceException::class);
		$expectedMessage = '/^Unable to load file/';
		// TODO just use expectExceptionMessageMatches as soon as PHPUnit >= 8.4 is required
		if (\method_exists($this, 'expectExceptionMessageMatches')) {
			$this->expectExceptionMessageMatches($expectedMessage);
		} else {
			$this->expectExceptionMessageRegExp($expectedMessage);
		}

		parent::testYamlTranslationFilesContainNoUnknownKeys();
	}

}
