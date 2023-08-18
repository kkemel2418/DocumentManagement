<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_number',
        'issue_date',
        'total_amount',
        'total_value',
        'description',
        'invoice_field',
        'client_name',
        'service_description'
    ];

    protected $table = 'invoice';
}
