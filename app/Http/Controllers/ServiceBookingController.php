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
        $bookings = ServiceBooking::join('vehicles', 'service_bookings.vehicle_id', 'vehicles.id')
        ->join('brands', 'vehicles.brand_id', 'brands.id')
        ->where('service_bookings.created_by', Auth::user()->id)
        ->select('service_bookings.*', 'vehicles.model', 'vehicles.registration_number', 'brands.name')->get();
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
        $vehicles = Vehicle::join('brands', 'vehicles.brand_id', 'brands.id')
        ->where('vehicles.created_by', Auth::user()->id)
        ->select('vehicles.*', 'brands.name')
        ->get();
        $services = Service::all();
        $booking = ServiceBooking::findOrFail($id);
        return view('user.booking.edit', compact('booking', 'vehicles', 'services'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $servicebooking = ServiceBooking::findOrFail($id);
        $servicebooking->update($data);

        return redirect('bookings')->with('message', "Service updated successfully");
    }

    public function destroy($id)
    {
        $servicebooking = ServiceBooking::findOrFail($id);

        $servicebooking->delete();
        return redirect('booking')->with('message', "Service deleted successfully");
    }
}
