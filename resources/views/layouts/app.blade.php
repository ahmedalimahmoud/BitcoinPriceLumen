<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>        
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ env('APP_NAME')}}</title>
        
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
            
    </head>
    
     <body>
         
        <!-- Start Body -->         
         <main>
             
            <!-- Start Content -->         
             @yield('content')  
            <!-- End Content -->         
                          
         </main>
        <!-- End Body -->         

        <!-- Chart js  -->
         <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>

        <!-- Custom Script  -->
         @yield('scripts')
         
    </body>
</html>
