<?php
namespace Jmxu\PhpSampleProject\App;

use Dotenv\Dotenv;
use \Exception;

class App {
    public $sitename;
    private $env_path;
    protected $config;

    public function __construct()
    {
        $this -> loadConfig();
    }
    private function loadConfig() 
    {
        // get current working directory
        $this -> env_path = getcwd();
        // load site configuration from .env
        $this -> config = Dotenv::createImmutable( $this -> env_path );
        try {
            // try to load the .env file
            $this -> config -> load();
            $this -> setSiteName();
        }
        catch( Exception $exc ) {
            // there is an error loading the .env file
            error_log( $exc -> getMessage() );
            echo "something went wrong";
        }
    }
    public function setSiteName() {
        print_r($this -> config);
    }
}

?>