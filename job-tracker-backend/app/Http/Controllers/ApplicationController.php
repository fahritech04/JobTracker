<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    
    public function index(Request $request)
    {
        // Ambil semua lamaran milik user yang sedang login, urutkan berdasarkan lexorank
        $applications = $request->user()->applications()->orderBy('lexorank', 'asc')->get();
        return response()->json($applications);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Validasi input dari frontend
        $validated = $request->validate([
            'company_name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'work_type' => 'required|in:remote,hybrid,on-site',
            'salary_range' => 'nullable|string|max:255',
            'job_url' => 'nullable|url',
            'status' => 'required|in:wishlist,applied,assessment,interview,offered,rejected',
        ]);

        // 2. Berikan nilai awal untuk lexorank (menggunakan timestamp waktu saat ini)
        $validated['lexorank'] = (string) now()->timestamp; 
        
        // 3. Simpan data dan otomatis kaitkan dengan user_id yang sedang login
        $application = $request->user()->applications()->create($validated);

        return response()->json($application, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, string $id)
    {
        // findOrFail akan me-return error 404 jika ID tidak ditemukan ATAU bukan milik user ini
        $application = $request->user()->applications()->findOrFail($id);
        
        return response()->json($application);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Cari datanya dulu, pastikan milik user yang login
        $application = $request->user()->applications()->findOrFail($id);

        // Validasi data yang dikirim (sometimes = hanya divalidasi jika datanya ikut dikirim)
        $validated = $request->validate([
            'company_name' => 'sometimes|required|string|max:255',
            'position' => 'sometimes|required|string|max:255',
            'work_type' => 'sometimes|required|in:remote,hybrid,on-site',
            'salary_range' => 'nullable|string|max:255',
            'job_url' => 'nullable|url',
            'status' => 'sometimes|required|in:wishlist,applied,assessment,interview,offered,rejected',
            'lexorank' => 'sometimes|required|string', 
        ]);

        // Simpan perubahan
        $application->update($validated);

        return response()->json($application);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        // Cari datanya
        $application = $request->user()->applications()->findOrFail($id);
        
        // Hapus dari database
        $application->delete();

        return response()->json(['message' => 'Lamaran berhasil dihapus']);
    }
}