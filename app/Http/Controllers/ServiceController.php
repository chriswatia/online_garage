<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ServiceRequest;

class ServiceController extends Controller
{
    public function index(){
        $services = Service::all();
        return view('admin.service.index', compact('services'));
    }


    public function create(){
        return view('admin.service.create');
    }

    public function store(ServiceRequest $request)
    {
        $data = $request->validated();

        $service = new Service;
        $data['created_by'] = Auth::user()->id;
        $service->create($data);

        return redirect('admin/services')->with('message', "Service created successfully");
    }

    public function edit($id){
        $service = Service::findOrFail($id);
        return view('admin.service.edit', compact('service'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();

        $service = Service::findOrFail($id);
        $service->update($data);

        return redirect('admin/services')->with('message', "Service updated successfully");
    }

    public function destroy($id)
    {
        $service = Service::findOrFail($id);
        $service->delete();

        return redirect('admin/services')->with('message', "Service deleted successfully");
    }
}
