<?php

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/
Broadcast::channel('App.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('Chat.{profile_id}.{friend_id}', function ($user, $profile_id, $friend_id) {
    return $user->profile_id == $friend_id;
});

//Broadcast::channel('Online', function ($user) {
//    return \App\Profile::find($user->profile_id);
//});

Broadcast::channel('Online', function ($user) {
    return $user;
});