<?php

namespace Craue\TranslationsTests;

use PHPUnit\Framework\TestCase;
use Symfony\Component\Translation\Loader\YamlFileLoader;

/**
 * @author Christian Raue <christian.raue@gmail.com>
 * @copyright 2011-2020 Christian Raue
 * @license http://opensource.org/licenses/mit-license.php MIT License
 */
abstract class YamlTranslationsTest extends TestCase {

	/**
	 * @var string
	 */
	private $defaultLocale = null;

	/**
	 * @var string[]
	 */
	private $translationFiles = null;

	/**
	 * @return string
	 */
	protected function defineDefaultLocale() {
		return 'en';
	}

	/**
	 * @return string[]
	 */
	abstract protected function defineTranslationFiles();

	/**
	 * @return string
	 */
	protected final function getDefaultLocale() {
		if ($this->defaultLocale === null) {
			$defaultLocale = $this->defineDefaultLocale();

			// TODO just use assertIsString as soon as PHPUnit >= 7.5 is required
			if (\method_exists($this, 'assertIsString')) {
				$this->assertIsString($defaultLocale, 'You need to define the default locale as a string.');
			} else {
				$this->assertInternalType('string', $defaultLocale, 'You need to define the default locale as a string.');
			}

			$this->defaultLocale = $defaultLocale;
		}

		return $this->defaultLocale;
	}

	/**
	 * @return string[]
	 */
	protected final function getTranslationFiles() {
		if ($this->translationFiles === null) {
			$translationFiles = $this->defineTranslationFiles();

			// TODO just use assertIsArray as soon as PHPUnit >= 7.5 is required
			if (\method_exists($this, 'assertIsArray')) {
				$this->assertIsArray($translationFiles, 'You need to define the translation files to be tested as an array of file names.');
			} else {
				$this->assertInternalType('array', $translationFiles, 'You need to define the translation files to be tested as an array of file names.');
			}

			$this->translationFiles = $translationFiles;
		}

		return $this->translationFiles;
	}

	public function testTranslationFilesExist() {
		$this->assertNotEmpty($this->getTranslationFiles(), 'No translation files found.');

		foreach ($this->getTranslationFiles() as $file) {
			$this->assertFileExists($file);
		}
	}

	/**
	 * Ensure that translation files contain only message keys also available in the default translation.
	 *
	 * It's ok for a translation file to contain not all of the default translation's keys, since this happens when new functionality is
	 * added and the translations will be completed later.
	 * But it's not ok for a translation file to contain keys that are not available in the default translation.
	 */
	public function testYamlTranslationFilesContainNoUnknownKeys() {
		$files = $this->getTranslationFiles();

		if (empty($files)) {
			$this->markTestSkipped('No translation files found.');
		}

		$loader = new YamlFileLoader();
		$translations = [];

		foreach ($files as $file) {
			list($domain, $locale) = explode('.', basename($file));
			$catalogue = $loader->load($file, $locale, $domain);
			$translations[$domain][$locale] = array_keys($catalogue->all($domain));
		}

		$defaultLocale = $this->getDefaultLocale();

		foreach ($translations as $domain => $locales) {
			$this->assertArrayHasKey($defaultLocale, $translations[$domain],
					sprintf('Domain "%s" has no translation file for the default locale "%s".', $domain, $defaultLocale));

			foreach ($locales as $locale => $keys) {
				if ($locale === $defaultLocale) {
					continue;
				}

				$this->assertEquals([], array_diff($keys, $translations[$domain][$defaultLocale]),
						sprintf('The translation file for locale "%s" (domain "%s") contains message keys not available for default locale "%s".', $locale, $domain, $defaultLocale));
			}
		}
	}

}
