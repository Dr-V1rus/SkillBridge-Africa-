<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Internship extends Model
{
    protected $fillable = [
        'business_id',
        'title',
        'description',
        'location',
        'type',
        'duration',
        'deadline',
        'is_active',
    ];

    public function business()
    {
        return $this->belongsTo(User::class, 'business_id');
    }

    public function applications()
    {
        return $this->hasMany(Application::class);
    }
}