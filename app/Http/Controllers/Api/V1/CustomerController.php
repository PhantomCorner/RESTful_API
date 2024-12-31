<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Resources\V1\CustomerResource;
use App\Http\Resources\V1\CustomerCollection;
use App\Filters\V1\CustomerFilters;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        // return customers paginated
        // return new CustomerCollection(Customer::paginate());

        // return all customers
        // return new CustomerCollection(Customer::all());

        // receive a query parameter to filter customers
        $filter =new CustomerFilters();
        $filterItems= $filter ->transform($request);
        // if user needs to include invoices
        $includeInvoices = $request->query('includeInvoices');
        $customers= Customer::where($filterItems);
        if($includeInvoices){
            $customers->with('invoices');
        }
        return new CustomerCollection($customers->paginate());
        
      
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCustomerRequest $request)
    {
        return new CustomerResource(Customer::create($request->all()));
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer,Request $request)
    {
        // if user needs to include invoices
        $includeInvoices = $request->query('includeInvoices');
        if($includeInvoices){
          return new CustomerResource($customer->loadMissing('invoices')) ;
        }
        //
       return new CustomerResource($customer);
    }

    /**
     * Show the form for editing the specified resource.
     */
        
    public function edit(Request $request, Customer $customer)
    {
        //
    
      
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        //
        $customer->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        //
    }
}
