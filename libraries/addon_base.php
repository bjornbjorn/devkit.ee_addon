<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Addon_base
{
    /**
     * @var Devkit_code_completion;
     */
    protected $EE;

    public function __construct()
    {
        $this->EE =& $this->get_ee_instance();
    }

    /**
     * @return Devkit_code_completion
     */
    public function get_ee_instance()
    {
        return get_instance();
    }

    /**
     * Helper function for getting a tag parameter (or a default value)
     * 
     * @param string $key the name of the parameter
     * @param mixed $default_value the default value if no value is given
     */
    public static function get_param($key, $default_value = '')
    {
        $val = get_instance()->TMPL->fetch_param($key);

        if($val == '') {
            return $default_value;
        }
        return $val;
    }
}