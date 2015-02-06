<?php

namespace KraftHaus\Bauhaus;

/**
 * This file is part of the KraftHaus Bauhaus package.
 *
 * (c) KraftHaus <hello@krafthaus.nl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Config;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

/**
 * Class ScaffoldCommand
 * @package KraftHaus\Bauhaus
 */
class ScaffoldCommand extends Command
{

	/**
	 * The console command name.
	 * @var string
	 */
	protected $name = 'bauhaus:scaffold';

	/**
	 * The console command description.
	 * @var string
	 */
	protected $description = 'Creates initial bauhaus models';

	/**
	 * Execute the console command.
	 *
	 * @access public
	 * @return mixed
	 */
	public function fire()
	{


		$model = $this->option('model');
		$plural = Str::plural($model);
		$modelName = Str::studly($model);

		// Create the model
		$stub = file_get_contents(__DIR__ . '/stubs/model.txt');
		$stub = str_replace('$NAME$', $modelName, $stub);
		file_put_contents(app_path('models/' . $modelName . '.php'), $stub);

		// Create the admin controller
		$directory = Config::get('bauhaus::admin.directory');

		$stub = file_get_contents(__DIR__ . '/stubs/admin.txt');
		$stub = str_replace('$NAME$', $modelName, $stub);

		/* Check if the admin directory exists, if not then create it */
		if (!is_writable($directory)) {
			mkdir($directory);
		}

		file_put_contents(app_path($directory . '/' . ucfirst($model) . 'Admin.php'), $stub);

		// Create the migration
		$this->call('migrate:make', [
			'name'     => sprintf('create_%s_table', $plural),
			'--table'  => $plural,
			'--create' => true
		]);

		/*
		 * Save the new permission group
		 */
		\Eloquent::unguard();
		\KraftHaus\BauhausUser\PermissionRegister::create([
			'name'=>$modelName
		]);

		/*
		 * Update the admin group with the new permission
		 */
		$adminGroup = \Sentry::findGroupById(1);

		$permissions = $adminGroup->getPermissions();
		$permissions[$modelName] = 1;

		$adminGroup->permissions = $permissions;
		$adminGroup->save();

	}

	/**
	 * Get the console command options.
	 *
	 * @access protected
	 * @return array
	 */
	protected function getOptions()
	{
		return [
			['model', null, InputOption::VALUE_REQUIRED, 'An example option.', null]
		];
	}

}
