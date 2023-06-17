<?php

namespace App\Http\Controllers;

use App\Models\Truck_SubUnits;
use Illuminate\Http\Request;
use App\Models\Trucks;

class TruckOperations extends Controller
{

    public function redirectToTrucks()
    {
        return redirect()->route('getTrucks');
    }
    public function modifyTruck(Request $request)
    {
        $unitNumber = $request->input('unitNumber');
        $model = Trucks::firstOrNew(['unitNumber' => $unitNumber]);


        if ($request->isMethod('post')) {

            $model->fill($request->only('unitNumber', 'year', 'notes'));
            $model->save();

            return redirect()->back()->with('success', 'Form submitted successfully!');
        }

        return view('trucks', compact('model'));
    }

    public function deleteTruck(Request $request)
    {
        $unitNumber = $request->input('unitNumber');

        $truck = Trucks::where('unitNumber', $unitNumber)->first();

        if (!$truck) {

            return redirect()->back()->with('error', 'Truck not found.');
        }

        $truck->delete();

        return redirect()->back()->with('success', 'Truck deleted successfully.');
    }

    public function getTrucks()
    {
        $trucks = Trucks::all();
        return view('trucks', ['trucks' => $trucks]);
    }

    public function getTruckSubs(Request $request)
    {
        $unitNumber = $request->route('unitNumber');
        $truckSubs = Truck_SubUnits::where('main_truck', $unitNumber)
            ->orWhere('subunit', $unitNumber)
            ->orderBy('end_date')
            ->get();

        return view('truckDetailed', ['truckSubs' => $truckSubs]);
    }
    public function createTruckSubs(Request $request)
    {

        $main_truck = $request->input('main_truck');
        $subunit = $request->input('subunit');
        $model = Truck_SubUnits::where([
            'main_truck' => $main_truck,
            'subunit' => $subunit
        ])->first();

        if ($model) {
            // Record already exists
            return redirect()->back()->withErrors(['Fail' => $subunit . ' is already subbing for ' . $main_truck])->withInput();
        }

        // Create a new record
        $model = new Truck_SubUnits();
        $model->main_truck = $main_truck;
        $model->subunit = $subunit;

        // Fill and save the model using the request data
        $model->fill($request->only('main_truck', 'subunit', 'start_date', 'end_date'));
        $model->save();

        return redirect()->back()->with('success', 'Form submitted successfully!');
    }
}
