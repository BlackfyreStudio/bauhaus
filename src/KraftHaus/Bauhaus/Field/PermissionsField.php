<?php
/**
 * Created by IntelliJ IDEA.
 * User: Meki
 * Date: 06/02/15
 * Time: 10:25
 */

namespace KraftHaus\Bauhaus\Field;

use KraftHaus\Bauhaus\Field\BaseField;
use Illuminate\Support\Facades\Form;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Input;

class PermissionsField extends BaseField {
	
	/**
	 * Render the field.
	 *
	 * @access public
	 * @return mixed|string
	 */
	public function render()
	{
		$groupId = $this->getAdmin()->getFormBuilder()->getIdentifier();

		return View::make('krafthaus/bauhaus::models.fields._permissions')->with([
			'field'=> $this,
			'groupId' => $groupId,
			'permissions' => \Sentry::findGroupById($groupId)->getPermissions()
		]);
	}
}
