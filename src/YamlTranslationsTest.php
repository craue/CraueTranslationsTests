<?php

namespace Craue\TranslationsTests;

use PHPUnit\Framework\TestCase;
use Symfony\Component\Translation\Loader\YamlFileLoader;

/**
 * @author Christian Raue <christian.raue@gmail.com>
 * @copyright 2011-2022 Christian Raue
 * @license http://opensource.org/licenses/mit-license.php MIT License
 */
abstract class YamlTranslationsTest extends TestCase {

	/**
	 * @var string|null
	 */
	private $defaultLocale = null;

	/**
	 * @var string[]|null
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

	protected final function getDefaultLocale() : string {
		if ($this->defaultLocale === null) {
			$this->defaultLocale = $this->defineDefaultLocale();
		}

		return $this->defaultLocale;
	}

	/**
	 * @return string[]
	 */
	protected final function getTranslationFiles() : array {
		if ($this->translationFiles === null) {
			$translationFiles = $this->defineTranslationFiles();

			self::assertContainsOnly('string', $translationFiles, true, 'You need to define the translation files to be tested as an array of file names.');

			$this->translationFiles = $translationFiles;
		}

		return $this->translationFiles;
	}

	public function testTranslationFilesExist() : void {
		self::assertNotEmpty($this->getTranslationFiles(), 'No translation files found.');

		foreach ($this->getTranslationFiles() as $file) {
			self::assertFileExists($file);
		}
	}

	/**
	 * Ensure that translation files contain only message keys also available in the default translation.
	 *
	 * It's ok for a translation file to contain not all of the default translation's keys, since this happens when new functionality is
	 * added and the translations will be completed later.
	 * But it's not ok for a translation file to contain keys that are not available in the default translation.
	 */
	public function testYamlTranslationFilesContainNoUnknownKeys() : void {
		$files = $this->getTranslationFiles();

		if (count($files) === 0) {
			self::markTestSkipped('No translation files found.');
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
			self::assertArrayHasKey($defaultLocale, $translations[$domain],
					sprintf('Domain "%s" has no translation file for the default locale "%s".', $domain, $defaultLocale));

			foreach ($locales as $locale => $keys) {
				if ($locale === $defaultLocale) {
					continue;
				}

				self::assertEquals([], array_diff($keys, $translations[$domain][$defaultLocale]),
						sprintf('The translation file for locale "%s" (domain "%s") contains message keys not available for default locale "%s".', $locale, $domain, $defaultLocale));
			}
		}
	}

}
