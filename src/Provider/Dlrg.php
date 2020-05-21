<?php

namespace League\OAuth2\Client\Provider;

use League\OAuth2\Client\Provider\Exception\IdentityProviderException;
use League\OAuth2\Client\Token\AccessToken;
use League\OAuth2\Client\Tool\BearerAuthorizationTrait;
use Psr\Http\Message\ResponseInterface;

class Dlrg extends AbstractProvider {
    use BearerAuthorizationTrait;

    /**
     * @const string
     */
    const BASE_DLRG_URL = 'https://dlrg.net/oauth2';

    const ACCESS_TOKEN_RESOURCE_OWNER_ID = 'sub';

    /**
     * @param array $options
     * @param array $collaborators
     *
     * @throws \InvalidArgumentException
     */
    public function __construct($options = [], array $collaborators = []) {
        parent::__construct($options, $collaborators);
    }

    public function getBaseAuthorizationUrl() {
        return static::BASE_DLRG_URL . '/authorize';
    }

    public function getBaseAccessTokenUrl(array $params) {
        return static::BASE_DLRG_URL . '/token';
    }

    public function getDefaultScopes() {
        return ['profile', 'email'];
    }

    public function getScopeSeparator() {
        return ' ';
    }

    public function getAccessToken($grant = 'authorization_code', array $params = []) {
        return parent::getAccessToken($grant, $params);
    }

    public function getResourceOwnerDetailsUrl(AccessToken $token) {
        return static::BASE_DLRG_URL . '/userinfo';
    }

    protected function createResourceOwner(array $response, AccessToken $token) {
        return new DlrgUser($response);
    }

    protected function checkResponse(ResponseInterface $response, $data) {
        if (!empty($data['error'])) {
            $message = $data['error'] . ': ' . $data['error_description'];
            throw new IdentityProviderException($message, 42, $data);
        }
    }
}
