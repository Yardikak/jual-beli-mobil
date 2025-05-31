<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::all();
        return response()->json(['data' => $customers]);
    }
    public function show($id)
    {
        $customer = Customer::find($id);
        if (!$customer) {
            return response()->json(['message' => 'Customer not found'], 404);
        }
        return response()->json($customer);
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|regex:/^[A-Za-z\s]+$/u',
            'email' => 'required|email|unique:customers,email',
            'phone' => 'required|string|min:10|max:15|regex:/^[0-9]{8,15}$/',
            'address' => 'required|string',
        ]);
        $customer = Customer::create($validated);
        return response()->json([
            'message' => 'Customer created successfully',
            'data' => $customer
        ], 201);
    }
    public function update(Request $request, $id)
    {
        $customer = Customer::find($id);
        if (!$customer) {
            return response()->json(['message' => 'Customer not found'], 404);
        }
        $validated = $request->validate([
            'name' => 'required|string|max:255|regex:/^[A-Za-z\s]+$/u',
            'email' => 'required|email|unique:customers,email,' . $id,
            'phone' => 'required|string|min:10|max:15|regex:/^[0-9]{8,15}$/',
            'address' => 'required|string',
        ]);
        $customer->update($validated);
        return response()->json([
            'message' => 'Customer updated successfully',
            'data' => $customer
        ]);
    }
    public function destroy($id)
    {
        $customer = Customer::find($id);
        if (!$customer) {
            return response()->json(['message' => 'Customer not found'], 404);
        }
        $customer->delete();
        return response()->json(['message' => 'Customer deleted successfully']);
    }
}
