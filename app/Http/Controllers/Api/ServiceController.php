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
   public function index(Request $request)
{
    // Siklus 3: Menambahkan fitur pencarian berdasarkan query 'search'
    $query = Service::query();

    if ($request->has('search')) {
        $query->where('name', 'like', '%' . $request->search . '%')
              ->orWhere('description', 'like', '%' . $request->search . '%');
    }

    $services = $query->get();

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
    // Tambahan Validasi di Siklus 2
    $request->validate([
        'name'        => 'required|string|max:255',
        'description' => 'nullable|string',
        'price'       => 'required|numeric|min:0',
        'status'      => 'nullable|in:active,inactive',
    ]);

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
    // Tambahan Validasi di Siklus 2
    $request->validate([
        'name'        => 'required|string|max:255',
        'description' => 'nullable|string',
        'price'       => 'required|numeric|min:0',
        'status'      => 'required|in:active,inactive',
    ]);

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
    // Siklus 3: Mencegah penghapusan jika service masih memiliki relasi aktif
    // (Disesuaikan dengan logika pengunci database yang kamu miliki kemarin)
    if ($service->subscriptions()->exists()) { 
        return response()->json([
            'success' => false,
            'message' => 'Data service gagal dihapus karena masih digunakan oleh data subscription!',
            'data'    => null
        ], 400);
    }

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