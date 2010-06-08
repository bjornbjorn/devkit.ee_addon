<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if(!function_exists('get_files')){

    /**
	 * Get dirs/files from a source_dir
	 *
	 * @param $source_dir
	 */
	function get_files($source_dir)
	{
		$files = array();

		$fp = @opendir($source_dir);

		if ($fp)
		{
			while (FALSE !== ($file = readdir($fp)))
			{
				if (is_file($source_dir.$file))
				{
					$files[] = $file;
				}
			}
			closedir($fp);
		}
		else
		{
			show_error("Could not open dir: " . $source_dir);
		}
		return $files;
	}




    /**
     * Will return dbforge code from a yaml definition
     */
    function get_dbforge_col_def($col_name, $yaml_def)
    {
        $arr = explode("(", $yaml_def);
        $yaml_type = "";
        $yaml_type = strtolower(trim($arr[0],";"));

        $dbforge_type = "";
        $extra = array();
        switch($yaml_type)
        {
            case 'primary':
                $dbforge_type = 'int';
                $extra['constraint'] = "'10'";
                $extra['unsigned'] = 'TRUE';
                $extra['auto_increment'] = 'TRUE';
                break;

            case 'int':
            case 'integer':
                $dbforge_type = 'int';
                $extra['constraint'] = "'10'";
                $extra['null'] = 'FALSE';
                break;

            case 'varchar':
            case 'string':
                $dbforge_type = 'varchar';
                $extra['constraint'] = "'255'";
                $extra['null'] = 'FALSE';
                break;
            case 'text':
                $dbforge_type = 'text';
                break;

            case 'char':
                $dbforge_type = 'char';
                $extra['constraint'] = "'1'";   // defaults to char(1)                
                break;
        }

        if(count($arr) > 1) // handle e.g. string(255)
        {
            $extra['constraint'] = "'".trim($arr[1], ");") ."'";
        }

        $ret = "    '$col_name' => array(\n        'type' => '$dbforge_type',";
        if(count($extra))
        {
            foreach($extra as $e_key => $e_value)
            {
                $ret .= "\n        '$e_key' => $e_value,";
            }
        }
        $ret .= "),\n";

        return $ret;

    }



}

