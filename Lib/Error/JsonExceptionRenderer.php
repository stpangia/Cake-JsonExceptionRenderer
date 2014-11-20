<?php
/**
 * Exception Renderer
 *
 * Provides Exception rendering features. Which allow exceptions to be rendered
 * as HTML pages.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.Error
 * @since         CakePHP(tm) v 2.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Error', 'ExceptionRenderer');

/*
	JsonExceptionRenderer handles all exceptions on behalf of the Cake application
	instead of the default handler. It returns exception codes and messages 
	encoded as JSON, allowing them to be handled more easily on the client side.
*/
	
class JsonExceptionRenderer extends ExceptionRenderer {

	protected function _outputMessage($template) {
		$this->controller->response->header('Access-Control-Allow-Origin', '*');
		$this->controller->set('response', array('code'=>$this->error->getCode(), 'message'=>$this->error->getMessage()));
		$this->controller->set('_serialize',array('response'));
		$this->controller->RequestHandler->renderAs($this->controller, 'json');	
		$this->controller->render($template);
		$this->controller->afterFilter();	
		$this->controller->response->send();
	}

}
