<?php

/**
 * The file is part of the "webifycms/app", WebifyCMS application.
 *
 * @see https://webifycms.com/
 *
 * @copyright Copyright (c) 2023 WebifyCMS
 * @license https://webifycms.com/license
 * @author Mohammed Shifreen <mshifreen@gmail.com>
 */
declare(strict_types=1);

// should require the composer autoloader on first
require __DIR__ . '/vendor/autoload.php';

use PhpCsFixer\Finder;
use Webify\Tools\Fixer\Fixer;

$finder = Finder::create()
	->in(__DIR__)
	->exclude(
		[
			'extensions',
			'themes',
			'vendor',
		]
	)
	->ignoreDotFiles(false)
	->name('*.php')
;
$rules = [
	'global_namespace_import' => [
		'import_classes'   => true,
		'import_constants' => false,
		'import_functions' => true,
	],
];

return (new Fixer($finder, $rules))
	->getConfig()
	->setUsingCache(false)
;
