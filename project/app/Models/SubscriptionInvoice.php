<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscriptionInvoice extends Model
{
    protected $table = 'invoices';
    protected $fillable = ['user_id','plan_id','days','payment_date','expired_at','transaction_id'];
    public function user()
    {
        return $this->belongsTo(User::class)->select('id','name','display_name','image');
    }
    public function subscription()
    {
        return $this->belongsTo(SubscriptionPlans::class,'plan_id');
    }
}
