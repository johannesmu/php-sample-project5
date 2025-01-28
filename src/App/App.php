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
        $this -> setAppMode();
        $this -> setSiteName();
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
        }
        catch( Exception $exc ) {
            // there is an error loading the .env file
            error_log( $exc -> getMessage() );
            $this -> killApp("Configuration file is missing");
        }
    }
    private function setSiteName() {
        try {
            if( $_ENV['SITENAME'] ) {
                $this -> sitename = $_ENV['SITENAME'];
            }
            else  {
                throw new Exception("value not available");
            }
        }
        catch( Exception $exc ) {
            error_log($exc -> getMessage() );
        }
    }
    private function setAppMode() 
    {
        try {
            $site_mode = $_ENV['MODE'];
            if( !$site_mode ) {
                throw new Exception("mode is not specified");
            }
        }
        catch( Exception $exc ) {
            error_log( $exc -> getMessage() );
            $this -> killApp("running mode not set");
        }
    }
    private function killApp( $msg ) {
        exit($msg);
    }
}

?>