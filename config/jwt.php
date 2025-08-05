<?php

return [

    'secret' => env('JWT_SECRET'),

    'ttl' => 60, // Token berlaku 60 menit

    'refresh_ttl' => 20160, // Waktu untuk refresh token (14 hari)

    'algo' => 'HS256',

    'blacklist_enabled' => true,

    'blacklist_grace_period' => 0, // langsung diblacklist saat logout

    'providers' => [
        'jwt' => Tymon\JWTAuth\Providers\JWT\Lcobucci::class,
        'auth' => Tymon\JWTAuth\Providers\Auth\Illuminate::class,
        'storage' => Tymon\JWTAuth\Providers\Storage\Illuminate::class,
    ],
];
