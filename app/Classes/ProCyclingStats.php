<?php
namespace App\Classes;

use Illuminate\Support\Facades\Http;
use Goutte\Client;
use Symfony\Component\DomCrawler\Crawler;

class ProCyclingStats
{

    const BASE_URL = "https://www.procyclingstats.com/";

    public static function getAllRaces()
    {
        $url = self::BASE_URL . "races.php";
        $client = new Client();
        $crawler = $client->request('GET', $url);

        $races = $crawler->filter('.basic tbody tr')->each(function (Crawler $node, $i) {
            $race['name'] = $node->filter('td:nth-of-type(3) a')->text();
            $race['pcs_url'] = str_replace("/startlist/preview", "", $node->filter('td:nth-of-type(3) a')->attr('href'));
            $race['class'] = $node->filter('td:last-of-type')->text();

            return $race;
        });

        return $races;
    }

    public static function getRaceInfo($class, $race_url)
    {
        $gc_result = "/result";

        if($class === "2.UWT"){
            $gc_result = "/gc";
        }
        
        $url = self::BASE_URL . $race_url . $gc_result . "/overview";
        $client = new Client();
        $crawler = $client->request('GET', $url);
        $race_info['startdate'] = $crawler->filter('.infolist li div:nth-of-type(2)')->eq(0)->text();
        $race_info['enddate'] = $crawler->filter('.infolist li div:nth-of-type(2)')->eq(1)->text();

        return $race_info;
    }

    public static function getAllTeams()
    {
        $url = self::BASE_URL . "teams.php";
        $client = new Client();
        $crawler = $client->request('GET', $url);

        $teams = $crawler->filter('.mob_columns1 a')->each(function (Crawler $node, $i) {
            $team['name'] = $node->text();
            $team['pcs_url'] = $node->attr('href');

            return $team;
        });

        return $teams;
    }

    public static function getTeamInfo($team_url)
    {
        $url = self::BASE_URL . "team/" . $team_url;
        $client = new Client();
        $crawler = $client->request('GET', $url);

        return "";
    }


}
