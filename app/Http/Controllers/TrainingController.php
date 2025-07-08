<?php

namespace App\Http\Controllers;

use App\Models\Training;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TrainingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $trainings = Training::paginate(8);
        return view('pages.training.training', compact('trainings'));
    }

    public function detail($slug)
    {
        $training = Training::where('slug', $slug)->firstOrFail();
        $startFormatted = Carbon::parse($training->start_date)
            ->locale('id')->translatedFormat('d F Y, H.i') . ' WIB';

        $endFormatted = Carbon::parse($training->end_date)
            ->locale('id')->translatedFormat('d F Y, H.i') . ' WIB';
        return view('pages.training.detail', compact('training', 'startFormatted', 'endFormatted'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
