<?php
// This is like the router which match the url to the different controllers

// App Core Class
// Creates URL & loads core controller
// URL FORMAT - /controller/method/params
// therefore.....$url =  explode("/", $_GET['url]); -> ['controller', 'method', 'params'];
//  $url[0] represents Controller
// $url[1] represents Method of the Controller
// $url[2] represents Param

// *** IMPORTANT TO NOTE BELOW:
// the default controller is "Page". So if "/pages"

class Core {

    protected $currentController = 'Pages'; // Default class if no additional url
    protected $currentMethod = 'index'; // Default method if no additonal url
    protected $params = [];

    public function __construct() 
    {
        // return -> the path "mvc/path/page/edit/2" -> ['path', 'page', 'edit', '2']
        $url = $this->getUrl();
        
        // 1. IDENTIFY CONTROLLER - Look in controllers for first value
        if($url != NULL) {
            if(file_exists('../app/controllers/' . ucwords($url[0]) . '.php')) {
                // if exists, set as controller
                $this->currentController = ucwords($url[0]);
                // unset element - note unset will not change the index keys of other elements
                unset($url[0]);
            }
        } 
   
        // Require the controller - from index.php in public
        require_once '../app/controllers/' . $this->currentController . '.php';

        // Instantiate controller
        $this->currentController = new $this->currentController();

        // 2. IDENTIFY METHOD - check for 2nd part (method) for $url
        if(isset($url[1])) {
            // Check if method exists in currentController
            if(method_exists($this->currentController, $url[1])) {
                $this->currentMethod = $url[1];
                // unset element
                unset($url[1]);
            }
        } 

        // 3. IDENTIFY PARAMS - get params
        $this->params = $url ? array_values($url) : [];

        // Call a callback with array of params -> call_user_func_array([class, method], [arguments of method])
        call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
    }


    public function getUrl() 
    {
        if(isset($_GET['url'])) {
            // strip the ending / if there is any
            $url = rtrim($_GET['url'], '/'); 
            // this will filter off any characters that URL should not have
            $url = filter_var($url, FILTER_SANITIZE_URL); 
            // split into an array based on seperator "/"
            $url = explode("/", $url); 
            return $url;
        }
    }
};

