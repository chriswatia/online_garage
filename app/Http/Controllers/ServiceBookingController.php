<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use App\Models\ServiceBooking;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ServiceBookingRequest;

class ServiceBookingController extends Controller
{
    public function index(){
        $bookings = ServiceBooking::where('created_by', Auth::user()->id)->get();
        return view('user.booking.index', compact('bookings'));
    }

    public function create(){
        $vehicles = Vehicle::join('brands', 'vehicles.brand_id', 'brands.id')
        ->where('vehicles.created_by', Auth::user()->id)
        ->select('vehicles.*', 'brands.name')
        ->get();
        $services = Service::all();
        return view('user.booking.create', compact('vehicles', 'services'));
    }

    public function store(ServiceBookingRequest $request)
    {
        $data = $request->validated();

        $servicebooking = new ServiceBooking;
        $data['created_by'] = Auth::user()->id;
        $servicebooking = $servicebooking->create($data);

        return redirect('bookings')->with('message', "Service booked successfully");
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
