<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Deceased;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('q');
        $results = collect();

        if ($query) {
            $results = Deceased::where('name', 'like', '%' . $query . '%')
                               ->orWhere('grave_number', 'like', '%' . $query . '%')
                               ->orderBy('name', 'asc')
                               ->get();
        }

        return view('search', compact('results', 'query'));
    }
}
