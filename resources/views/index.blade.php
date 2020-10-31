@extends('layouts.app') 

@section('content')

<!-- Start Container -->
<div class="container">
    
    <!-- Start Row -->
    <div class="row justify-content-center">
        
        <!-- Start Column -->
        <div class="col-md-12">
            
            <!-- Start Card -->
            <div class="card mt-5">
                
                <!-- Start Card Header -->
                <div class="card-header">{{ __('Bitcoint Price Form') }}</div> 
                <!-- End Card Header -->

                <!-- Start Card Body -->
                <div class="card-body ">
                    @if($success)
                       <div class="alert alert-success col-md-12">
                            {{ $success }}
                        </div>
                    @endif
                    <!-- Start Form -->
                    <form method="POST" action="{{ route('index.update') }}" class="row"> 
                        
                       <!-- CSRF Security Token -->   

                        <!-- Start Form Group -->   
                        <div class="form-group col-md-6">
                            
                            <label>{{ __('Start Date') }}</label>
                            
                            <input type="date" name="start_date" required="required" class="form-control" value="{{$startDate}}"> 
                            
                            
                        </div>
                        <!-- End Form Group -->   
                        
                        <!-- Start Form Group -->                           
                        <div class="form-group col-md-6">
                            
                            <label>{{ __('End Date') }}</label>
                            
                            <input type="date" name="end_date" required="required" class="form-control " value="{{$endDate}}"> 
                            
                        </div>
                        
                        <!-- End Form Group -->   
                        <div class="col-md-12 text-center">
                            
                            <!-- Start Note -->   
                            <p>Please choose Date between 30 Days from Now</p>
                            <!-- End Note -->                               
                            
                            <!-- Form Submit Button -->   
                            <button class="btn btn-primary" type="submit" name="filter">{{ __('Submit') }}</button>
                            
                        </div>
                        
                    </form>
                    <!-- End Form -->
                    
                </div>
                <!-- End Card Body -->
                
            </div>
            <!-- End Card -->
            
        </div>
        <!-- End Column -->
        
    </div>
    <!-- End Row -->
    
    <!-- Start Row -->
    <div class="row justify-content-center">
        
        <!-- Start Column -->
        <div class="col-md-12">
            
            <!-- Start Card -->
            <div class="card mt-3 mb-5">
                
                <!-- Start Card Header-->
                <div class="card-header">{{ __('Chart') }} <span class="float-right">  {{$startDate}} {{ __('to') }} {{$endDate}} </span></div>
                <!-- End Card Header-->

                <!-- Start Card Body-->                
                <div class="card-body ">
                    
                    <!-- Start Chart Canvas-->                    
                    <canvas id="bitcoinChart"></canvas>
                    <!-- End Chart Canvas-->                    
                    
                </div>
                <!-- Start Card Body-->
                
            </div>
            <!-- End Card -->
            
        </div>
         <!-- End Coulmn -->
        
    </div>
    <!-- End Row -->
    
</div> 
<!-- End Container -->

@endsection 

<!-- Start Script Section -->

@section('scripts')

<script>
    
    // days array as  x-axis
    var days  = {!! $days !!};
    
    // prices array in usd as y-axis.
    var prices = {!!$prices !!}
    
    // the element to render the chart
    var ctx = document.getElementById('bitcoinChart').getContext('2d');
    
    // initialize chart
    var chart = new Chart(ctx, {
        // The type of chart we want to create
        type: 'line'
        , // The data for our dataset
        data: {
            labels: days
            , datasets: [{
                label: 'Bitcoin Price'
                , backgroundColor: 'rgb(252, 204, 64)'
                , borderColor: 'rgb(252, 204, 64)'
                , data: prices
                , fill: false
                , showLine: true
                }]
        }
        , // Configuration options go here
        options: {
            tooltips: {
                enabled: true
                , mode: 'single'
                , callbacks: {
                    label: function (tooltipItems, data) {
                        return tooltipItems.yLabel + ' USD';
                    }
                }
            }
            , scales: {
                yAxes: [{
                    ticks: {
                        // Include a dollar sign in the ticks
                        callback: function (value, index, values) {
                            return '$ ' + value;
                        }
                    }
                }]
            }
        }
    });
</script> 

@endsection

<!-- End Script Section -->
