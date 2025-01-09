<?php

namespace PagBankApi\Service;

use PagBankApi\Entity\Connect\AccessToken;
use PagBankApi\Entity\Connect\Application;
use PagBankApi\Entity\Connect\ConnectAuthorization;
use PagBankApi\Entity\Connect\RequestToken;
use PagBankApi\Http\PagBankHttpClient;

class PagBankConnectService extends AbstractService
{
    public function generateUrlConnectAuthorization(ConnectAuthorization $params): string
    {
        return $this->config->getBaseUrlConnect() . '/oauth2/authorize?' . $params->buildQueryParams();
    }

    public function getApplication(string $client_id): Application
    {
        return (new Application())->populateByArray($this->httpClient->getRequest("/oauth2/application/{$client_id}")->getContent());
    }

    public function createApplication(Application $application): Application
    {
        return (new Application())->populateByArray($this->httpClient->postRequest('/oauth2/application', $application)->getContent());
    }

    public function createAccessToken(string $client_id, string $client_secret, RequestToken $requestToken): AccessToken
    {
        $response = $this->httpClient->sendRequest(PagBankHttpClient::HTTP_POST, '/oauth2/token', $requestToken, [
            'X_CLIENT_ID' => $client_id,
            'X_CLIENT_SECRET' => $client_secret,
        ]);

        return (new AccessToken())->populateByArray($response->getContent());
    }

    public function refreshAccessToken(string $client_id, string $client_secret, string $refresh_token): AccessToken
    {
        $response = $this->httpClient->sendRequest(PagBankHttpClient::HTTP_POST, '/oauth2/refresh', [
            'grant_type' => 'refresh_token',
            'refresh_token' => $refresh_token,
        ], [
            'X_CLIENT_ID' => $client_id,
            'X_CLIENT_SECRET' => $client_secret,
        ]);

        return (new AccessToken())->populateByArray($response->getContent());
    }

    /**
     * @param 'access_token'|'refresh_token' $token_type_hint
     */
    public function revokeAccessToken(string $client_id, string $client_secret, string $token_type_hint, string $token): bool
    {
        if (!in_array($token_type_hint, ['access_token', 'refresh_token'])) {
            throw new \InvalidArgumentException("Invalid 'token_type_hint' must be 'access_token' or 'refresh_token'.");
        }

        $response = $this->httpClient->sendRequest(PagBankHttpClient::HTTP_POST, '/oauth2/revoke', [
            'token_type_hint' => $token_type_hint,
            'token' => $token,
        ], [
            'X_CLIENT_ID' => $client_id,
            'X_CLIENT_SECRET' => $client_secret,
        ]);

        return $response->isSuccess();
    }
}
