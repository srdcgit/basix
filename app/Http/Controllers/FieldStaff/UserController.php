<?php

namespace App\Http\Controllers\FieldStaff;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserBlock;
use App\Models\UserGramPanchyat;
use App\Models\UserVillage;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('field_staff_id',Auth::user()->id)->get();
        return view('field_staff.user.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('field_staff.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $this->validate($request,[
                'name' => 'required',
                'email' => 'required',
                'role_id' => 'required',
            ]);
            if($request->password != $request->confirm_password)
            {
                toastr()->error('Password do not match');
                return redirect()->back();
            }
            $validator = Validator::make($request->all(),[
                'email' => 'required|unique:users'
            ]);
            if($validator->fails()){
                toastr()->error('Email already exists');
                return redirect()->back();
            }
            $user = User::create($request->all());
            if($request->gram_panchyat_id)
            {
                UserGramPanchyat::create([
                    'gram_panchyat_id' => $request->gram_panchyat_id,
                    'user_id' => $user->id
                ]);
            }
            if($request->block_id)
            {
                UserBlock::create([
                    'block_id' => $request->block_id,
                    'user_id' => $user->id
                ]);
            }
            if($request->village_ids)
            {
                foreach($request->village_ids as $village_id)
                {
                    UserVillage::create([
                        'village_id' => $village_id,
                        'user_id' => $user->id
                    ]);
                }
            }
            toastr()->success('User Added Successfully');
            return redirect()->back();
        }catch (Exception $e)
        {
            toastr()->error($e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {
        $user = User::find($id);
        
        $user_gram_panchyats = UserGramPanchyat::where('user_id',$user->id)->get()->pluck('gram_panchyat_id')->toArray();
        $user_villages = UserVillage::where('user_id',$user->id)->get()->pluck('village_id')->toArray();
        $user_blocks= UserBlock::where('user_id',$user->id)->get()->pluck('block_id')->toArray();
      
        return view('field_staff.user.show',compact('user','user_gram_panchyats','user_villages','user_blocks'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->update($request->all());
        toastr()->success('User Updated successfully');
        return redirect()->back(); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }

    public function verified($id)
    {
        $user = User::find($id);
        $user->update([
            'is_verified' => true
        ]);
        toastr()->success('User Verified Successfully');
        return redirect()->back();
    }
    public function revert_verification($id)
    {
        $user = User::find($id);
        $user->update([
            'is_verified' => false
        ]);
        toastr()->success('User is Not Verified Now!');
        return redirect()->back();
    }
    public function active($id)
    {
        $user = User::find($id);
        $user->update([
            'is_active' => true
        ]);
        toastr()->success('User Active Successfully');
        return redirect()->back();
    }
    public function in_active($id)
    {
        $user = User::find($id);
        $user->update([
            'is_active' => false
        ]);
        toastr()->success('User is In Active Now!');
        return redirect()->back();
    }
}
