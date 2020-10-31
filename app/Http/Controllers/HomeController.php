<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

class HomeController extends Controller implements HomeInterface
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('guest');
    }


    /**
     * get API data.
     *
     * @return array
     */
    public function api(): array
    {
        // read json url and decode it to array 
        return json_decode(file_get_contents(
                'https://api.coindesk.com/v1/bpi/historical/close.json'), true);
    }    

    /**
     * Filter Json Array.
     *
     * @param array $array
     * @param date $startDate
     * @param date $endDate
     * @return array
     */
    public function filterArray(array $array = [],string $startDate,string $endDate): array
    {
        // filter array based on start and end date
        $filteredArray = array_filter($array, function ($k) use ($startDate,$endDate) {
            
                // convert start date to timestamp
               $from = strtotime($startDate);
                
                // convert end date to timestamp            
               $to = strtotime($endDate);
            
               // convert array key date to timestamp            
               $ts = strtotime($k);
            
                // check if date is between start and end timestamp
               if ($ts >= $from && $ts <= $to) return true; // return item if true
            
               return false; // don't return if it's false 
            
        },ARRAY_FILTER_USE_KEY);
        
        // return filtered json array
        return $filteredArray;
    }    
    
    /**
     * Display HomePage View.
     *
     * @return void
     */
    public function index(Request $request)
    {
        // get date from 7 days in Y-m-d format
        $startDate = date('Y-m-d', strtotime('-7 days')); // Y-m-d Date formate

        // get today date in Y-m-d format
        $endDate   = date('Y-m-d'); // Y-m-d Date formate
        
        // Empty Variable
        $success   = '';
        
        // Validate if the request is post (Form Request) 
       if($request->isMethod('post'))
        {
            // validate request start_date and end date 
            $this->validate($request,[
                'start_date'    => 'required|date|date_format:Y-m-d|before:today|before:end_date|after:today -30 days',
                'end_date'      => 'required|date|date_format:Y-m-d|after_or_equal:start_date|before_or_equal:today',
            ]);
            
            // received start date 
            $startDate = $request->start_date; 
           
            // request end date
            $endDate = $request->end_date; 
           
           // Succsess Message
            $success = 'Filtered Successfully';
            
        }
        
        // get API data in array response       
        $apiArray  = $this->api(); // array of json
        
        // Filter Array       
        $filterdArray  = $this->filterArray($apiArray["bpi"],$startDate,$endDate); // filtered array
        
        // Json  array of filtered array keys      
        $days = json_encode(array_keys($filterdArray)); // Json array
        
        // Json  array of filtered array values              
        $prices = json_encode(array_values($filterdArray)); // Json array
        
        // view index
        return view('index',compact('days','prices','startDate','endDate'))->with('success',$success);;
    
    }
    
}