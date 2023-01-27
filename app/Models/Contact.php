<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mail;
use App\Mail\ContactMail;
use App\Observers\ContactObserver;

class Contact extends Model
{
    //protected $fillable = ['name', 'email', 'phone', 'subject', 'message'];
    protected $fillable = ['name', 'email', 'message'];
}
