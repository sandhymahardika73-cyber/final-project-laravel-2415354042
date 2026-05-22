<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * index
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        // Siklus 1: Ambil semua data tanpa filter pencarian (search)
        $services = Service::all();

        return response()->json([
            'success' => true,
            'message' => 'List Data Services',
            'data'    => $services
        ], 200);
    }

    /**
     * store
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        // Siklus 1: Belum ditambahkan $request->validate()
        
        $service = Service::create([
            'name'        => $request->name,
            'description' => $request->description,
            'price'       => $request->price,
            'status'      => $request->status ?? 'active',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Service Berhasil Disimpan!',
            'data'    => $service
        ], 201);
    }

    /**
     * show
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Service $service)
    {
        return response()->json([
            'success' => true,
            'message' => 'Detail Data Service',
            'data'    => $service
        ], 200);
    }

    /**
     * update
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Service $service)
    {
        // Siklus 1: Belum ditambahkan $request->validate()

        $service->update([
            'name'        => $request->name,
            'description' => $request->description,
            'price'       => $request->price,
            'status'      => $request->status,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Service Berhasil Diupdate!',
            'data'    => $service
        ], 200);
    }

    /**
     * destroy
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Service $service)
    {
        // Siklus 1: Hapus data dasar tanpa proteksi relasi database
        $service->delete();

        return response()->json([
            'success' => true,
            'message' => 'Service Berhasil Dihapus!',
            'data'    => null
        ], 200);
    }

    /**
     * activate
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\JsonResponse
     */
    public function activate(Service $service)
    {
        $service->update(['status' => 'active']);

        return response()->json([
            'success' => true,
            'message' => 'Service Berhasil Diaktifkan!',
            'data'    => $service
        ], 200);
    }

    /**
     * deactivate
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\JsonResponse
     */
    public function deactivate(Service $service)
    {
        $service->update(['status' => 'inactive']);

        return response()->json([
            'success' => true,
            'message' => 'Service Berhasil Dinonaktifkan!',
            'data'    => $service
        ], 200);
    }
}