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



    /**************************************************
     * Nokia QtDN specific classes
     **************************************************/

    /**
     * @var Group_access
     */
    public $group_access;

    /**
     * @var Group_requests
     */
    public $group_requests;


    /**
     * @var Grouplib
     */
    public $grouplib;

    /**
     * @var Group_updates
     */
    public $group_updates;

    /**
     * @var Group_actions
     */
    public $group_actions;

    /**
     * @var MemberLib
     */
    public $memberlib;

    /**
     * @var SecurityLib
     */
    public $securitylib;

    /**
     * @var Group_memberships
     */
    public $group_memberships;

    /**
     * @var Group_wiki
     */
    public $group_wiki;

    /**
     * @var Group_activity
     */
    public $group_activity;

    /**
     * @var Group_preferences
     */
    public $group_preferences;



    public function __construct()
    {

    }


}

class CI_DB_active_record extends CI_DB_Driver {}
