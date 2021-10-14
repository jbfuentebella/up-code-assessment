<?php

namespace App\Http\Controllers;

use App\Models\UserCompanyLink;
use App\Models\User;
use App\Models\Company;
use Illuminate\Http\Request;

class UserCompanyLinkController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserCompanyLink  $userCompanyLink
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $company = Company::findOrFail($id);

        return view('company.add-user')->with([
            'users' => User::all(),
            'company' => $company
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserCompanyLink  $userCompanyLink
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $company = Company::findOrFail($id);

        $input = $request->all();
        $userCompanyLink = new UserCompanyLink();

        if (isset($input['users'])) {
            $userCompanyLink->updateUserCompanyLinking($company, $input['users']);
        } else {
            $userCompanyLink->removeAllUserConnections($company);
        }


        return redirect()->route('company.index')
            ->with('success', 'Company\'s user(s) linked successfully');
    }
}
