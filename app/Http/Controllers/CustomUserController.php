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
            'address.street' => 'required|string',
            'address.city' => 'required|string',
            'address.state' => 'required|string',
            'address.country' => 'required|string',
        ], [
            'address.street.required' => 'The street field is required.',
            'address.city.required' => 'The city field is required.',
            'address.state.required' => 'The state field is required.',
            'address.country.required' => 'The country field is required.',
        ]);

        // Create the user using the UserService
        $user = $this->userService->create($validatedData);

            $addressData = [
        [
            'street' => $request->input('address.street'),
            'city' => $request->input('address.city'),
            'state' => $request->input('address.state'),
            'country' => $request->input('address.country'),
            // Add other address fields as needed
        ]
    ];



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
        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:custom_users,email,'.$id,
            'password' => 'required|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:100',
            'address.street' => 'required|string',
            'address.city' => 'required|string',
            'address.state' => 'required|string',
            'address.country' => 'required|string',
        ], [
            'address.street.required' => 'The street field is required.',
            'address.city.required' => 'The city field is required.',
            'address.state.required' => 'The state field is required.',
            'address.country.required' => 'The country field is required.',
        ]);

        $user = $this->userService->find($id);
        $this->userService->update($user, $validatedData);

        // Update the user's address
        $user->addresses()->updateOrCreate([], $validatedData['address']);

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
