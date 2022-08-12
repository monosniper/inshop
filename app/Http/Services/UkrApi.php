<?php

namespace App\Http\Services;

use App\Helpers\HostingAPI;
use App\Http\Contracts\Hosting;
use App\Models\Domain;
use Exception;

class UkrApi implements Hosting
{
    private String $auth_token;
    private String $virtual_id;
    private String $domain_id;
    private HostingAPI $hosting;

    public function __construct() {
        $this->auth_token = config('conf.UKR_HOST_AUTH_TOKEN');
        $this->virtual_id = config('conf.UKR_HOST_VIRTUAL_ID');
        $this->domain_id = config('conf.UKR_HOST_DOMAIN_ID');

        $this->hosting =  new HostingAPI($this->auth_token);
    }

    public function makeRequest($action, $data) {
        try {
            $response = $this->hosting->apiCall($action, $data);

            return $response;
        } catch (Exception $e) {
            // В случае ошибки выведет сообщение
            return $e->getMessage();
        }
    }

    public function checkSubDomainAvailability($name)
    {
        $request = $this->makeRequest('domain/check', [
            'domain' => $name . '.'. config('app.domain'),
        ]);

        return $request;
    }

    public function registerSubDomain($name)
    {
        $request = $this->makeRequest('hosting/virtual/add_host', [
            'name' => $name,
            'virtual_domain_id' => $this->virtual_id,
        ]);

        return $request;
    }

    public function deleteSubDomain($domain_id)
    {
        $request = $this->makeRequest('hosting/virtual/delete_host', [
            'hosts_id' => [$domain_id],
        ]);

        return $request;
    }

    public function addDnsRecordToSubdomain($name) {
        $request = $this->makeRequest('dns/record_add', [
            'domain_id' => $this->domain_id,
            'type' => 'CNAME',
            'data' => config('conf.TEMPLATE_DNS_CNAME_RECORD'),
            'record' => $name,
        ]);

        return $request;
    }
}
