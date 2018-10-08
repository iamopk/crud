<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    const DEFAULT_USER_ROLE = 0;
    const ADMIN_USER_ROLE = 1;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'second_name',
        'gender',
        'suffix',
        'address',
        'role',
        'phoneNumber',
        'city_id',
        'company_id',
        'job_id',
        'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token',
    ];

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id', 'id');
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }

    public function job()
    {
        return $this->belongsTo(Job::class, 'job_id', 'id');
    }

    public function isAdmin()
    {
        return $this->role === self::ADMIN_USER_ROLE;
    }

    public static function getRoles()
    {
        return [
            self::DEFAULT_USER_ROLE => 'User',
            self::ADMIN_USER_ROLE => 'Admin',
        ];
    }

    /**
     * @return \Illuminate\Database\Query\Builder
     */
    public static function getAllUsers()
    {
        return \DB::table('users')
            ->select([
                'users.id as id',
                'users.name as first_name',
                'second_name',
                'email',
                'gender',
                'suffix',
                'address',
                'role',
                'phoneNumber',
                'cities.name as city',
                'companies.name as company',
                'jobs.name as job',
            ])
            ->leftJoin('cities', 'users.city_id', '=', 'cities.id')
            ->leftJoin('companies', 'users.company_id', '=', 'companies.id')
            ->leftJoin('jobs', 'users.job_id', '=', 'jobs.id')
            ->orderBy('users.id', 'DESC');
    }
}
