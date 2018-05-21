<?php
/**
 * Created by PhpStorm.
 * User: nihuan
 * Date: 14-10-16
 * Time: 下午3:18
 */
class MY_Loader extends CI_Loader{

    protected $_theme_path;

    function __construct(){
        parent::__construct();
        $this->_theme_path = config_item('theme') ? config_item('theme') . '/' : '';
        $this->_ci_view_paths = array(THEMEPATH	 => TRUE);
    }

    /**
     * Load View
     *
     * This function is used to load a "view" file.  It has three parameters:
     *
     * 1. The name of the "view" file to be included.
     * 2. An associative array of data to be extracted for use in the view.
     * 3. TRUE/FALSE - whether to return the data or load it.  In
     * some cases it's advantageous to be able to return data so that
     * a developer can process it in some way.
     *
     * @param	string
     * @param	array
     * @param	bool
     * @return	void
     */
    public function view($view, $vars = array(), $return = FALSE)
    {
        return $this->_ci_load(
            array(
                '_ci_view' => $this->_theme_path . $view,
                '_ci_vars' => $this->_ci_object_to_array($vars),
                '_ci_return' => $return
            ));
    }
}
