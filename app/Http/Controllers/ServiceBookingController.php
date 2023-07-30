<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Service;
use App\Models\Vehicle;
use App\Models\Mechanic;
use Illuminate\Http\Request;
use App\Models\ServiceBooking;
use Illuminate\Support\Facades\Auth;
use App\Notifications\EmailNotification;
use App\Http\Requests\ServiceBookingRequest;

class ServiceBookingController extends Controller
{
    public function index(){
        $bookings = ServiceBooking::join('vehicles', 'service_bookings.vehicle_id', 'vehicles.id')
        ->join('brands', 'vehicles.brand_id', 'brands.id')
        ->where('service_bookings.created_by', Auth::user()->id)
        ->select('service_bookings.*', 'vehicles.model', 'vehicles.registration_number', 'brands.name')
        ->orderBy('service_bookings.date', 'desc')->get();
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

        $user = Auth::user();

        $admin_user = User::where('role_id', 1)->first();

        $project = [
            'greeting' => 'Hi '.$admin_user->firstname.',',
            'body' => 'A new service booking was scheduled for '.$servicebooking->date,
            'thanks' => 'Thank you this is from '.$user->firstname .' '.$user->lastname,
            'actionText' => 'View Booking',
            'actionURL' => url('/admin/bookings'),
            'id' => 57
        ];

        $admin_user->notify(new EmailNotification($project));

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

    public function bookings(){
        $bookings = ServiceBooking::join('vehicles', 'service_bookings.vehicle_id', 'vehicles.id')
        ->join('brands', 'vehicles.brand_id', 'brands.id')
        ->join('users', 'service_bookings.created_by', 'users.id')
        ->select('service_bookings.*', 'vehicles.model', 'vehicles.registration_number', 'brands.name',
         'users.firstname', 'users.lastname', 'users.phone')
        ->orderBy('service_bookings.date', 'desc')->get();
        return view('admin.booking.index', compact('bookings'));
    }

    public function assignMechanic($id){
        $vehicles = Vehicle::join('brands', 'vehicles.brand_id', 'brands.id')
        ->select('vehicles.*', 'brands.name')
        ->get();
        $services = Service::all();
        $booking = ServiceBooking::findOrFail($id);
        $mechanics = Mechanic::join('users', 'mechanics.user_id', 'users.id')->get();
        return view('admin.booking.edit', compact('booking', 'vehicles', 'services', 'mechanics'));
    }

    public function close($id){
        $vehicles = Vehicle::join('brands', 'vehicles.brand_id', 'brands.id')
        ->select('vehicles.*', 'brands.name')
        ->get();
        $services = Service::all();
        $booking = ServiceBooking::findOrFail($id);
        $mechanics = Mechanic::join('users', 'mechanics.user_id', 'users.id')->get();
        return view('admin.booking.close', compact('booking', 'vehicles', 'services', 'mechanics'));
    }

    public function updateMechanic(Request $request, $id)
    {
        $data = $request->all();
        $servicebooking = ServiceBooking::findOrFail($id);
        $servicebooking->update($data);

        $servicebooking = ServiceBooking::findOrFail($id);

        $user = User::where('id', $servicebooking->mechannic_id)->first();

        $admin_user = User::where('id', $servicebooking->created_by)->first();

        $project = [
            'greeting' => 'Hi '.$admin_user->firstname.',',
            'body' => ''.$user->firstname .' '.$user->lastname.' was assigned the Mechanic',
            'thanks' => 'Thanks for choosing Jatinga Garage and AutoSpares',
            'actionText' => 'View Booking',
            'actionURL' => url('edit-booking/'.$servicebooking->id),
            'id' => 57
        ];

        $admin_user->notify(new EmailNotification($project));

        return redirect('admin/bookings')->with('message', "Mechanic assigned successfully");
    }

    public function closeBooking(Request $request, $id)
    {
        $data = $request->all();
        $servicebooking = ServiceBooking::findOrFail($id);
        $servicebooking->update($data);

        $admin_user = User::where('id', $servicebooking->created_by)->first();

        $project = [
            'greeting' => 'Hi '.$admin_user->firstname.',',
            'body' => 'Your booked service was completed',
            'thanks' => 'Thanks for choosing Jatinga Garage and AutoSpares',
            'actionText' => 'View Booking',
            'actionURL' => url('edit-booking/'.$servicebooking->id),
            'id' => 57
        ];

        $admin_user->notify(new EmailNotification($project));

        return redirect('admin/bookings')->with('message', "Booking closed successfully");
    }

    public function view($id){
        $vehicles = Vehicle::join('brands', 'vehicles.brand_id', 'brands.id')
        ->select('vehicles.*', 'brands.name')
        ->get();
        $services = Service::all();
        $booking = ServiceBooking::findOrFail($id);
        $mechanics = Mechanic::join('users', 'mechanics.user_id', 'users.id')->get();
        return view('admin.booking.view', compact('booking', 'vehicles', 'services', 'mechanics'));
    }

    public function viewBooking(Request $request, $id)
    {
        return redirect('admin/bookings');
    }

    public function myBookings(){
        $bookings = ServiceBooking::join('vehicles', 'service_bookings.vehicle_id', 'vehicles.id')
        ->join('brands', 'vehicles.brand_id', 'brands.id')
        ->join('users', 'service_bookings.created_by', 'users.id')
        ->where('service_bookings.mechanic_id', Auth::user()->id)
        ->select('service_bookings.*', 'vehicles.model', 'vehicles.registration_number', 'brands.name',
         'users.firstname', 'users.lastname', 'users.phone')->orderBy('service_bookings.date', 'desc')->get();
        return view('admin.booking.index', compact('bookings'));
    }
}
