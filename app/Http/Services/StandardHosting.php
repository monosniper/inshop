<?php

namespace App\Http\Services;

use App\Http\Contracts\Hosting;
use App\Models\Domain;
use App\Models\User;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class StandardHosting implements Hosting
{
    public function checkSubDomainAvailability($name): bool
    {
        return true;
    }

    public function registerSubDomain($name, $user_id)
    {
        $limit = (int)setting('limits.domains');
        $user = User::findOrFail($user_id);
        $domains_limit = $user->loadCount('domains')->domains_count >= $limit;
        abort_if($domains_limit,
            ResponseAlias::HTTP_BAD_REQUEST,
            'Максимальное количество доменных имен уже достигнуто ('.$limit.').'
        );

        abort_unless($name, Response::HTTP_BAD_REQUEST, 'Недопустимое имя домена');

        $exists = Domain::where('name', $name)->exists();

        abort_if($exists, Response::HTTP_BAD_REQUEST, 'Домен с таким именем уже зарегистрирован');

        return Domain::create([
            'name' => $name,
            'user_id' => $user_id,
        ]);
    }

    public function deleteSubDomain($domain_id)
    {
        return Domain::findOrFail($domain_id)->delete();
    }

    public function addDnsRecordToSubdomain($name) {}
}
