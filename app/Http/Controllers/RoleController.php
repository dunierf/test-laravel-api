<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Http\Resources\IdNameDtoResource;

class RoleController extends Controller
{
    public function index()
    {
        return IdNameDtoResource::collection(Role::orderBy('name')->get());
    }

    public function show(Role $role)
    {
        return new IdNameDtoResource($role);
    }
}
