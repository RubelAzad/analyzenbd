<?php

namespace App\Http\Controllers;

use Storage;
use App\Models\CustomUser;
use Illuminate\Http\Request;
use App\Services\UserService;
use App\Events\UserSavedEvent;
use App\Contracts\UserServiceInterface;

class CustomUserController extends Controller
{

    protected $userService;

    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }
    public function index()
    {
        $users = CustomUser::all();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }
    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:custom_users,email',
            'password' => 'required|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Create the user using the UserService
        $user = $this->userService->create($validatedData);

        // Create an array to store address data
        $addressData = [];

        // Extract address data from the request
        foreach ($request->input('address') as $address) {
            $addressData[] = [
                'street' => $address['street'],
                'city' => $address['city'],
                'state' => $address['state'],
                'country' => $address['country'],
                // Add other address fields as needed
            ];
        }

        // Dispatch the UserSavedEvent with user and address data
        event(new UserSavedEvent($user, $addressData));

        // Redirect back with success message
        return redirect()->route('customuser.index')->with('success', 'User created successfully');
    }


    public function edit(CustomUser $customuser)
    {

        return view('users.edit', compact('customuser'));

    }
    public function show(CustomUser $customuser)
    {

        return view('users.show', compact('customuser'));

    }


    public function update(Request $request, $id)
    {

        $user = $this->userService->find($id);
        $this->userService->update($user,$request->all());

        // Update the user's address
    foreach ($request->input('addresses', []) as $addressData) {
        if (isset($addressData['id'])) {
            // Update existing address
            $user->addresses()->where('id', $addressData['id'])->update($addressData);
        } else {
            // Create new address
            $user->addresses()->create($addressData);
        }
    }
        // $user = $this->userService->find($id);
        // $this->userService->update($user, $request->all());
        return redirect()->route('customuser.index')->with('success', 'User updated successfully');
    }

    public function destroy(Request $request, $id)
    {
        $user = $this->userService->find($id);
        $this->userService->delete($user);

        return redirect()->route('customuser.index')->with('success', 'User deleted successfully');
    }
      public function softdeleteindex()
    {
     $deletedUsers = CustomUser::onlyTrashed()->get();

        return view('users.deleted', compact('deletedUsers'));
    }

     public function restore($id)
    {
        $user = $this->userService->find($id);
        $this->userService->restore($user);

        // Optionally, you can redirect the user to a different route after restoration
        return redirect()->route('customuser.index')->with('success', 'User restored successfully');
    }
        public function destroyPermanently($id)
    {
        $this->userService->destroyPermanently($id);

        // Optionally, you can redirect the user to a different route after permanent deletion
        return redirect()->route('customuser.index')->with('success', 'User permanently deleted');
    }



}
