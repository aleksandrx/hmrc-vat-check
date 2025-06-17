<?php

namespace PatrixshahUKVatChecker\HmrcVatCheck\Services;

use Illuminate\Support\Facades\Http;

class HmrcVatService
{
    private $clientId;
    private $clientSecret;
    private $oauth2Url;
    private $grantType;
    private $scope;
    private $checkVatNumberUrl;

    public function __construct()
    {
        // $this->clientId = env('HMRC_CLIENT_ID');
        // $this->clientSecret = env('HMRC_CLIENT_SECRET');

        $this->clientId = config('hmrc_vat.client_id');
        $this->clientSecret = config('hmrc_vat.client_secret');
        $this->oauth2Url = config('hmrc_vat.oauth2_url');
        $this->grantType = config('hmrc_vat.grant_type');
        $this->scope = config('hmrc_vat.scope');
        $this->checkVatNumberUrl = config('hmrc_vat.check_vat_number_url');
    }

    /**
     * Get an access token from HMRC.
     *
     * @return string
     * @throws \Exception
     */
    private function getAccessToken()
    {
        $response = Http::asForm()->post($this->oauth2Url, [
            'grant_type' => $this->grantType,
            'client_id' => $this->clientId,
            'client_secret' => $this->clientSecret,
            'scope' => $this->scope,
        ]);

        if ($response->successful()) {
            return $response->json()['access_token'];
        }
        throw new \Exception('Error obtaining access token: ' . $response->body());
    }

    /**
     * Check a VAT number using HMRC's API.
     *
     * @param string $vatNumber
     * @return array
     * @throws \Exception
     */
    public function checkVatNumber($vatNumber)
    {
        $accessToken = $this->getAccessToken();
        $response = Http::withToken($accessToken)
            ->accept('application/vnd.hmrc.2.0+json')
            ->get("{$this->checkVatNumberUrl}/$vatNumber");
        if ($response->successful()) {
            return $response->json();
        }
        throw new \Exception('Error checking VAT number: ' . $response->body());
    }
}
