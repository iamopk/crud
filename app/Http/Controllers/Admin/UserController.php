<?php

namespace App\Http\Controllers\Admin;

use App\City;
use App\Company;
use App\Job;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Kamaln7\Toastr\Facades\Toastr;

class UserController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create', [
            'roles' => User::getRoles(),
            'cities' => City::all(),
            'companies' => Company::all(),
            'jobs' => Job::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'string|nullable',
            'email' => 'required|unique:users,email',
        ]);

        User::create([
            'name' => $request->input('first_name'),
            'password' => bcrypt('123'),
            'email' => $request->input('email'),
            'second_name' => $request->input('last_name'),
            'gender' => $request->input('gender'),
            'suffix' => $request->input('suffix'),
            'address' => $request->input('address'),
            'role' => $request->input('role'),
            'phoneNumber' => $request->input('phone'),
            'city_id' => $request->input('city'),
            'company_id' => $request->input('company'),
            'job_id' => $request->input('jobs'),
        ]);

        Toastr::success('New user is created');

        return redirect(route('admin.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.users.edit', [
            'user' => User::query()->find($id),
            'roles' => User::getRoles(),
            'cities' => City::all(),
            'companies' => Company::all(),
            'jobs' => Job::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'string|nullable',
            'email' => 'required',
        ]);

        User::query()->where('id', $id)->update([
            'name' => $request->input('first_name'),
            'email' => $request->input('email'),
            'second_name' => $request->input('last_name'),
            'gender' => $request->input('gender'),
            'suffix' => $request->input('suffix'),
            'address' => $request->input('address'),
            'role' => $request->input('role'),
            'phoneNumber' => $request->input('phone'),
            'city_id' => $request->input('city'),
            'company_id' => $request->input('company'),
            'job_id' => $request->input('jobs'),
        ]);

        Toastr::success('New user is updated');

        return redirect(route('admin.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::query()->find($id)->delete();

        Toastr::success('User is deleted');

        return redirect(route('admin.index'));
    }
}
