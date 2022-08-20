<?php

namespace App\Http\Contracts;

use App\Models\Domain;

interface Hosting {
    public function checkSubDomainAvailability($name) : bool;
    public function registerSubDomain($name, $user_id);
    public function deleteSubDomain($domain_id);
    public function addDnsRecordToSubdomain($name);
}
