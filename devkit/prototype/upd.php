<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');



/**
 * MODULE_DESCRIPTION
 *
 * @package		UCFIRST_MODULE_NAME
 * @subpackage	ThirdParty
 * @category	Modules
 * @author		MODULE_AUTHOR
 * @link		MODULE_LINK
 */
class UCFIRST_MODULE_NAME_upd {
		
	var $version        = '1.0'; 
	var $module_name = "UCFIRST_MODULE_NAME";
	
    function UCFIRST_MODULE_NAME_upd( $switch = TRUE ) 
    { 
		// Make a local reference to the ExpressionEngine super object
		$this->EE =& get_instance();
    } 

    /**
     * Installer for the UCFIRST_MODULE_NAME module
     */
    function install() 
	{				
						
		$data = array(
			'module_name' 	 => $this->module_name,
			'module_version' => $this->version,
			'has_cp_backend' => 'MODULE_HAS_BACKEND'
		);

		$this->EE->db->insert('modules', $data);		
		
		//
		// Add additional stuff needed on module install here
		// 
																									
		return TRUE;
	}

	
	/**
	 * Uninstall the UCFIRST_MODULE_NAME module
	 */
	function uninstall() 
	{ 				
		
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
	 * Update the UCFIRST_MODULE_NAME module
	 * 
	 * @param $current current version number
	 * @return boolean indicating whether or not the module was updated 
	 */
	
	function update($current = '')
	{
		return FALSE;
	}
    
}

/* End of file upd.MODULE_NAME.php */ 
/* Location: ./system/expressionengine/third_party/MODULE_NAME/upd.MODULE_NAME.php */ 