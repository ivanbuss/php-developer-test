<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Profile extends Model
{

    protected $primaryKey = 'profile_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'first_name', 'last_name', 'gender', 'father_id', 'mother_id', 'partner_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];

    public function user() {
        return $this->hasOne('App\User', 'id', 'user_id');
    }

    public function father() {
        return $this->hasOne('App\User', 'id', 'father_id');
    }

    public function mother() {
        return $this->hasOne('App\User', 'id', 'mother_id');
    }

    public function partner() {
        return $this->hasOne('App\User', 'id', 'partner_id');
    }

    public function children() {
        return User::join('profiles', 'profiles.user_id', '=', 'users.id')->where('profiles.father_id', $this->user_id)->orWhere('profiles.mother_id', $this->user_id);
    }

    public function isChild(User $user) {
        if ($this->father_id == $user->id || $this->mother_id == $user->id) return TRUE;
            else return FALSE;
    }

    public function isPartner(User $user) {
        if ($user->profile->partner_id == $this->user_id || $this->partner_id == $user->id) return TRUE;
            else return FALSE;
    }

    public function isParent() {
        $relateProfiles = self::where('father_id', $this->user_id)->orWhere('mother_id', $this->user_id)->count();
        if ($relateProfiles > 0) return TRUE;
            else return FALSE;
    }

    public function updatePartner() {
        $partner = $this->partner;
        if ($partner) {
            $partner->profile->update(['partner_id' => $this->user_id]);
        }
    }

    public function updateChildren(array $children) {
        $user = $this->user;
        foreach($children as $child) {
            if ($child) {
                $childUser = User::with('profile')->find($child);
                if (!$user->gender || $user->gender == 1) $childUser->profile->update(['father_id'=>$user->id]);
                else $childUser->profile->update(['mother_id'=>$user->id]);
            }
        }
    }
}
