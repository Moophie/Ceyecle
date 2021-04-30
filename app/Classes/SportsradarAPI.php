<?php
namespace App\Classes;

use Illuminate\Support\Facades\Http;

class SportsradarAPI
{
    public static function getSeasonEvents()
    {
        $base_url = 'https://api.sportradar.us/cycling/trial/v2/nl/';

        // First get this season's id
        $response = Http::get($base_url . 'seasons.json?api_key=' . env('SPORTSRADAR_API_KEY'));

        // 0 for men's season, 1 for women's season
        $currentSeasonId = $response['stages'][0]['id'];

        // Then get all the events
        // Wait a second before doing the next call
        sleep(1);
        $response = Http::get($base_url . 'sport_events/' . $currentSeasonId . '/schedule.json?api_key=' . env('SPORTSRADAR_API_KEY'))->json();
        return $response['stages'];
    }

    public static function getCyclerInfo($competitor_id)
    {
        $url = 'https://api.sportradar.us/cycling/trial/v2/nl/competitors/' . $competitor_id . '/profile.json?api_key=' . env('SPORTSRADAR_API_KEY');
    }

    public static function getEventInfo($event_id)
    {
        $url = 'https://api.sportradar.us/cycling/trial/v2/nl/sport_events/' . $event_id . '/summary.json?api_key=' . env('SPORTSRADAR_API_KEY');
        $response = Http::get($url)->json();
        return $response;
    }
}
