<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientTransfer extends Model
{
    use HasFactory;
    protected $table = 'client_transfers';
    public function prevExeutive()
    {
        return $this->belongsTo(User::class, 'curexId');
    }
}
