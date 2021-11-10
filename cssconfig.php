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

class plgSystemCSSConfig extends JPlugin{
	
	protected $_plugin = null;
	protected $cssCode = null;
	
	function __construct(&$subject, $config){
		parent::__construct($subject, $config);
        $this->loadLanguage();
        //recollo os datos deste plugin
		$this->_plugin = JPluginHelper::getPlugin('system', 'cssconfig');
		//se non está vacío o cadro de css, almaceno os datos na variable csscode
		if($this->params->get('css_code')){
			$this->cssCode = $this->params->get('css_code');
		}
	}
	
	function onAfterRoute() {
		//recolle a páxina na que está 
		$document = JFactory::getDocument();
		//almacena a Url na que se atopa e commproba se existe a cadena administrator, para evitar
		//cambiar o estilo as paxinas de administracion do sitio
		//se non conten esa cadena, engade o codigo css introducido a paxina do front-end
		$app = JFactory::getApplication();
		//if(!$app->isSite() || $app->isAdmin()) return;
		if(!$app->isClient('site') || $app->isClient('admin')) return;
		else $document->addStyleDeclaration($this->cssCode);
	}
}
