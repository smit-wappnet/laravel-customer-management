<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;


class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::all();
        $data = compact("customers");
        return view("home", $data);
    }
    
    public function store(Request $request)
    {
        $request->validate([
            "firstname" => "required",
            "middlename" => "required",
            "lastname" => "required",
            "mobile" => "required",
            "email" => "required",
            "city" => "required"
        ]);
        $customer = new Customer();
        $customer->firstname = $request->firstname;
        $customer->middlename = $request->middlename;
        $customer->lastname = $request->lastname;
        $customer->mobile = $request->mobile;
        $customer->email = $request->email;
        $customer->city = $request->city;
        $customer->save();
        Session::flash('message', 'Customer Added');
        return redirect()->route("home");
    }

    public function edit(Customer $customer)
    {
        $data = compact("customer");
        return view("home", $data);
    }

    public function update(Request $request, Customer $customer)
    {
        //
        $customer->firstname = $request->firstname;
        $customer->middlename = $request->middlename;
        $customer->lastname = $request->lastname;
        $customer->mobile = $request->mobile;
        $customer->email = $request->email;
        $customer->city = $request->city;
        $customer->save();
        Session::flash('message', 'Customer Updated');
        return redirect()->route("home");
    }

    public function destroy(Customer $customer)
    {
        $customer->delete();
        Session::flash('message', 'Customer Deleted');
        return redirect()->back();
    }

    public function getData(Request $request) {

        $draw 				= 		$request->get('draw'); // Internal use
        $start 				= 		$request->get("start"); // where to start next records for pagination
        $rowPerPage 		= 		$request->get("length"); // How many recods needed per page for pagination

        $orderArray 	   = 		$request->get('order');
        $columnNameArray 	= 		$request->get('columns'); // It will give us columns array
                            
        $searchArray 		= 		$request->get('search');
        $columnIndex 		= 		$orderArray[0]['column'];  // This will let us know,
                                                            // which column index should be sorted 
                                                            // 0 = id, 1 = name, 2 = email , 3 = created_at

        $columnName 		= 		$columnNameArray[$columnIndex]['data']; // Here we will get column name, 
                                                                        // Base on the index we get

        $columnSortOrder 	= 		$orderArray[0]['dir']; // This will get us order direction(ASC/DESC)
        $searchValue 		= 		$searchArray['value']; // This is search value 


        $users = DB::table('customers');
        $total = $users->count();

        $totalFilter = DB::table('customers');
        if (!empty($searchValue)) {
            $totalFilter = $totalFilter->where('firstname','like','%'.$searchValue.'%');
            $totalFilter = $totalFilter->orWhere('middlename','like','%'.$searchValue.'%');
        }
        $totalFilter = $totalFilter->count();


        $arrData = DB::table('customers');
        $arrData = $arrData->skip($start)->take($rowPerPage);
        $arrData = $arrData->orderBy($columnName,$columnSortOrder);

        if (!empty($searchValue)) {
            $arrData = $arrData->where('firstname','like','%'.$searchValue.'%');
            $arrData = $arrData->orWhere('middlename','like','%'.$searchValue.'%');
        }

        $arrData = $arrData->get();

        $data = array();
        foreach($arrData as $customer)
        {
            $data[] = (array)$customer;
        }
        
        foreach($data as $key => $customer)
        {
            $data[$key]["action"] = '<a href="'.route('edit', ['customer' => $customer["id"]]).'"class="btn btn-primary m-2">Edit</a>'.'<a href="'.route('delete', ['customer' => $customer["id"]]).'"class="btn btn-danger m-2">Delete</a>';
        }

        $response = array(
            "draw" => intval($draw),
            "recordsTotal" => $total,
            "recordsFiltered" => $totalFilter,
            "data" => $data,
        );

        return response()->json($response);
    }
}
