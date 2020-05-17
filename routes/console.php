<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

// quickly create an user via the command line
// Use: in console type: php artisan user:create
Artisan::command('user:create', function () {
    $name = $this->ask('Name?');
    $email = $this->ask('Email?');
    $pwd = $this->ask('Password?');

    $user = new \App\User();
    $user->name = $name;
    $user->email = $email;
    $user->password = bcrypt($pwd);
    $user->save();

    $this->info('Account created for '.$name);
});

Artisan::command('user:createdefault', function () {

    $user = new \App\User();
    $user->name = "Weborganiser";
    $user->email = "admin@vandoorn.local";
    $user->password = bcrypt("password");
    $user->save();

    $this->info('Account created for Weborganiser');
});


Artisan::command('hecto:sync', function () {

    $client = new \App\Http\Controllers\HectometerApiController();
    $client->syncHectoBorden();

    $this->info('Hectometerborden aan het synchroniseren...');
});

Artisan::command('ultimo:sync', function () {

    $client = new \App\Http\Controllers\UltimoApiController();
    $client->getGebreken();

    $this->info('Ultimo is aan het synchroniseren...');
});

Artisan::command('cssversion:update', function () {
    //Delete old versions
    Cache::forget('JsCssVersion');

    //Add new version
    Cache::forever('JsCssVersion', time());
});
