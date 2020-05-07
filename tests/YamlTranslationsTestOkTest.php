<?php

namespace Craue\TranslationsTests;

/**
 * @author Christian Raue <christian.raue@gmail.com>
 * @copyright 2011-2020 Christian Raue
 * @license http://opensource.org/licenses/mit-license.php MIT License
 */
class YamlTranslationsTestOkTest extends YamlTranslationsTest {

	protected function defineTranslationFiles() {
		return glob(__DIR__ . '/Resources/translations/ok/*/*.yml');
	}

}
