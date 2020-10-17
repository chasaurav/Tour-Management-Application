<?php

namespace App\Http\Controllers;

use App\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $packages = Package::all();
        return view('home', ['packages' => $packages]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('createPackage');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validation($request);

        $image = $request->file('image');
        $extension = $image->getClientOriginalExtension();
        Storage::disk('public')->put($image->getFilename() . '.' . $extension,  File::get($image));

        Package::create([
            "code" => $request->code,
            "title" => $request->title,
            "image" => $image->getFilename() . '.' . $extension,
            "rate" => $request->rate,
            "nights" => $request->nights,
            "days" => $request->days,
            "minPax" => $request->minPax,
            "tag" => $request->tag,
            "status" => $request->status,
            "hotel" => $request->hotel,
            "trans" => $request->trans,
            "meal" => $request->meal,
            "sight" => $request->sight,
            "description" => $request->description
        ]);

        return redirect('/home');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $package = Package::findOrFail($id);
        return view('editPackage', ['package' => $package]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Package  $package
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Package $package)
    {
        $this->validation($request);

        if (is_null($request->file('image'))) {
            $file = $request->dbimage;
        } else {
            Storage::disk('public')->delete($package->image);
            $image = $request->file('image');
            $extension = $image->getClientOriginalExtension();
            Storage::disk('public')->put($image->getFilename() . '.' . $extension,  File::get($image));
            $file = $image->getFilename() . '.' . $extension;
        }

        $package->update([
            "code" => $request->code,
            "title" => $request->title,
            "image" => $file,
            "rate" => $request->rate,
            "nights" => $request->nights,
            "days" => $request->days,
            "minPax" => $request->minPax,
            "tag" => $request->tag,
            "status" => $request->status,
            "hotel" => $request->hotel,
            "trans" => $request->trans,
            "meal" => $request->meal,
            "sight" => $request->sight,
            "description" => $request->description
        ]);

        return redirect('/home');
    }

    public function updateStatus($type, $id)
    {
        return Package::whereId($id)->update(['status' => $type]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Package  $package
     * @return \Illuminate\Http\Response
     */
    public function destroy(Package $package)
    {
        Storage::disk('public')->delete($package->image);
        $package->delete();
        return redirect('/home');
    }

    private function validation($request)
    {
        return $request->validate([
            "code" => "required",
            "title" => "required|string",
            "rate" => "required",
            "minPax" => "required",
            "tag" => "required|string",
            "status" => "required|string",
            "hotel" => "required",
            "trans" => "required",
            "meal" => "required",
            "sight" => "required",
            "description" => "required",
            "image" => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    }
}
