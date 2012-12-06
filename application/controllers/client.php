<?php

class client extends CI_Controller
{
    private $_provider;

    public function __construct()
    {
        parent::__construct();

        $this->load->helper('url_helper');
        $this->load->spark('oauth2/0.4.0');

        $this->_provider = $this->oauth2->provider('example', array(
            'id' => 'demoapp',
            'secret' => 'demopass',
            'redirect_uri' => site_url().'client/'
        ));
    }

    public function index()
    {
        $data = array(
            'auth_url' => null,
            'access_token' => null
        );

        if (!$this->input->get('code')) {
            $data['auth_url'] = $this->_provider->authorize();
        } else {
            try {
                // アクセストークンの取得
                $token = $this->_provider->access($this->input->get('code'));

                // アクセストークン
                $access_token = $token->access_token;
                $data['access_token'] = $access_token;

                /*
                 *以後使えるように保存しておく
                 */

                // 保存していおいたアクセストークンを使ってAPIアクセス
                $token = OAuth2_Token::factory('access', array('access_token' => $access_token));
                $friends = $this->_provider->get_friends($token);
                $data['friends'] = $friends;
            } catch (OAuth2_Exception $e) {
                show_error($e->getMessage());
            } catch (Exception $e) {
                show_error($e->getMessage());
            }
        }

        $this->load->view('client', $data);
    }
}
