<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Arsip extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'surat';
    protected $primaryKey = 'nomor';
    protected $fillable = ['*'];
    public $search;
    protected $queryString = ['search'];
}
