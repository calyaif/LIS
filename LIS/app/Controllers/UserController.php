<?php

namespace App\Controllers;

use App\Models\MemberModel; 

class UserController extends BaseController
{
    public function index()
    {
        $memberModel = new \App\Models\Membermodel();
        
        $data = [
            'members' => $memberModel->findAll()
        ];

        return view('users/index', $data);
    }
}