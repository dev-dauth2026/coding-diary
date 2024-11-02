<?php

use Illuminate\Support\Facades\Broadcast;
use Illuminate\Foundation\Auth\User;

// Channel for regular users
Broadcast::channel('App.Models.User.{id}', function (User $user, $id) {
    return $user->id === (int) $id && !$user->isAdmin();
}, ['guards' => ['web']]);

// Channel for admin users
Broadcast::channel('App.Models.Admin.{id}', function (User $admin, $id) {
    return (int) $admin->id === (int) $id && $admin->isAdmin();
}, ['guards' => ['admin']]);
