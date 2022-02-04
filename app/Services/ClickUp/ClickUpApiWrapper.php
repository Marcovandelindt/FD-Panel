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
}
