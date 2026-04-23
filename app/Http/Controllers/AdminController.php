<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Deceased;

class AdminController extends Controller
{
    public function dashboard()
    {
        $users = User::orderBy('created_at', 'desc')->get();
        $deceaseds = Deceased::orderBy('created_at', 'desc')->get();
        
        return view('admin.dashboard', compact('users', 'deceaseds'));
    }

    public function users()
    {
        $users = User::orderBy('created_at', 'desc')->get();
        return view('admin.users', compact('users'));
    }

    public function deceaseds()
    {
        $deceaseds = Deceased::orderBy('created_at', 'desc')->get();
        return view('admin.deceaseds', compact('deceaseds'));
    }

    public function createDeceased()
    {
        return view('admin.deceaseds_create');
    }

    public function storeDeceased(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'block' => 'required|string|max:50',
            'grave_number' => 'required|string|max:50',
            'death_date' => 'required|date',
            'birth_date' => 'nullable|date',
            'age_at_death' => 'nullable|integer',
            'gender' => 'required|string|in:Laki-laki,Perempuan',
            'google_maps_link' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('deceaseds', 'public');
            $validated['photo'] = $path;
        }

        Deceased::create($validated);

        return redirect()->route('admin.deceaseds')->with('success', 'Data almarhum berhasil ditambahkan!');
    }

    public function editDeceased($id)
    {
        $deceased = Deceased::findOrFail($id);
        return view('admin.deceaseds_edit', compact('deceased'));
    }

    public function updateDeceased(Request $request, $id)
    {
        $deceased = Deceased::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'block' => 'required|string|max:50',
            'grave_number' => 'required|string|max:50',
            'death_date' => 'required|date',
            'birth_date' => 'nullable|date',
            'age_at_death' => 'nullable|integer',
            'gender' => 'required|string|in:Laki-laki,Perempuan',
            'google_maps_link' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            // Delete old photo if exists
            if ($deceased->photo && \Illuminate\Support\Facades\Storage::disk('public')->exists($deceased->photo)) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($deceased->photo);
            }
            $path = $request->file('photo')->store('deceaseds', 'public');
            $validated['photo'] = $path;
        }

        $deceased->update($validated);

        return redirect()->route('admin.deceaseds')->with('success', 'Data almarhum berhasil diperbarui!');
    }

    public function deleteDeceased($id)
    {
        $deceased = Deceased::findOrFail($id);
        
        if ($deceased->photo && \Illuminate\Support\Facades\Storage::disk('public')->exists($deceased->photo)) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($deceased->photo);
        }
        
        $deceased->delete();

        return redirect()->route('admin.deceaseds')->with('success', 'Data almarhum berhasil dihapus!');
    }
    public function printDeceased($id)
    {
        $deceased = Deceased::findOrFail($id);
        return view('admin.deceaseds_print', compact('deceased'));
    }
}
