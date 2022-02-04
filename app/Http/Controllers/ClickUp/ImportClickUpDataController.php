<?php

namespace App\Http\Controllers\ClickUp;

use App\Models\User;
use App\Models\ClickupTeam;
use App\Models\ClickupSpace;
use App\Http\Controllers\Controller;
use App\Services\ClickUp\ClickUpApiWrapper;

class ImportClickUpDataController extends Controller
{
    protected $clickUpApiWrapper;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->clickUpApiWrapper = new ClickUpApiWrapper();
    }

    /**
     * Import data
     *
     */
    public function import()
    {
        $users = User::all();
        $team  = ClickupTeam::findOrFail(env('CLICKUP_TEAM_ID'));

        if (!empty($users) && !empty($team)) {
            foreach ($users as $user) {

                # Get and/or create all spaces
                $response = $this->clickUpApiWrapper->getSpaces($user->clickup_api_token, $team->team_id);

                if (!empty($response)) {
                    foreach ($response as $spaces) {
                        foreach ($spaces as $space) {
                            if (empty(ClickupSpace::where('space_id', $space->id)->first())) {

                                $newSpace           = new ClickupSpace;
                                $newSpace->space_id = $space->id;
                                $newSpace->name     = $space->name;
                                $newSpace->save();
                            }
                        }
                    }
                }

            }
        }

        # Get and/or create all folders

        # Get and/or create all lists

        # Get and/or create all tasks
    }
}
