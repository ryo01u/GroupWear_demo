<?php
/**
 * Application level View Helper
 *
 * This file is application-wide helper file. You can put all
 * application-wide helper-related methods here.
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
 * @package       app.View.Helper
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Helper', 'View');

/**
 * Application helper
 *
 * Add your application-wide methods in the class below, your helpers
 * will inherit them.
 *
 * @package       app.View.Helper
 */
class UtilHelper extends Helper {
	
  public function getImageTag($folder , $id){

		if(file_exists( WWW_ROOT  . "img" . "/" . $folder . "/" . $id . ".jpg")){
			
			return "<img src=\"" . URI_PATH . "/img/" . $folder . "/"  . $id .  ".jpg\" alt=\"画像\"  />";					
		} else {
			return "<img src=\"" . URI_PATH . "/img/" . $folder . "/"  . "noimage.jpg\" alt=\"画像\"  />";
			
		}
		

   }
	
	
}
