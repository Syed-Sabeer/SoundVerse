<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class AdminCustomerController extends Controller
{
    public function index()
    {
        $customers = User::role('individual')->get();
        return view('admin.customers.index', compact('customers'));
    }

    public function add()
    {
        return view('admin.customers.add');
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|min:8',
                'phone' => 'nullable|string|max:20',
                'address' => 'nullable|string|max:500',
                'is_active' => 'nullable|boolean',
            ]);

            $validatedData = $request->only([
                'name', 'email', 'phone', 'address'
            ]);

            // Convert checkbox values to boolean
            $validatedData['is_active'] = $request->has('is_active') ? 1 : 0;
            $validatedData['password'] = bcrypt($request->password);
            $validatedData['role'] = 'user';

            Log::info('Validated Customer data:', $validatedData);

            $customer = User::create($validatedData);

            Log::info('Customer created successfully:', ['id' => $customer->id]);

            return redirect()->route('admin.customer.index')->with('success', 'Customer added successfully.');
        } catch (\Exception $e) {
            Log::error('Error while creating customer:', ['message' => $e->getMessage()]);
            return redirect()->back()->withErrors($e->getMessage())->withInput();
        }
    }

    public function edit($id)
    {
        $customer = User::findOrFail($id);
        return view('admin.customers.edit', compact('customer'));
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email,' . $id,
                'password' => 'nullable|string|min:8',
                'phone' => 'nullable|string|max:20',
                'address' => 'nullable|string|max:500',
                'is_active' => 'nullable|boolean',
            ]);

            $customer = User::findOrFail($id);
            
            $updateData = [
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
            ];

            // Convert checkbox values to boolean
            $updateData['is_active'] = $request->has('is_active') ? 1 : 0;

            // Update password only if provided
            if ($request->filled('password')) {
                $updateData['password'] = bcrypt($request->password);
            }

            $customer->update($updateData);

            return redirect()->route('admin.customer.index')->with('success', 'Customer updated successfully.');
        } catch (\Exception $e) {
            Log::error('Customer update error:', ['message' => $e->getMessage()]);
            return redirect()->back()->withErrors($e->getMessage())->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $customer = User::findOrFail($id);
            $customer->delete();
            return redirect()->route('admin.customer.index')->with('success', 'Customer deleted successfully.');
        } catch (\Exception $e) {
            Log::error('Customer delete error:', ['message' => $e->getMessage()]);
            return redirect()->back()->withErrors('Could not delete customer.');
        }
    }

    public function toggleStatus(Request $request, $id)
    {
        try {
            $customer = User::findOrFail($id);
            // Toggle the status: if it's 1, make it 0; if it's 0, make it 1
            $customer->is_active = $customer->is_active ? 0 : 1;
            $customer->save();
            
            return redirect()->route('admin.customer.index')->with('success', 'Customer status updated successfully.');
        } catch (\Exception $e) {
            Log::error('Customer status toggle error:', ['message' => $e->getMessage()]);
            return redirect()->back()->withErrors('Could not update customer status.');
        }
    }

    /**
     * Toggle featured artist flag for a user.
     */
    public function toggleFeatured(Request $request, $id)
    {
        try {
            $user = User::findOrFail($id);

            // Only allow marking artists as featured
            if (!$user->is_artist) {
                return redirect()->back()->withErrors('Only artist accounts can be marked as featured.');
            }

            $user->is_featured = $user->is_featured ? 0 : 1;
            $user->save();

            return redirect()->back()->with('success', 'Featured artist status updated.');
        } catch (\Exception $e) {
            Log::error('Customer featured toggle error:', ['message' => $e->getMessage()]);
            return redirect()->back()->withErrors('Could not update featured status.');
        }
    }
}



