<?php
/**
 * Example OAuth2 Provider
 *
 * @package    CodeIgniter/OAuth2
 * @category   Provider
 */

class OAuth2_Provider_Example extends OAuth2_Provider
{
    protected $method = 'POST';

    public function url_authorize()
    {
        return site_url() . 'oauth2/authorize';
    }

    public function url_access_token()
    {
        return site_url() . 'oauth2/access_token';
    }

    public function get_friends(OAuth2_Token_Access $token)
    {
        $url = site_url() . 'api/friends?' . http_build_query(array('access_token' => $token->access_token));
        $response = file_get_contents($url);
        $data = json_decode($response);

        return $data;
    }
}
