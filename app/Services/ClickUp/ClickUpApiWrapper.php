<?php

namespace App\Services\ClickUp;

use GuzzleHttp\Client as GuzzleClient;

class ClickUpApiWrapper
{
    const ENDPOINT = 'https://api.clickup.com/api/v2';

    /**
     * Get the teams based on a users personal access token
     *
     * @param string $apiToken
     *
     * @return mixed
     */
    public function getTeams($apiToken)
    {
        if (!empty($apiToken)) {
            $teamsEndpoint = self::ENDPOINT . '/team';

            $guzzleClient = new GuzzleClient;

            $response = $guzzleClient->request('GET', $teamsEndpoint, [
                'headers' => [
                    'Authorization' => $apiToken
                ]
            ]);

            return $response->getBody()->getContents();
        }
    }

    /**
     * Get spaces
     *
     * @param string $apiToken
     * @param int $teamId
     *
     * @return mixed
     */
    public function getSpaces($apiToken, $teamId)
    {
        if (!empty($apiToken) && !empty($teamId)) {
            $spacesEndpoint = self::ENDPOINT . '/team/' . $teamId . '/space?archived=false';

            $guzzleClient = new GuzzleClient;

            $response = $guzzleClient->request('GET', $spacesEndpoint, [
                'headers' => [
                    'Authorization' => $apiToken
                ]
            ]);

            return json_decode($response->getBody()->getContents());
        }
    }

    /**
     * Get user
     */
    public function getUser($apiToken, $teamId, $userId)
    {
        $userEndpoint = self::ENDPOINT . '/team/' . $teamId . '/user/' . $userId;

        $guzzleClient = new GuzzleClient;

        $response = $guzzleClient->request('GET', $userEndpoint, [
            'headers' => [
                'Authorization' => $apiToken,
            ]
        ]);

        return json_decode($response->getBody()->getContents());
    }
}
