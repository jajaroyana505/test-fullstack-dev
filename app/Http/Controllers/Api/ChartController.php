<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\People;
use Illuminate\Http\Request;

class ChartController extends Controller
{
    public function gender()
    {
        $peoples = People::select('gender')
            ->selectRaw('COUNT(*) as total')
            ->groupBy('gender')
            ->get();
        return response()->json($peoples);
    }
    public function dob(Request $request)
    {

        if (!$request->from) {
            return response([
                'dob' => People::select('dob')->orderBy('dob', 'asc')->get(),
                'range' =>  People::selectRaw('MIN(dob) as earliest, MAX(dob) as latest')->first()
            ]);
        }

        $validated = $request->validate([
            'from' => 'required|date',
            'to' => 'required|date|after_or_equal:from',
        ]);
        return response([
            'dob' => People::select('dob')->whereBetween('dob', [$validated['from'], $validated['to']])->get(),
            'range' => [
                'earliest' => $validated['from'],
                'latest' => $validated['to']
            ]
        ]);
    }
}
