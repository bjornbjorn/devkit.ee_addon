<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once PATH_THIRD.'libraries/addon_base.php';

/**
 * Module Creator
 *
 * @package		Devkit
 * @subpackage	ThirdParty
 * @category	Modules
 * @author		Bjorn Borresen
 * @link		http://ee.bybjorn.com/devkit
 */
class Devkit extends Addon_base {

	var $return_data;

    /**
     * @var Devkit_code_completion
     */
    private $EE;
	
	function Devkit()
	{
        parent::__construct();
	}


}

/* End of file mod.devkit.php */ 
/* Location: ./system/expressionengine/third_party/devkit/mod.devkit.php */