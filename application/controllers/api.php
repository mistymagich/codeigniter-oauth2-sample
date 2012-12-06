<?php
require_once APPPATH . 'third_party/oauth2-server-php/src/OAuth2/Autoloader.php';

class api extends CI_Controller
{
    private $_server;
    private $_request;

    public function __construct()
    {
        parent::__construct();

        OAuth2_Autoloader::register();

        include(APPPATH.'config/database'.EXT);
        $db_config = $db['default'];
        $connection = array(
            'dsn' => sprintf(
                '%s:dbname=%s;host=%s',
                $db_config['dbdriver'],
                $db_config['database'],
                $db_config['hostname']
            ),
            'username' => $db_config['username'],
            'password' => $db_config['password']
        );
        $storage = new OAuth2_Storage_Pdo($connection);
        $this->_server = new OAuth2_Server($storage);
        $this->_server->addGrantType(new OAuth2_GrantType_UserCredentials($storage));
        $this->_request = OAuth2_Request::createFromGlobals();
    }

    public function friends()
    {
        if (!$this->_server->verifyAccessRequest($this->_request)) {
            $this->_server->getResponse()->send();
        } else {
            $response = new OAuth2_Response(array('friends' => array('friend1', 'friend2', 'friend3')));
            $response->send();
        }
    }
}
