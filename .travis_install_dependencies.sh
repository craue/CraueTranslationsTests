#!/bin/bash

set -euv

export COMPOSER_NO_INTERACTION=1
composer self-update

case "${DEPS:-}" in
	'lowest')
		COMPOSER_UPDATE_ARGS='--prefer-lowest'
		;;
	'unmodified')
		# don't modify dependencies, install them as defined
		;;
esac

composer update ${COMPOSER_UPDATE_ARGS:-}
