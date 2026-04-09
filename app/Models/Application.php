<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    protected $fillable = [
        'internship_id',
        'student_id',
        'message',
        'portfolio_link',
        'status',
    ];

    public function internship()
    {
        return $this->belongsTo(Internship::class);
    }

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }
}
