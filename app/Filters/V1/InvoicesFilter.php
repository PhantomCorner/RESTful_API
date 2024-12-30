<?php
namespace App\Filters\V1;
use Illuminate\Http\Request;
use App\Filters\ApiFilter;

class InvoicesFilter extends ApiFilter{


    protected $allowedParms=[
      'customerId'=>['eq'],
      'amount' => ['eq'],
      'status' => ['eq','ne'],
      'billedDate' => ['eq','lt','gt'],
      'paidDate' => ['eq','lt','gt'],
    ];
    protected $columnMap=[
        'customerId' => 'customer_id',
        'billedDate' => 'billed_date',
        'paidDate' => 'paid_date',
    ];
    protected $operatorMap=[
        'eq' => '=',
        'lt' => '<',
        'gt' => '>',
        'ne' => '!=',
        
    ];
}