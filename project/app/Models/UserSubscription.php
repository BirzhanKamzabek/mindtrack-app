<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class UserSubscription extends Model
{
    protected $table = 'user_subscriptions';
    protected $fillable = ['plan_id','user_id','status','started_at','expired_at'];
    public function user()
    {
        return $this->belongsTo(User::class)->select('id','name','display_name','image');
    }
    public function subscription()
    {
        return $this->belongsTo(SubscriptionPlans::class,'plan_id');
    }

    public function isActive()
    {
        $now = Carbon::now();
        return $this->expired_at > $now;
    }
}
