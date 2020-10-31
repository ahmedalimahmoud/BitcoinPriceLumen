<?php

class BitcoinPriceTest extends TestCase
{

    /**
     * Test if start date is Empty.
     *
     * @return void
     */
    public function test_start_and_end_date_is_empty()
    {
        // show  actiual errors without handling
        //$this->withoutExceptionHandling();
        
        $this->json('POST', '/', array_merge($this->data(),['start_date'=>'']))
             ->seeJson([
                'start_date' => ["The start date field is required."]
             ]);

    }
    
    /**
     * Test if end date is Empty.
     *
     * @return void
     */
    public function test_end_date_is_empty()
    {
        // show  actiual errors without handling
        //$this->withoutExceptionHandling();
        
        $this->json('POST', '/', array_merge($this->data(),['end_date'=>'']))
             ->seeJson([
                'end_date' => ["The end date field is required."]
             ]);
        
    }

    /**
     * Test Start date Format Y-m-d.
     *
     * @return void
     */
    public function test_start_date_format_type()
    {
        // show  actiual errors without handling
        //$this->withoutExceptionHandling();
        
        $this->json('POST', '/', array_merge($this->data(),['start_date'=>'abc']))
             ->seeJson([
                'start_date' => ["The start date does not match the format Y-m-d.","The start date is not a valid date.","The start date must be a date after today -30 days.","The start date must be a date before end date.","The start date must be a date before today."]
             ]);
        
    }

    /**
     * Test End date Format Y-m-d.
     *
     * @return void
     */
    public function test_end_date_format_type()
    {
        // show  actiual errors without handling
        ////$this->withoutExceptionHandling();
        
        $this->json('POST', '/', array_merge($this->data(),['end_date'=>'abc']))
             ->seeJson([
                'end_date' => ["The end date does not match the format Y-m-d.","The end date is not a valid date.","The end date must be a date after or equal to start date.","The end date must be a date before or equal to today."]
             ]);
    }
    
    /**
     * test if start date is before 30 days from now.
     *
     * @return void
     */
    
    public function test_start_date_before_more_than_30_days()
    {
        // show  actiual errors without handling
        //$this->withoutExceptionHandling();
        
        $this->json('POST', '/', array_merge($this->data(),['start_date'=>date('Y-m-d', strtotime('-35 days'))]))
             ->seeJson([
                'start_date' => ["The start date must be a date after today -30 days."]
             ]);
        
    }
    
    /**
     * Test if end date is before more than 30 days from now.
     *
     * @return void
     */
    
    public function test_end_date_before_more_than_30_days()
    {
        // show  actiual errors without handling
        //$this->withoutExceptionHandling();
        
        $this->json('POST', '/', array_merge($this->data(),['end_date'=>date('Y-m-d', strtotime('-35 days'))]))
             ->seeJson([
                'end_date' => ["The end date must be a date after or equal to start date."]
             ]);
        
        
    }

    /**
     * test if end date is before start date.
     *
     * @return void
     */
    
    public function test_end_date_is_before_start_date()
    {
        // show  actiual errors without handling
        //$this->withoutExceptionHandling();
        
        $this->json('POST', '/', array_merge($this->data(),['start_date'=>date('Y-m-d'),'end_date'=>date('Y-m-d', strtotime('-35 days'))]))
             ->seeJson([
                'end_date' => ["The end date must be a date after or equal to start date."]
             ]);
        
    }
    
    /**
     * test if start date is after end date.
     *
     * @return void
     */
    
    public function test_start_date_is_after_end_date()
    {
        // show  actiual errors without handling
        //$this->withoutExceptionHandling();
        
        $this->json('POST', '/', array_merge($this->data(),['start_date'=>date('Y-m-d', strtotime('+35 days')),'end_date'=>date('Y-m-d')]))
             ->seeJson([
                'start_date' => ["The start date must be a date before end date.","The start date must be a date before today."]
             ]);
    
    }
    
    /**
    * Data provided for test methods below
    *
    * @return Array
    */
    
    private function data()
    {
        return [
            'start_date'=>date('Y-m-d', strtotime('-7 days')),
            'end_date'=>date('Y-m-d')
        ];
    }
}
