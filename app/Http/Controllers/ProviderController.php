<?php

namespace App\Http\Controllers;

use App\Models\Provider;
use Illuminate\Http\Request;

class ProviderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $providers = Provider::paginate(10);

        return view('provider.index', [
            'providers' =>  $providers
        ]);
    }

    public function create()
    {
        return view('provider.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255|unique:providers',
            'code' => 'required|max:255|unique:providers',
            'phone' => ['required', 'regex:/^\d{10}$/'],
            'email' => 'required|max:255|email|unique:providers',
        ]);

        Provider::create([
            'name' => $request->name,
            'code' => $request->code,
            'phone' => $request->phone,
            'email' => $request->email,
            'user_id' => auth()->user()->id
        ]);

        return redirect()->route('provider.index');
    }

    public function show(Provider $provider)
    {
        return view('provider.show', [
            'provider' => $provider
        ]);
    }

    public function destroy(Provider $provider)
    {
        $provider->delete();
        
        return redirect()->route('provider.index');
    }

    public function edit(Provider $provider)
    {
        return view('provider.edit',[
            'provider' => $provider
        ]);
    }

    public function update(Request $request, Provider $provider)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'code' => 'required|max:255',
            'phone' => ['required', 'regex:/^\d{10}$/'],
            'email' => 'required|max:255|email',
        ]);   

        $provider->name = $request->name;
        $provider->code = $request->code;
        $provider->phone = $request->phone;
        $provider->email = $request->email;

        $provider->save();

        return redirect()->route('provider.index');

    }
}
