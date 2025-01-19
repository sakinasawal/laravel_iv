<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $table = 'tblPurchases';

    protected $fillable = [
        'BillNo', 'MemberID', 'SalesDate', 'Amount'
    ];

    public function member()
    {
        return $this->belongsTo(Member::class, 'MemberID');
    }

}
