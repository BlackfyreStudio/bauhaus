<?php
/**
 * Created by IntelliJ IDEA.
 * User: Meki
 * Date: 2015.02.09.
 * Time: 6:34
 */

namespace KraftHaus\Bauhaus\Field;

use KraftHaus\Bauhaus\Field\BaseField;
use Illuminate\Support\Facades\Form;
use Illuminate\Support\Facades\View;

class CkeditorField extends BaseField {
	protected $view = 'krafthaus/bauhaus::models.fields._ckeditor';

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

	/**
	 * Override the getAttributes method to add the multiple attribute.
	 *
	 * @access public
	 * @return array
	 */
	public function getAttributes()
	{
		$this->attribute('class', 'ckeditor');
		return $this->attributes;
	}
}
