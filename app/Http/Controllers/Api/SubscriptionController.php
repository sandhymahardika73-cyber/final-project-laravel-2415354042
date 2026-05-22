<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Subscription;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function index(): JsonResponse
    {
        // Mengambil data subscription lengkap dengan data customer dan service yang berelasi
        $subscriptions = Subscription::with(['customer', 'service'])->latest()->get();
        return response()->json([
            'success' => true,
            'message' => 'Subscriptions retrieved successfully',
            'data' => $subscriptions
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'customer_id' => ['required', 'exists:customers,id'], // Validasi id harus ada di tabel customers
            'service_id' => ['required', 'exists:services,id'],   // Validasi id harus ada di tabel services
            'start_date' => ['nullable', 'date'],
            'end_date' => ['nullable', 'date'],
            'status' => ['required', 'string', 'in:active,inactive,trial,isolir,dismantle'] // Sesuai aturan enum modul
        ]);

        $subscription = Subscription::query()->create($data);

        return response()->json([
            'success' => true,
            'message' => 'Subscription created successfully',
            'data' => $subscription
        ], 201);
    }
}