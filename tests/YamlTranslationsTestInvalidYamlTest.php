<?php

namespace Craue\TranslationsTests;

use Symfony\Component\Translation\Exception\InvalidResourceException;

/**
 * @author Christian Raue <christian.raue@gmail.com>
 * @copyright 2011-2022 Christian Raue
 * @license http://opensource.org/licenses/mit-license.php MIT License
 */
class YamlTranslationsTestInvalidYamlTest extends YamlTranslationsTest {

	protected function defineTranslationFiles() : array {
		return glob(__DIR__ . '/Resources/translations/not-ok/invalid-yaml/*.yml');
	}

	public function testYamlTranslationFilesContainNoUnknownKeys() : void {
		$this->expectException(InvalidResourceException::class);
		$this->expectExceptionMessageMatches('/^Unable to load file/');

		parent::testYamlTranslationFilesContainNoUnknownKeys();
	}

}
