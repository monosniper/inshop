<?php

namespace App\Http\Contracts;

use App\Models\Domain;

interface Hosting {
    public function checkSubDomainAvailability($name);
    public function registerSubDomain($name);
    public function deleteSubDomain($domain_id);
    public function addDnsRecordToSubdomain($name);
}
