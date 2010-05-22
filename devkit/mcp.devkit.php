<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Devkit CP
 *
 * @package		Devkit
 * @subpackage	ThirdParty
 * @category	Modules
 * @author		Bjorn Borresen
 * @link		http://ee.bybjorn.com/devkit
 */
class Devkit_mcp
{
	var $base;			// the base url for this module			
	var $form_base;		// base url for forms
	var $module_name;	

	function Devkit_mcp( $switch = TRUE )
	{
		$this->EE =& get_instance();    // Make a local reference to the ExpressionEngine super object
		$this->module_name = strtolower(str_replace('_mcp', '', get_class($this)));
		$this->base	 	 = BASE.AMP.'C=addons_modules'.AMP.'M=show_module_cp'.AMP.'module='.$this->module_name;
		$this->form_base = 'C=addons_modules'.AMP.'M=show_module_cp'.AMP.'module='.$this->module_name;

		$this->EE->cp->set_right_nav(array(
                'home'                      => $this->base,
				'dev_create_module'			=> $this->base.AMP.'method=new_module',
                'yaml2dbforge'              => $this->base.AMP.'method=yaml2dbforge',
				'dev_sync_globals'	        => $this->base.AMP.'method=sync_globals',
			));
	}

	function index() 
	{
	    return $this->content_wrapper('index', 'welcome');
	}

    function new_module()
    {
        return $this->content_wrapper('new_module', 'create_module');
    }

	function sync_globals()
	{		
		$this->EE->load->helper('devkit_helper');
        $vars = array();
		$vars['performed'] = array();
		if($this->EE->config->item('save_tmpl_files') == 'y')
		{
			$tmpl_basepath = $this->EE->config->slash_item('tmpl_file_basepath') . $this->EE->config->slash_item('site_short_name');
			if($tmpl_basepath != $this->EE->config->slash_item('site_short_name') && file_exists($tmpl_basepath))
			{
				$global_variables = get_files($tmpl_basepath.'global_variables/');
				$snippets = get_files($tmpl_basepath.'snippets/');

				foreach($global_variables as $global_variable_filename)
				{

					$this->EE->db->like('variable_name', $global_variable_filename);
					$this->EE->db->from('global_variables');
					$global_variable_data = file_get_contents($tmpl_basepath.'global_variables/'.$global_variable_filename);
					if($this->EE->db->count_all_results() == 0)
					{
						$this->EE->db->insert('global_variables', array(
							'variable_name' => $global_variable_filename,
							'variable_data' => $global_variable_data,
						));

						$vars['performed'][] = 'Inserted <strong>global_variable</strong> <em>'.$global_variable_filename."</em>";
					}
					else
					{
						$this->EE->db->where('variable_name', $global_variable_filename);
						$this->EE->db->update('global_variables', array('variable_data' => $global_variable_data));
						$vars['performed'][] = 'Updated <strong>global_variable</strong> <em>'.$global_variable_filename."</em>";
					}
				}


				foreach($snippets as $snippet_filename)
				{

					$this->EE->db->like('snippet_name', $snippet_filename);
					$this->EE->db->from('snippets');
					$snippet_data = file_get_contents($tmpl_basepath.'snippets/'.$snippet_filename);
					if($this->EE->db->count_all_results() == 0)
					{
						$this->EE->db->insert('snippets', array(
							'snippet_name' => $snippet_filename,
							'snippet_contents' => $snippet_data,
						));

						$vars['performed'][] = 'Inserted <strong>snippet</strong> <em>'.$snippet_filename."</em>";
					}
					else
					{
						$this->EE->db->where('snippet_name', $snippet_filename);
						$this->EE->db->update('snippets', array('snippet_contents' => $snippet_data));
						$vars['performed'][] = 'Updated <strong>snippet</strong> <em>'.$snippet_filename."</em>";
					}
				}
			}
			else
			{
				show_error('Template basepath not defined - or not found ('.$tmpl_basepath.')');
			}
		}
		else
		{
			show_error('Save templates as files must be set to Yes in Global Template Preferences');
		}

		return $this->content_wrapper('sync', 'dev_sync_globals', $vars);
	}

    function yaml2dbforge()
    {
        $vars = array();
        $yaml = $this->EE->input->post('yaml');
        $vars['yaml'] = $yaml;

        if($yaml)
        {
            $this->EE->load->helper('yayparser_helper');
            $this->EE->load->helper('devkit_helper');
            $parsed_arr = YAYPARSER_parse($yaml);
            $vars['parsed_arr'] = $parsed_arr;
        }

        return $this->content_wrapper('yaml2dbforge', 'yaml2dbforge', $vars);
    }
	
	function create_module()
	{
		$new_module_name = strtolower($this->EE->input->post('module_name'));
		$module_human_name = $this->EE->input->post('module_human_name');
		$module_description = $this->EE->input->post('module_description');
		$module_author = $this->EE->input->post('module_author');
		$module_link = $this->EE->input->post('module_link');
		$has_backend = $this->EE->input->post('has_backend');
		
		if(!file_exists(PATH_THIRD.'/'.$new_module_name))
		{
			if($new_module_name != '' && $module_human_name != '' && $module_description != '')
			{
				mkdir(PATH_THIRD.'/'.$new_module_name);
				mkdir(PATH_THIRD.'/'.$new_module_name.'/language');
				mkdir(PATH_THIRD.'/'.$new_module_name.'/language/english');
				
				$replace_arr = array(
					'UCFIRST_MODULE_NAME' => ucfirst($new_module_name),					
					'MODULE_NAME' => $new_module_name,
					'MODULE_HUMAN_NAME' => $module_human_name,
					'MODULE_DESCRIPTION' => $module_description,
					'MODULE_HAS_BACKEND' => $has_backend,
					'MODULE_AUTHOR' => $module_author,
					'MODULE_LINK' => $module_link, 
				);
				
				$this->writeFile(PATH_THIRD.'/'.$new_module_name.'/language/english/lang.'.$new_module_name.'.php', $replace_arr, PATH_THIRD.$this->module_name.'/prototype/language/english/lang.php');
				$this->writeFile(PATH_THIRD.'/'.$new_module_name.'/upd.'.$new_module_name.'.php', $replace_arr, PATH_THIRD.$this->module_name.'/prototype/upd.php');
				$this->writeFile(PATH_THIRD.'/'.$new_module_name.'/mcp.'.$new_module_name.'.php', $replace_arr, PATH_THIRD.$this->module_name.'/prototype/mcp.php');
				$this->writeFile(PATH_THIRD.'/'.$new_module_name.'/mod.'.$new_module_name.'.php', $replace_arr, PATH_THIRD.$this->module_name.'/prototype/mod.php');

				if($has_backend == 'y')
				{
					mkdir(PATH_THIRD.'/'.$new_module_name.'/views');					
					$this->writeFile(PATH_THIRD.'/'.$new_module_name.'/views/_wrapper.php', $replace_arr, PATH_THIRD.$this->module_name.'/prototype/views/_wrapper.php');
					$this->writeFile(PATH_THIRD.'/'.$new_module_name.'/views/index.php', $replace_arr, PATH_THIRD.$this->module_name.'/prototype/views/index.php');					
				}
				
				
				return $this->content_wrapper('finito', 'module_created', array('module_name' => $new_module_name, 'module_human_name' => $module_human_name));
			}
			else
			{
				show_error("Information missing; you must fill out the required fields");	
			}						
		}
		else
		{
			show_error("A module by that name already exists, delete it or choose another name.");
		}
	}
	
	function writeFile($target_file, $replace_arr, $template_file )
	{
		if(file_exists($template_file))
		{
			$tpl_str = file_get_contents($template_file);
			foreach($replace_arr as $key => $value)
			{
				$tpl_str = str_replace($key, $value, $tpl_str);
			}
			
			if(!file_put_contents($target_file, $tpl_str ))
			{
				show_error("Could not write to file: $target_file");
			}
			
		}
		else
		{
			show_error("Could not find template: ". $template_file);
		}		
		
	}

	
	function content_wrapper($content_view, $lang_key, $vars = array())
	{
		$vars['content_view'] = $content_view;
		$vars['_base'] = $this->base;
		$vars['_form_base'] = $this->form_base;
		$this->EE->cp->set_variable('cp_page_title', lang($lang_key));
		$this->EE->cp->set_breadcrumb($this->base, lang($this->module_name.'_module_name'));

		return $this->EE->load->view('_wrapper', $vars, TRUE);
	}
	
}

/* End of file mcp.module_creator.php */ 
/* Location: ./system/expressionengine/third_party/module_creator/mcp.module_creator.php */ 