<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\CreateUserRequest;
use App\Http\Requests\Users\UpdateUserRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Hash;

class UserController extends Controller
{
    protected $user;
    protected $role;
    public function __construct(User $user, Role $role){
        $this->user = $user;
        $this->role = $role;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = $this->user::orderByDesc('id')->paginate(10);
        return view('admin.users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = $this->role::all()->groupBy('group');
        return view('admin.users.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateUserRequest $request)
    {
        $dataCreate = $request->all();
        $dataCreate['password'] = Hash::make($request->password);
        $dataCreate['image'] = $this->user->saveImage($request);


        $user = $this->user->create($dataCreate);
        $user->images()->create(['url'=>$dataCreate['image']]);
        $user->roles()->attach($dataCreate['role_ids']);
        return to_route('user.index')->with('success','Create success !');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = $this->user::findOrFail($id)->load('roles');
        $roles= $this->role::all()->groupBy('group');
        return view('admin.users.edit', compact('roles','user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, string $id)
    {
        $user = $this->user::findOrFail($id)->load('roles');
        
        $dataUpdate = $request->except('password');
        if($request->password){
            $dataUpdate['password'] = Hash::make($request->password);
        };
        $currentImage = $user->images->count() > 0 ? $user->images->first()->url : '';
        $dataUpdate['image'] = $this->user->updateImage($request,$currentImage);
        $user->update($dataUpdate);
        $user->images()->update (['url' => $dataUpdate['image']]);
        $user->roles()->sync($dataUpdate['role_ids'] ?? []) ;
        return to_route('user.index')->with('success','Update success !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = $this->user->findOrFail($id)->load('roles');
        $user->images()->delete();
        $imageName = $user->images->count() > 0 ? $user->images->first()->url : '';
        // $this->user->deleteImage($imageName);
        $user->delete();
        return to_route('user.index')->with('success','Delete success !');
    }
}
