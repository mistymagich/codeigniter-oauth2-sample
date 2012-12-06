<?php
require_once APPPATH . 'third_party/oauth2-server-php/src/OAuth2/Autoloader.php';

class oauth2 extends CI_Controller
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

    public function authorize()
    {
        switch ($this->input->server('REQUEST_METHOD')) {
        case 'GET':
            // リクエストチェック
            $params = $this->_server->validateAuthorizeRequest($this->_request);

            if (!$params) {
                $this->_server->getResponse();
            } else {
                $this->load->view('oauth2', $params);
            }
            break;
        case 'POST':
            /*
             * ここで認証処理
             */
            // 認証処理の結果、ユーザIDが決定
            $userid = 1;

            // 認可応答
            $authorized = (bool) $this->input->post('authorize');
            $response = $this->_server->handleAuthorizeRequest($this->_request, $authorized, $userid);
            $location = $response->getHttpHeader('Location');
            header("Location: $location");
            break;
        }
    }

    public function access_token()
    {
        $this->_server->handleGrantRequest($this->_request)->send();
    }
}
