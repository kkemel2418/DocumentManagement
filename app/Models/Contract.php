<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    use HasFactory;

    protected $fillable = [
        'contract_number',
        'issue_date',
        'total_amount',
        'contract_field',
        'description',
        'client_name',
        'service_description',
        'total_value',
        'document_type',
    ];

    protected $table = 'contract';
}
