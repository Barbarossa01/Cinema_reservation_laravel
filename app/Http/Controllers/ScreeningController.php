<?php

namespace App\Http\Controllers;

use App\Models\Screening;
use App\Models\Film;
use Illuminate\Http\Request;

class ScreeningController extends Controller
{
    public function index()
    {
        \Log::info('Screening index method called.');

        $screenings = Screening::with('film')->get();
        \Log::info('Fetched screenings:', $screenings->toArray());

        return view('screenings.index', compact('screenings'));
    }

    public function create()
    {
        $films = Film::all();
        \Log::info('Create method films fetched:', $films->toArray());

        return view('screenings.create', compact('films'));
    }


    public function store(Request $request)
    {
        \Log::info('Store method called with data:', $request->all());
    
        $validated = $request->validate([
            'date' => 'required|date',
            'time' => 'required',
            'hall' => 'required|string',
            'film_id' => [
                'required',
                function ($attribute, $value, $fail) {
                    $exists = \DB::table('cinema_project_laravel.film')->where('id', $value)->exists();
                    if (!$exists) {
                        $fail('The selected film does not exist.');
                    }
                },
            ],
            'available_seats' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
            'screen_type' => 'required|string|in:2D,3D,IMAX',
        ]);
    
        \Log::info('Validated data:', $validated);
    
        Screening::create($validated);
    
        return redirect()->route('screenings.index')->with('success', 'Screening created successfully.');
    }
    



    public function edit(Screening $screening)
    {
        \Log::info('Edit method called for screening ID:', ['id' => $screening->id]);

        $films = Film::all();
        \Log::info('Edit method films fetched:', $films->toArray());

        return view('screenings.edit', compact('screening', 'films'));
    }

    public function update(Request $request, Screening $screening)
    {
        \Log::info('Update method called for screening ID:', ['id' => $screening->id]);
        \Log::info('Submitted data:', $request->all());

        $validated = $request->validate([
            'date' => 'required|date',
            'time' => 'required',
            'hall' => 'required|string',
'film_id' => [
    'required',
    'integer',
    function ($attribute, $value, $fail) {
        $exists = \DB::table('cinema_project_laravel.film')->where('id', $value)->exists();
        if (!$exists) {
            $fail('The selected film does not exist.');
        }
    },
],
            'available_seats' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
            'screen_type' => 'required|string|in:2D,3D,IMAX',
        ]);

        \Log::info('Validated data:', $validated);

        $screening->update($validated);

        return redirect()->route('screenings.index')->with('success', 'Screening updated successfully.');
    }

    public function destroy(Screening $screening)
    {
        \Log::info('Destroy method called for screening ID:', ['id' => $screening->id]);

        $screening->delete();

        return redirect()->route('screenings.index')->with('success', 'Screening deleted successfully.');
    }
}
