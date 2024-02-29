<?php

namespace App\Http\Controllers;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use function Laravel\Prompts\error;

class UserController extends Controller
{
    public function updateProfile(Request $request)
    {


        $request->validate([
            'username' => 'nullable|max:255',
            'name' => 'required|max:255',
            'location' => 'nullable|max:255',
            'email' => 'required|max:255',
            'phone_number' => 'nullable|min:8|max:16|regex:/^([0-9\s\-\+\(\)]*)$/',
            'street' => 'nullable|string|max:255',
            'house_number' => 'nullable|string|max:10',
            'postcode' => 'nullable|max:10|regex:/^[0-9 ]+$/',
            'city' => 'nullable|string|max:255',
            'birthday' => 'nullable|string|max:255',
        ]);


        $user = User::find(auth()->id());



        $user->username = $request->input('username');
        $user->name = $request->input('name');
        $user->location = $request->input('location');
        $user->email = $request->input('email');
        $user->phone_number = $request->input('phone_number');
        $user->street = $request->input('street');
        $user->house_number = $request->input('house_number');
        $user->postcode = $request->input('postcode');
        $user->city = $request->input('city');
        if($request->input('birthday') != null){
            $user->birthday = Carbon::createFromFormat('d/m/Y', $request->input('birthday'))->toDateString();
        }

        $user->save();

        //$user->update($request->all());

        return redirect()->back()->with('success', 'Profile updated successfully');


    }

    public function updatePicture(Request $request)
    {
        if ($request->has('profile_picture')) {
            $binaryData = base64_decode($request->input('profile_picture')); // Decode base64-encoded binary data

            $user = User::find(auth()->id());
            $user->profile_picture = $binaryData;

            $user->save();

            return response()->json(['success' => 'File uploaded'], 400);
        } else {
            return response()->json(['error' => 'No file uploaded'], 400);
        }
    }

    public function deletePicture(Request $request)
    {
        $user = User::find(auth()->id());
        $user->profile_picture = null;
        $user->save();
        return redirect()->back()->with('success', 'Profile photo deleted successfully');
    }

    public function removeAdmin($userId)
    {
        if (auth()->user()->is_admin){
            $admin = User::find($userId);

            if ($admin && $admin->is_admin) {
                $admin->is_admin = false;
                $admin->save();
            }
        }

        return redirect()->back();

    }

    public function addNewAdmin(Request $request)
    {

        if (auth()->user()->is_admin){
            $validatedData = $request->validate([
                'assignee' => 'required|exists:users,id'
            ]);

            $user = User::findOrFail($validatedData['assignee']);

            $user->is_admin = true;
            $user->save();
        }


        return redirect()->back()->with('success', 'New admin added successfully');
    }
}
