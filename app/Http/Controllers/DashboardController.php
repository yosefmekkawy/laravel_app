<?php

namespace App\Http\Controllers;

use App\Http\Resources\ContactResource;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Models\Contact;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function users()
    {
        $data = User::query()
            ->with('image')
            ->orderBy('id','DESC')
            ->paginate(5);
//            ->get();
        $users=UserResource::collection($data);
        return view('admin.users',compact('users'));
    }
    public function edit_user($id)
    {
        $user = User::findOrFail($id);
        return view('admin.edit_user', compact('user'));

    }

    public function update_user(Request $request, $id)
    {
        $validatedData = $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8|confirmed',
            'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $user = User::findOrFail($id);

        $user->username = $validatedData['username'];
        $user->email = $validatedData['email'];

        if (!empty($validatedData['password'])) {
            $user->password = bcrypt($validatedData['password']);
        }

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);

            $user->image()->updateOrCreate(
                ['imageable_id' => $user->id, 'imageable_type' => User::class],
                ['name' => $imageName]
            );
        }

        $user->save();

        return redirect()->route('dashboard.edit.user', $user->id)->with('success', 'Updated successfully!');
    }

    public function contacts()
    {
        $data = Contact::all();

        $contacts=ContactResource::collection($data);
//        return $contacts;
        return view('admin.contacts',compact('contacts'));
    }
}
