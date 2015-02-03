<?php
/**
 * Created by IntelliJ IDEA.
 * User: Meki
 * Date: 2015.02.02.
 * Time: 19:15
 */

namespace KraftHaus\Bauhaus\Field;

use KraftHaus\Bauhaus\Field\BaseField;
use Illuminate\Support\Facades\Form;
use Illuminate\Support\Facades\View;

class MarkdownField extends BaseField {
	protected $view = 'krafthaus/bauhaus::models.fields._wysiwyg';

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
		$this->attribute('data-provide', 'markdown');
		return $this->attributes;
	}
}
