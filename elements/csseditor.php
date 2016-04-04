<?php
/*
 *      CSSConfig System plug-in
 *      @package CSSConfig System plug-in
 *      @subpackage Content
 *      @author Alberto Armada Fraga
 *      @copyright Copyright (C) 2013 Joomla Empresa Team. All rights reserved
 *      @license GNU/GPL v3 or later
 *      
 *      Contact us at info@joomlaempresa.com (http://www.joomlaempresa.es)
 *      
 *      This file is part of CSSConfig System plug-in.
 *      
 *          CSSConfig System plug-in is free software: you can redistribute it and/or modify
 *          it under the terms of the GNU General Public License as published by
 *          the Free Software Foundation, either version 3 of the License, or
 *          (at your option) any later version.
 *      
 *          CSSConfig System plug-in is distributed in the hope that it will be useful,
 *          but WITHOUT ANY WARRANTY; without even the implied warranty of
 *          MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *          GNU General Public License for more details.
 *      
 *          You should have received a copy of the GNU General Public License
 *          along with CSSConfig System plug-in.  If not, see <http://www.gnu.org/licenses/>.
 */
defined('_JEXEC') or die;

jimport('joomla.form.formfield');

class JFormFieldCSSEditor extends JFormField {
	protected $type = 'CSSEditor';

	protected function getInput() {
		if(!JPluginHelper::isEnabled('editors', 'codemirror')) return '<strong>Sorry: this plugin needs the CodeMirror editor plug-in to be enabled</strong>';
		$app = JFactory::getApplication('administrator');
		$app->setUserState('editor.source.syntax', 'css');
		$editor = JFactory::getEditor('codemirror');
		$params = array(
					'linenumbers'=> '1' ,
                 'tabmode'  => 'shift'
                 );
		$html = '<div style="clear: both;"></div>'.$editor->display($this->name, $this->value, '400', '245', '20', '20', false, $this->id, null, null, $params);
		$app->setUserState('editor.source.syntax', null);
		return $html;
	}
}
