<?php
namespace App\Classes;

use App\Models\Team;
use DateTime;
use Illuminate\Support\Facades\Http;
use Goutte\Client;
use Symfony\Component\DomCrawler\Crawler;
use App\Classes\HelperFunctions;
use Exception;
use Illuminate\Support\Facades\Log;

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

        if ($class === "2.UWT") {
            $gc_result = "/gc";
        }
        
        $url = self::BASE_URL . $race_url . $gc_result . "/overview";
        $client = new Client();
        $crawler = $client->request('GET', $url);
        $race_info['startdate'] = $crawler->filter('.infolist li div:nth-of-type(2)')->eq(0)->text();
        $race_info['enddate'] = $crawler->filter('.infolist li div:nth-of-type(2)')->eq(1)->text();

        $race_info['competing_teams'] = $crawler->filter('.mg_rp5 a')->each(function (Crawler $node, $i) {
            $race_info['competing_teams'][$i]['pcs_url'] = $node->attr('href');

            return $race_info['competing_teams'][$i];
        });

        $race_info['previous_winners'] = $crawler->filter('.list.fs14')->eq(4)->filter('li')->each(function (Crawler $node, $i) {
            $year_string = $node->filter('.mg_rp10 a')->text() . "-01-01";
            $race_info['previous_winners'][$i]['year'] = DateTime::createFromFormat('Y-m-d', $year_string);
            $race_info['previous_winners'][$i]['fullname'] = $node->filter('.mg_rp10 + div a')->text();

            return $race_info['previous_winners'][$i];
        });

        try {
            $race_info['event_map_picture'] = self::BASE_URL . $crawler->filter('.basic img')->attr('src');
        } catch (Exception $e) {
            $race_info['event_map_picture'] = 'images/event_map_placeholder.png';
        }

        try {
            $race_info['logo'] = self::BASE_URL . $crawler->filter('.infolist li div:nth-of-type(2) img')->attr('src');
        } catch (Exception $e) {
            $race_info['logo'] = 'images/logo_placeholder.png';
        }
        

        return $race_info;
    }

    public static function getStagesFromRace($race_url)
    {
        $url = self::BASE_URL . $race_url . "/gc/overview";
        $client = new Client();
        $crawler = $client->request('GET', $url);
        $stages = $crawler->filter('.pad2 a')->each(function (Crawler $node, $i) {
            $stage['name'] = $node->text();
            $stage['pcs_url'] = $node->attr('href');

            return $stage;
        });

        return $stages;
    }

    public static function getStageInfo($stage_url)
    {
        $url = self::BASE_URL . $stage_url;
        $client = new Client();
        $crawler = $client->request('GET', $url);

        $timeInText = $crawler->filter('.infolist li div:nth-of-type(2)')->eq(0)->text();

        $stage_info['date'] = DateTime::createFromFormat('d M Y, H:i', $timeInText);
        if($stage_info['date'] == false){
            $stage_info['date'] = DateTime::createFromFormat('d M Y', $timeInText);
        }
       
        $type_string = $crawler->filter('.icon.profile')->attr('class');
        $type_p = substr($type_string, -2);
        $stage_info['type'] = '';

        switch ($type_p) {
            case 'p1':
                $stage_info['type'] = 'plat';
                break;
            case 'p2':
                $stage_info['type'] = 'heuvelachtig';
                break;
            case 'p3':
                $stage_info['type'] = 'zeer heuvelachtig';
                break;
            case 'p4':
                $stage_info['type'] = 'bergachtig';
                break;
            case 'p5':
                $stage_info['type'] = 'zeer bergachtig';
                break;
            default:
                $stage_info['type'] = 'onbekend';

        }

        $stage_info['departure'] = $crawler->filter('.infolist li div:nth-of-type(2)')->eq(5)->text();
        $stage_info['arrival'] = $crawler->filter('.infolist li div:nth-of-type(2)')->eq(6)->text();

        $distance_string = $crawler->filter('.infolist li div:nth-of-type(2)')->eq(7)->text();
        $distance_string= explode(' ', $distance_string, 2);
        $stage_info['distance'] = (int)$distance_string[0];

        $url = self::BASE_URL . $stage_url . '/today/profiles';
        $client = new Client();
        $crawler = $client->request('GET', $url);
        try {
            $stage_info['profile_img'] = self::BASE_URL . $crawler->filter('.basic img')->eq(0)->attr('src');
        } catch (Exception $e) {
            $stage_info['profile_img'] = 'images/stage_placeholder.png';
        }

        return $stage_info;
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
        $url = self::BASE_URL . $team_url;
        $client = new Client();
        $crawler = $client->request('GET', $url);
        $nationality_class_string = $crawler->filter('.main .flag')->attr('class');
        $team_info['nationality'] = HelperFunctions::get_string_between($nationality_class_string, 'flag ', ' w');

        return $team_info;
    }

    public static function getRidersFromTeam($team_url)
    {
        $url = self::BASE_URL . $team_url;
        $client = new Client();
        $crawler = $client->request('GET', $url);
        $riders = $crawler->filter('.ttabs.tabb a')->each(function (Crawler $node, $i) {
            $fullname = $node->text();
            $fullname = explode(' ', $fullname, 2);
            $rider['firstname'] = $fullname[1];
            $rider['lastname'] = $fullname[0];
            $rider['pcs_url'] = $node->attr('href');

            return $rider;
        });

        return $riders;
    }

    public static function getRiderInfo($rider_url)
    {
        $url = self::BASE_URL . $rider_url;
        $client = new Client();
        $crawler = $client->request('GET', $url);

        $rider_overview = $crawler->filter('.rdr-info-cont')->text();
        $dob_string = HelperFunctions::get_string_between($rider_overview, 'Date of birth: ', ' (');
        $rider_info['dob'] = DateTime::createFromFormat('dS M Y', $dob_string)->format('Y-m-d');

        $age_string = HelperFunctions::get_string_between($rider_overview, '(', ')');
        $rider_info['age'] = (int)$age_string;
        $rider_info['height'] = (float)HelperFunctions::get_string_between($rider_overview, 'Height: ', ' mPlace');
        $rider_info['weight'] = (int)HelperFunctions::get_string_between($rider_overview, 'Weight: ', ' kg');
        $rider_info['uci_wr'] = (int)HelperFunctions::get_string_between($rider_overview, 'UCI World Ranking', ' Visits');

        try {
            $rider_info['picture'] = self::BASE_URL . $crawler->filter('.rdr-img-cont img')->attr('src') ;
        } catch (Exception $e) {
            $rider_info['picture'] = 'images/rider_placeholder.png';
        }
        
        $rider_info['nationality'] = $crawler->filter('.rdr-info-cont a:nth-of-type(1)')->text();

        return $rider_info;
    }

    public static function getLiveRanking($stage_url){
        $url = self::BASE_URL . $stage_url . "/today/livestats";
        $client = new Client();
        $crawler = $client->request('GET', $url);
        $top_25_riders = $crawler->filter('.riders2 .name a')->each(function (Crawler $node, $i) {
            $top_25_rider['name'] = $node->text();

            return $top_25_rider;
        });

        return $top_25_riders;
    }
}
