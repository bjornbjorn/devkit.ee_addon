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
     * @var EE_Template
     */
    public $TMPL;

    /**
     * @var Cp
     */
    public $cp;

    public function __construct()
    {

    }


}
