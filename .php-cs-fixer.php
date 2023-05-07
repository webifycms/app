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

use Webify\Tools\Fixer;
use PhpCsFixer\Finder;

$finder = Finder::create()
	->in([
		__DIR__ . '/src',
		__DIR__ . '/test',
	])
	->name('*.php')
;

return (new Fixer($finder))->getConfig();
