<?php

namespace App\Http\Controllers;

use App\Enquiry;
use App\Package;
use Illuminate\Http\Request;

class EnquiryController extends Controller
{
    public function index(Request $request)
    {
        $packages = Package::paginate(5)->where('status', 'active');
        if ($request->ajax()) {
            $view = view('packageData', ['packages' => $packages])->render();
            return response()->json(['html' => $view]);
        }
        return view('welcome', ['packages' => $packages]);
    }

    public function show()
    {
        $enquiry = Enquiry::all();
        return view('enquiries', ['enquiries' => $enquiry]);
    }

    public function store(Request $request)
    {
        return Enquiry::create($request->validate([
            "name" => "required|string",
            "phone" => "required|numeric",
            "email" => "required|email"
        ]));
    }

    public function destroy(Enquiry $enquiry)
    {
        $enquiry->delete();
        return redirect('/enquiries');
    }
}
