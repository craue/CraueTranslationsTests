# Information

[![Build Status](https://app.travis-ci.com/craue/CraueTranslationsTests.svg?branch=master)](https://app.travis-ci.com/craue/CraueTranslationsTests)

This repository contains just some common code for testing translations in your Symfony project.

# Installation

Let Composer download and install the bundle by running

```sh
composer require --dev craue/translations-tests
```

in a shell.

# Usage

```php
// src/app/Tests/TranslationsTest.php
namespace Application\Tests;

use Craue\TranslationsTests\YamlTranslationsTest;

/**
 * @group unit
 */
class TranslationsTest extends YamlTranslationsTest {

	// only add this method to override the default implementation returning "en"
	protected function defineDefaultLocale() : string {
		return 'de';
	}

	// specify all locations with translation files
	protected function defineTranslationFiles() : array {
		return array_merge(
			glob(__DIR__ . '/../../Resources/translations/*.yml'),
			glob(__DIR__ . '/../../Resources/*Bundle/translations/*.yml'),
			glob(__DIR__ . '/../../../src/*/*Bundle/Resources/translations/*.yml')
		);
	}

}
```
