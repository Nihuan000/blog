<?php
/**
 * Created by PhpStorm.
 * User: nihuan
 * Date: 14-10-16
 * Time: 下午3:18
 */
class ADMIN_Loader extends CI_Loader{

    //如果当前目录找不到该文件，就在根目录下找
    protected $_ci_root_path			= array();

    function __construct(){
        parent::__construct();
        $this->_ci_helper_paths = array(APPPATH, BASEPATH, HOME_APP_PATH);
    }

    /**
     * Load Helper
     *
     * This function loads the specified helper file.
     *
     * @param	mixed
     * @return	void
     */
    public function helper($helpers = array())
    {
        foreach ($this->_ci_prep_filename($helpers, '_helper') as $helper)
        {
            if (isset($this->_ci_helpers[$helper]))
            {
                continue;
            }

            $ext_helper = APPPATH.'helpers/'.config_item('subclass_prefix').$helper.'.php';

            // Is this a helper extension request?
            if (file_exists($ext_helper))
            {
                $base_helper = BASEPATH.'helpers/'.$helper.'.php';

                if ( ! file_exists($base_helper))
                {
                    show_error('Unable to load the requested file: helpers/'.$helper.'.php');
                }

                include_once($ext_helper);
                include_once($base_helper);
                $this->_ci_helpers[$helper] = TRUE;
                log_message('debug', 'Helper loaded: '.$helper);
                continue;
            }

            // Try to load the helper
            foreach ($this->_ci_helper_paths as $path)
            {
                if (file_exists($path.'helpers/'.$helper.'.php'))
                {
                    include_once($path.'helpers/'.$helper.'.php');

                    $this->_ci_helpers[$helper] = TRUE;
                    log_message('debug', 'Helper loaded: '.$helper);
                    break;
                }
            }

            // unable to load the helper
            if ( ! isset($this->_ci_helpers[$helper]))
            {
                show_error('Unable to load the requested file: helpers/'.$helper.'.php');
            }
        }
    }
}

/* End of file Loader.php */
/* Location: ./system/core/Loader.php */