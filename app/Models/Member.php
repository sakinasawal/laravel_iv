<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $table = 'tblMembers';

    protected $fillable = [
        'MemberID', 'Name', 'DateJoin', 'TelM', 'Email', 'BirthDate', 'ParentID'
    ];

    public function purchases()
    {
        return $this->hasMany(Purchase::class, 'MemberID');
    }

}
