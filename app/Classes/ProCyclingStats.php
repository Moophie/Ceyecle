<?php
namespace App\Classes;

use Illuminate\Support\Facades\Http;
use Goutte\Client;

class ProCyclingStats
{
    public static function getRaceInfo($race_name)
    {
        $race = [];
        $url = "https://www.procyclingstats.com/race/giro-d-italia/2021/gc/overview";
        $client = new Client();
        $crawler = $client->request('GET', $url);
        $race['name'] = $crawler->filter('.page-title h1')->text();
        $race['startdate'] = $crawler->filter('.infolist li div:nth-of-type(2)')->eq(0)->text();
        $race['enddate'] = $crawler->filter('.infolist li div:nth-of-type(2)')->eq(1)->text();

        return $race;
    }
}
