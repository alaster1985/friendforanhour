<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class Ban extends Model
{
    protected $fillable = [
        'profile_id',
        'reason',
        'moderator_id_beginner',
        'duration',
        'moderator_id_amnesty',
        'reason_amnesty',
        'ban_end_date',
    ];

    public function profile()
    {
        return $this->belongsTo('App\Profile');
    }

    public function getShortDesc()
    {
        return Str::limit($this->reason, 255, '...');
    }

    public function userBeginner()
    {
        return $this->belongsTo('App\User', 'moderator_id_beginner');
    }

    public function userAmnesty()
    {
        return $this->belongsTo('App\User', 'moderator_id_amnesty');
    }

    public static function checkBanTime($profileId)
    {
        if (!isset(Ban::where('profile_id', $profileId)->get()->last()->id)) {
            return false;
        }
        return Ban::where('profile_id', $profileId)->get()->last()->ban_end_date <= strtotime('now') ? false : true;
    }

    public static function setBanTimeByProfileId($duration, $profileId)
    {
        if (self::checkBanTime($profileId)) {
            return strtotime('+' . $duration . ' hours',
                Ban::where('profile_id', $profileId)->get()->last()->ban_end_date);
        }
        return strtotime('+' . $duration . ' hours');
    }

    public static function updateBan($data)
    {
        $currentBan = Ban::find($data->id);
        $currentBan->reason = $data->reason;
        if (isset($data->reason_amnesty)) {
            $currentBan->moderator_id_amnesty = Auth::id();
            $currentBan->reason_amnesty = $data->reason_amnesty;
            $currentBan->ban_end_date = strtotime('now');
        }
        $currentBan->save();
    }

    public static function getBanList($param)
    {
        switch ($param) {
            case 'all':
                return Ban::all()->sortByDesc('created_at');
                break;
            case 'current':
                return Ban::all()->where('ban_end_date', '>=', strtotime('now'))->sortByDesc('created_at');
                break;
            case 'expired':
                return Ban::all()->where('ban_end_date', '<', strtotime('now'))->sortByDesc('created_at');
                break;
            default:
                return Ban::all()->sortByDesc('created_at');
                break;
        }
    }
}
