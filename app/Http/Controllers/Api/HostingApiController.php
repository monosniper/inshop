<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Services\Hosting;
use App\Models\Domain;
use Illuminate\Http\Request;

class HostingApiController extends Controller
{
    public function registerDomain(Request $request, Hosting $hostingApi) {
        $domain = Domain::create([
            'user_id' => $request->user_id,
            'name' => $request->domain,
        ]);

        return response()->json(['result' => (bool)$domain]);
//        return $hostingApi->registerSubDomain($request->domain, $request->user_id);
    }

    public function checkDomain(Request $request, Hosting $hostingApi) {
        return $hostingApi->checkSubDomainAvailability($request->domain);
    }
}
