<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['category','created_by'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function leaveRequest(){
        return $this->hasMany(LeaveRequest::class);
    }
}
