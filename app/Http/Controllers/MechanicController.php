<?php

namespace App\Http\Controllers;

use App\Models\Mechanic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\MechanicRequest;
use App\Models\User;

class MechanicController extends Controller
{
    public function index(){
        $mechanics = Mechanic::all();
        return view('admin.mechanic.index', compact('mechanics'));
    }

    public function create(){
        $mechanics = User::where('role_id', 2)->get();
        return view('admin.mechanic.create', compact('mechanics'));
    }

    public function store(MechanicRequest $request)
    {
        $data = $request->validated();

        $mechanic = new Mechanic;
        $data['created_by'] = Auth::user()->id;
        $mechanic = $mechanic->create($data);

        //Update User to set Mechanic role
        $user = User::findOrFail($mechanic->user_id);
        $user->role_id = 3;
        $user->update();

        return redirect('admin/mechanics')->with('message', "Mechanic created successfully");
    }

    public function edit($id){
        $mechanic = Mechanic::findOrFail($id);
        $mechanics = User::all();
        return view('admin.mechanic.edit', compact('mechanics', 'mechanic'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $mechanic = Mechanic::findOrFail($id);
        $mechanic->update($data);


        //Update User to set Mechanic role
        $user = User::findOrFail($mechanic->user_id);
        $user->role_id = 3;
        $user->update();

        return redirect('admin/mechanics')->with('message', "Mechanic updated successfully");
    }

    public function destroy($id)
    {
        $mechanic = Mechanic::findOrFail($id);


        //Update User to set Customer role
        $user = User::findOrFail($mechanic->user_id);
        $user->role_id = 2;
        $user->update();

        $mechanic->delete();
        return redirect('admin/mechanics')->with('message', "Mechanic deleted successfully");
    }
}
