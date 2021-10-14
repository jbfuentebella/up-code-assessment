<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

use App\Models\Company;
use App\Models\UserCompanyLink;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('company.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('company.create')->with('company', new Company);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:companies,name',
        ]);

        company::create($request->all());

        return redirect()->route('company.index')
            ->with('success', 'Company created successfully.');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $company = Company::findOrFail($id);

        return view('company.edit')->with('company', $company);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $company = Company::findOrFail($id);

        $company->update($request->all());

        return redirect()->route('company.index')
            ->with('success', 'Company updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $company = Company::findOrFail($id);
        $userCompanyLink = new UserCompanyLink();

        $company->delete();
        $userCompanyLink->removeAllUserConnections($company);
    
        return redirect()->route('company.index')
                ->with('success','company deleted successfully');
    }

    public function getList(Request $request)
    {
        if ($request->ajax()) {
            $data = Company::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '
                        <form action="'.route('company.destroy', $row->id).'" method="POST">
                            <a class="btn btn-primary" href="'. route('usercompanylink.show', $row->id) .'">Add User</a>
                            <a class="btn btn-warning" href="'. route('company.edit', $row->id) .'">Edit</a>
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="_token" value="'. csrf_token() .'">
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    ';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
}
