<?php

namespace App\Models;

use CodeIgniter\Model;

class MemberModel extends Model
{
    protected $table            = 'members';
    protected $primaryKey       = 'id_member';
    protected $returnType       = 'array';
    
    // Kita aktifkan soft deletes untuk fitur tong sampah member
    protected $useSoftDeletes   = true; 
    
    protected $allowedFields    = ['code_member', 'nama', 'email', 'kontak', 'status'];

    // Aktifkan timestamp agar created_at & updated_at terisi otomatis
    protected $useTimestamps    = true; 
}