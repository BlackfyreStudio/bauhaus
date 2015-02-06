<?php

namespace KraftHaus\Bauhaus\Field;

/**
 * This file is part of the KraftHaus Bauhaus package.
 *
 * (c) KraftHaus <hello@krafthaus.nl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Illuminate\Support\Facades\View;

/**
 * Class TextField
 * @package KraftHaus\Bauhaus\Field
 */
class TextField extends BaseField
{

	protected $view = 'krafthaus/bauhaus::models.fields._text';

	/**
	 * Render the field.
	 *
	 * @access public
	 * @return mixed|string
	 */
	public function render()
	{
		return View::make($this->view)
			->with('field', $this);
	}

}
