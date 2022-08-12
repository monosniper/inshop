<?php

namespace App\Http\Services;

use App\Http\Contracts\Hosting as HostingInterface;
use App\Models\Domain;

class Hosting
{
    private HostingInterface $hostingService;

    public function __construct(HostingInterface $hostingService) {
        $this->hostingService = $hostingService;
    }

    public function checkSubDomainAvailability($name)
    {
        return $this->hostingService->checkSubDomainAvailability($name);
    }

    public function addDnsRecordToSubdomain($name) {
        return $this->hostingService->addDnsRecordToSubdomain($name);
    }

    public function deleteSubDomain($domain_id) {
        return $this->hostingService->deleteSubDomain($domain_id);
    }

    public function registerSubDomain($name, $user_id)
    {
        $request = $this->hostingService->registerSubDomain($name);

        if($request['result']) {
            $host_id = $request['response']['host_id'];

            $domain = Domain::create([
                'id' => $host_id,
                'user_id' => $user_id,
                'name' => $name,
            ]);

            if($domain) {
                $this->hostingService->addDnsRecordToSubdomain($name);
            } else {
                $this->hostingService->deleteSubDomain($host_id);
            }
        }

        return $request;
    }
}
