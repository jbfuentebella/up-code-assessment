<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $table = 'companies';
    public $timestamps = true;

    protected $fillable = [
        'name',
    ];

    public function users()
    {
        return $this->hasManyThrough('App\Models\User', 'App\Models\UserCompanyLink', 'company_id', 'id', 'id', 'user_id');
    }

    public function checkLinkByUserId($id)
    {
        return !empty($this->users()->where('user_id', $id)->first());
    }
    
}
