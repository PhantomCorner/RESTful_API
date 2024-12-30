<?php
namespace App\Services\V1;
use Illuminate\Http\Request;

class CustomerQuery{

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

    public function transform(Request $request): array
    {
        $queryItems=[];
        foreach($this->allowedParms as $parm => $operators){
            $query=$request->query($parm);
            if(!isset($query)){
                continue;
            }
            $column = $this->columnMap[$parm] ?? $parm;
            foreach($operators as $operator){
               if(isset($query[$operator])){
                $queryItems[] = [$column, $this->operatorMap[$operator], $query[$operator]];
               }
            }
        }
        return $queryItems;
    }
}
    