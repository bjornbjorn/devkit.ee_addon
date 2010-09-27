<?

/**
 * This class is to assist in code completion while developing modules
 */
class Devkit_code_completion
{

    /*************************************************
     * Native CodeIgniter classes
     *************************************************/


    /**
     * @var CI_Email
     */
    public $email;

    /**
     * @var CI_Loader
     */
    public $load;

    /**
     * @var CI_Input
     */     
    public $input;

    /**
     * @var CI_DB_active_record
     */
    public $db;

    /**
     * @var CI_DB_forge
     */
    public $dbforge;


    /*************************************************
     * ExpressionEngine classes     
     *************************************************/

    /**
     * @var EE_Functions
     */
    public $functions;

    /**
     * @var EE_Lang
     */
    public $lang;
    
    /**
     * @var EE_Template
     */
    public $TMPL;

    /**
     * @var Cp
     */
    public $cp;

    /**
     * @var EE_Session
     */
    public $session;


    /**
     * @var EE_Localize
     */
    public $localize;

    /**
     * @var EE_Output
     */
    public $output;

    /**
     * @var EE_Extensions
     */
    public $extensions;

    /**
     * @var EE_Config
     */
    public $config;

    /**
     * @var Wiki_model
     */
    public $wiki_model;
    
    public function __construct()
    {

    }


}

class CI_DB_active_record extends CI_DB_Driver {}
