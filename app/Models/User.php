<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'gender',
        'password',
        'date_of_birth',
        'educational_level',
        'department',
        'hire_date',
        'address',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
// table_relations
    public function roles(){
        return $this->hasOne(Role::class);
    }

    public function parents_info(){
        return $this->belongsTo(Parent_Info::class);
    }
    public function uploads(){
        return $this->hasMany(Upload::class);
    }

    public function assignments(){
        return $this->hasMany(Assignment::class);
    }

    public function orders(){
        return $this->hasMany(Order::class);
    }

    public function courses(){
        return $this->hasMany(Course::class);
    }

    public function lessons() {
        return $this->hasMany(Lesson::class);
    }

    public function reviews(){
        return $this->hasMany(Review::class);
    }

    public function enrollments() {
        return $this->hasMany(Enrollment::class);
    }

    public function coursesEnrolled() {
        return $this->belongsToMany(Course::class, 'enrollments')->withPivot('progress', 'completed');
    }


}
