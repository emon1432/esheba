<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class GenericCertificate extends Model
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'FatherName',
        'MotherName',
        'nid',
        'passport',
        'bid',
        'mobile',
        'email',
        'resident',
        'birthdate',
        'presentHoldingNumber',
        'presentVillage',
        'presentPostOffice',
        'presentPoliceStation',
        'presentDistrict',
        'permanentVillage',
        'permanentPostOffice',
        'permanentPoliceStation',
        'permanentDistrict',
        
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
}
