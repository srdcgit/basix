<?php

namespace App\Http\Controllers\Project;

use App\Http\Controllers\Controller;
use App\Models\Block;
use App\Models\District;
use App\Models\GramPanchyat;
use App\Models\User;
use App\Models\UserBlock;
use App\Models\UserGramPanchyat;
use App\Models\UserVillage;
use App\Models\Village;
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
        $users = User::where('user_id',Auth::user()->id)->get();
        return view('project.user.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('project.user.create');
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
            if($request->gram_panchyat_ids)
            {
                foreach($request->gram_panchyat_ids as $gram_panchyat_id)
                {
                    UserGramPanchyat::create([
                        'gram_panchyat_id' => $gram_panchyat_id,
                        'user_id' => $user->id
                    ]);
                }
            }
            if($request->block_ids)
            {
                foreach($request->block_ids as $block_id)
                {
                    UserBlock::create([
                        'block_id' => $block_id,
                        'user_id' => $user->id
                    ]);
                }
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
            return redirect()->back()->withInput();
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
        return view('project.user.show',compact('user','user_gram_panchyats','user_villages','user_blocks'));
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
        $delete_existing_panchyat = false;
        if($user->role_id == 4 && $request->role_id == 3)
        {
            $delete_existing_panchyat = true;
        }
        $user->update($request->all());
        if($delete_existing_panchyat)
        {
            UserGramPanchyat::where('user_id',$user->id)->delete();
            UserVillage::where('user_id',$user->id)->delete();
            UserBlock::where('user_id',$user->id)->delete();
        }
        if($request->gram_panchyat_ids)
        {
            UserGramPanchyat::whereNotIn('gram_panchyat_id',$request->gram_panchyat_ids)->where('user_id',$user->id)->delete();
            foreach($request->gram_panchyat_ids as $gram_panchyat_id)
            {
                $gram_panchyat = UserGramPanchyat::where('gram_panchyat_id',$gram_panchyat_id)->where('user_id',$user->id)->first();
                if(!$gram_panchyat)
                {
                    UserGramPanchyat::create([
                        'gram_panchyat_id' => $gram_panchyat_id,
                        'user_id' => $user->id
                    ]);
                }
            }

        }
        if($request->block_ids)
        {
            UserBlock::whereNotIn('block_id',$request->block_ids)->where('user_id',$user->id)->delete();
            foreach($request->block_ids as $block_id)
            {
                $block = UserBlock::where('block_id',$block_id)->where('user_id',$user->id)->first();
                if(!$block)
                {
                    UserBlock::create([
                        'block_id' => $block_id,
                        'user_id' => $user->id
                    ]);
                }
            }

        }
        if($request->village_ids)
        {
            UserVillage::whereNotIn('village_id',$request->village_ids)->where('user_id',$user->id)->delete();
            foreach($request->village_ids as $village_id)
            {
                $village = UserVillage::where('village_id',$village_id)->where('user_id',$user->id)->first();
                if(!$village)
                {
                    UserVillage::create([
                        'village_id' => $village_id,
                        'user_id' => $user->id
                    ]);
                }
            }

        }
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
    public function getDistricts(Request $request)
    {
        $districts = District::where('state_id',$request->state_id)->get();
        return response()->json([
            'districts' => $districts,
        ]);
    }
    public function getBlocks(Request $request)
    {
        $blocks = Block::where('district_id',$request->district_id)->get();
        return response()->json([
            'blocks' => $blocks,
        ]);
    }
    public function getGramPanchyats(Request $request)
    {
        if($request->block_ids)
        {
            $gram_panchyats = GramPanchyat::whereIn('block_id',$request->block_ids)->get();
            return response()->json([
                'gram_panchyats' => $gram_panchyats,
            ]);
        }else{
            return response()->json([
                'gram_panchyats' => [],
            ]);
        }
    }
    public function getVillages(Request $request)
    {
        $villages = Village::whereIn('gram_panchyat_id',$request->gram_panchyat_ids)->get();
        return response()->json([
            'villages' => $villages,
        ]);
    }
}
