<?php

namespace App\Http\Controllers;

use App\Rules\NameRuleEi; //madatory to import this rule file from Rules folder=>validation rule
use App\Rules\EmailruleEi;//madatory import 
use Illuminate\Http\Request;

class validationEicontroller extends Controller
{
    public function validate(Request $request){
        $request->validate(
            [
                'name'=>['required',new NameRuleEi],
                'email'=>['required',new EmailruleEi]
            ]
        );
        return "Sucessfully added";
    }
}