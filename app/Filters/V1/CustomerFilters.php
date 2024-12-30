<?php
namespace App\Filters\V1;
use Illuminate\Http\Request;
use App\Filters\ApiFilter;

class CustomerFilters extends ApiFilter
{

    protected $allowedParms=[
      'name'=>['eq'],
      'type' => ['eq'],
      'email' => ['eq'],
      'phone' => ['eq'],
      'address' => ['eq'],
      'postalCode' => ['eq','lt','gt'],
      'city' => ['eq'],
      'state' => ['eq'],
    
    ];
    protected $columnMap=[
        'postalCode' => 'postal_code',

    ];
    protected $operatorMap=[
        'eq' => '=',
        'lt' => '<',
        'gt' => '>',
    ];
}
    