<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\VehicleRequest;
use App\Models\Brand;

class VehicleController extends Controller
{
    public function index(){
        $vehicles = Vehicle::all();
        return view('user.vehicle.index', compact('vehicles'));
    }

    public function create(){
        $brands = Brand::all();
        return view('user.vehicle.create', compact('brands'));
    }

    public function store(VehicleRequest $request)
    {
        $data = $request->validated();

        $Vehicle = new Vehicle;
        $data['created_by'] = Auth::user()->id;
        $Vehicle->create($data);

        return redirect('vehicles')->with('message', "Vehicle created successfully");
    }

    public function edit($id){
        $Vehicle = Vehicle::findOrFail($id);
        return view('user.vehicle.edit', compact('vehicle'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();

        $Vehicle = Vehicle::findOrFail($id);
        $Vehicle->update($data);

        return redirect('vehicles')->with('message', "Vehicle updated successfully");
    }

    public function destroy($id)
    {
        $Vehicle = Vehicle::findOrFail($id);
        $Vehicle->delete();

        return redirect('vehicles')->with('message', "Vehicle deleted successfully");
    }
}
