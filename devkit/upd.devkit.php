<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once PATH_THIRD.'libraries/addon_base.php';

/**
 * Installer for Devkit module
 *
 * @package		Devkit
 * @subpackage	ThirdParty
 * @category	Modules
 * @author		Bjorn Borresen
 * @link		http://ee.bybjorn.com/devkit
 */
class Devkit_upd extends Addon_base {
		
	var $version        = '1.0'; 
	var $module_name = "Devkit";
	
    function __construct( $switch = TRUE ) 
    { 
    	parent::__construct($switch);
    } 

    /**
     * Installer for the Rating module
     */
    function install() 
	{				
						
		$data = array(
			'module_name' 	 => $this->module_name,
			'module_version' => $this->version,
			'has_cp_backend' => 'y'
		);

		$this->EE->db->insert('modules', $data);		
																										
		return TRUE;
	}

	
	/**
	 * Uninstall the Module_creator module
	 */
	function uninstall() 
	{ 				
		$this->EE->load->dbforge();
		
		$this->EE->db->select('module_id');
		$query = $this->EE->db->get_where('modules', array('module_name' => $this->module_name));
		
		$this->EE->db->where('module_id', $query->row('module_id'));
		$this->EE->db->delete('module_member_groups');
		
		$this->EE->db->where('module_name', $this->module_name);
		$this->EE->db->delete('modules');
		
		$this->EE->db->where('class', $this->module_name);
		$this->EE->db->delete('actions');
		
		$this->EE->db->where('class', $this->module_name.'_mcp');
		$this->EE->db->delete('actions');
										
		return TRUE;
	}
	
	/**
	 * Update the module
	 * 
	 * @param $current current version number
	 * @return boolean indicating whether or not the module was updated 
	 */
	
	function update($current = '')
	{
		return FALSE;
	}
    
}

/* End of file upd.devkit.php */ 
/* Location: ./system/expressionengine/third_party/devkit/upd.devkit.php */