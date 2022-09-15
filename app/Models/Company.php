<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Scopes\SearchScope; 

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'website',
        'email',
        'user_id'
    ];

    public $searchColumns = [
        'name',
        'address',
        'website',
        'email'
    ];

    public function contact(){
        return $this->hasMany(Contact::class)->withoutGlobalScope(SearchScope::class);
    }

    public function company(){
        return $this->belongsTo(Company::class);
    }

    public static function userCompanies() {
        return self::withoutGlobalScopes()->where('user_id', auth()->id())->orderBy('name')->pluck('name', 'id')->prepend('All Companies', '');
    }

    public static function booted() {
        static::addGlobalScope(new SearchScope);
    }
}
