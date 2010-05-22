<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Module Creator
 *
 * @package		Devkit
 * @subpackage	ThirdParty
 * @category	Modules
 * @author		Bjorn Borresen
 * @link		http://ee.bybjorn.com/devkit
 */
class Devkit {

	var $return_data;
	
	function Devkit()
	{		
		$this->EE =& get_instance(); // Make a local reference to the ExpressionEngine super object
	}		
}

/* End of file mod.devkit.php */ 
/* Location: ./system/expressionengine/third_party/devkit/mod.devkit.php */