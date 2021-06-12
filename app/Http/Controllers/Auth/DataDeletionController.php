<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DataDeletionController extends Controller
{
    public function dataDeletionCallback(Request $request)
    {
        $signed_request = $request->get('signed_request');
        $data = $this->parse_signed_request($signed_request);
        $user_id = $data['user_id'];

        User::where('provider_id', $user_id)->first()->delete();

        $confirmation_code = rand(0, 100); // unique code for the deletion request
        $status_url = 'https://www.ceyecle.test/deletion?id=' . $confirmation_code; // URL to track the deletion
        $data = array(
            'url' => $status_url,
            'confirmation_code' => $confirmation_code
        );

        Log::info(json_encode($data));
        return response()->json_encode($data);
    }


    public function parse_signed_request($signed_request)
    {
        list($encoded_sig, $payload) = explode('.', $signed_request, 2);

        $secret = env('FACEBOOK_CLIENT_SECRET');

        // decode the data
        $sig = $this->base64_url_decode($encoded_sig);
        $data = json_decode($this->base64_url_decode($payload), true);

        // confirm the signature
        $expected_sig = hash_hmac('sha256', $payload, $secret, $raw = true);
        if ($sig !== $expected_sig) {
            error_log('Bad Signed JSON signature!');
            return null;
        }

        return $data;
    }

    public function base64_url_decode($input)
    {
        return base64_decode(strtr($input, '-_', '+/'));
    }
}
