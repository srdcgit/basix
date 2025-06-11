<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\State;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $creds = ['password' => $request->password];

        // Check if the input is an email
        if (filter_var($request->input('identifier'), FILTER_VALIDATE_EMAIL)) {
            $creds['email'] = $request->input('identifier');
            $user = User::where('email', $request->input('identifier'))->first();
            if (!$user || !in_array($user->role->name, ['Super Admin', 'Project Manager'])) {
                toastr()->error('Unauthorized login attempt. Only Admins and Project Managers can log in using email.');
                return redirect()->back();
            }
        } else if (is_numeric($request->input('identifier'))) {
            $creds['phone'] = $request->input('identifier');
            $user = User::where('phone', $request->input('identifier'))->first();
            if (!$user || in_array($user->role->name, ['Super Admin', 'Project Manager'])) {
                toastr()->error('Unauthorized login attempt. Please use your email to log in as Admin or Project Manager.');
                return redirect()->back();
            }
        } else {
            // For employee code
            $creds['employee_code'] = $request->input('identifier');
            $user = User::where('employee_code', $request->input('identifier'))->first();
            if (!$user || in_array($user->role->name, ['Super Admin', 'Project Manager'])) {
                toastr()->error('Unauthorized login attempt. Please use your email to log in as Admin or Project Manager.');
                return redirect()->back();
            }
        }
        if (!$user) {
            toastr()->error('User is Not Registered.');
            return redirect()->back();
        }

        if (!$user->is_verified || !$user->is_active) {
            toastr()->error('User is Not Active or Verified by Admin. Please contact support.');
            return redirect()->back();
        }
        if (Auth::guard('user')->attempt($creds)) {
            toastr()->success('You Login Successfully');
            switch ($user->role->name) {
                case 'Super Admin':
                    return redirect()->intended(route('admin.dashboard.index'));
                case 'Project Manager':
                    return redirect()->intended(route('project.dashboard.index'));
                case 'Field Staff':
                    return redirect()->intended(route('field_staff.dashboard.index'));
                case 'Crp':
                    return redirect()->intended(route('crp.dashboard.index'));
                case 'Executive':
                    return redirect()->intended(route('executive.dashboard.index'));
                default:
                    Auth::logout();
                    toastr()->error('User is Inactive or Not Verified Yet By Admin.');
                    return redirect()->back();
            }
        } else {
            toastr()->error('Wrong Password.');
            return redirect()->back();
        }
    }
    public function logout()
    {
        Auth::logout();
        toastr()->success('You Logout Successfully');
        return redirect('/');
    }
    public function register(Request $request)
    {
        try {
            $this->validate($request, [
                'name' => 'required',
                'email' => 'required',
                'image' => 'required',
                'password' => 'required',
                'role_id' => 'required',
            ]);
            if ($request->password != $request->confirm_password) {
                toastr()->error('Password do not match');
                return redirect()->back();
            }
            $validator = Validator::make($request->all(), [
                'email' => 'required|unique:users'
            ]);
            if ($validator->fails()) {
                toastr()->error('Email already exists');
                return redirect()->back();
            }
            $user = User::create($request->all());
            toastr()->success('Your Account Has Been successfully Created, Please Login and See Next Step Guides.');
            return redirect(url('/'));
        } catch (Exception $e) {
            toastr()->error($e->getMessage());
            return back();
        }
    }
    public function getCityAgainstStates(Request $request)
    {
        $cities = City::where('state_id', $request->state_id)->get();
        return response()->json($cities);
    }
    public function getStateAgainstCountries(Request $request)
    {
        $states = State::where('country_id', $request->country_id)->get();
        return response()->json($states);
    }
}
