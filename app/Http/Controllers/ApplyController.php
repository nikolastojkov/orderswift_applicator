<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ApplyController extends Controller
{
    private string $apiEndpoint = "https://apply.orderswift.com";

    /**
     * Handle the apply process through the form.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function apply(Request $request)
    {
        $token = $this->getToken();

        $response = Http::post($this->apiEndpoint . '/application', [
            'token' => $token,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'country' => $request->country,
            'github_username' => $request->github,
            'cv_url' => $request->cv_url,
            'introduction' => $request->introduction,
        ])->collect();

        return response()->json([
            'status' => $response['status']
        ]);
    }

    private function getToken(): string
    {
        $response = Http::get($this->apiEndpoint . '/token');
        $token = $response->collect();

        return $token['token'];
    }
}
