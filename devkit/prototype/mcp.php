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
class UCFIRST_MODULE_NAME_mcp 
{
	var $base;			// the base url for this module			
	var $form_base;		// base url for forms
	var $module_name = "MODULE_NAME";	

	function UCFIRST_MODULE_NAME_mcp( $switch = TRUE )
	{
		// Make a local reference to the ExpressionEngine super object
		$this->EE =& get_instance(); 
		$this->base	 	 = BASE.AMP.'C=addons_modules'.AMP.'M=show_module_cp'.AMP.'module='.$this->module_name;
		$this->form_base = 'C=addons_modules'.AMP.'M=show_module_cp'.AMP.'module='.$this->module_name;

        // uncomment this if you want navigation buttons at the top
/*		$this->EE->cp->set_right_nav(array(
				'home'			=> $this->base,
				'some_language_key'	=> $this->base.AMP.'method=some_method_here',
			));
*/			
	}

	function index() 
	{
		$vars = array();
		return $this->content_wrapper('index', 'welcome', $vars);
	}

	
	function content_wrapper($content_view, $lang_key, $vars = array())
	{
		$vars['content_view'] = $content_view;
		$vars['_base'] = $this->base;
		$vars['_form_base'] = $this->form_base;
		$this->EE->cp->set_variable('cp_page_title', lang($lang_key));
		$this->EE->cp->set_breadcrumb($this->base, lang('MODULE_NAME_module_name'));

		return $this->EE->load->view('_wrapper', $vars, TRUE);
	}
	
}

/* End of file mcp.MODULE_NAME.php */ 
/* Location: ./system/expressionengine/third_party/MODULE_NAME/mcp.MODULE_NAME.php */ 