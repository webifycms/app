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

namespace App\Infrastructure\Presentation\Console\Controller;

use yii\console\Controller;
use yii\console\ExitCode;

/**
 * This command echoes the first argument that you have entered.
 * This command is provided as an example for you to learn how to create console commands.
 */
final class HelloController extends Controller
{
	/**
	 * This command echoes what you have entered as the message.
	 *
	 * @param string $message the message to be echoed
	 *
	 * @return int Exit code
	 */
	public function actionIndex(string $message = 'hello world'): int
	{
		echo $message . "\n";

		return ExitCode::OK;
	}
}
