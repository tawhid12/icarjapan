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
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function newexecutiveId(){
        return $this->belongsTo(User::class,'newexId');
    }
    public function posted_by(){
        return $this->belongsTo(User::class,'created_by');
    }
}
