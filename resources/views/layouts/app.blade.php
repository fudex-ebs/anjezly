<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'انجزلى') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/dev.css') }}" rel="stylesheet">
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/chosen/1.4.2/chosen.min.css">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'انجزلى') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        <li><a href="{{ url('/project/add') }}">أضف مشروع</a></li>
                        @if (Auth::guest())
                            <li><a href="{{ route('login') }}">دخول</a></li>
                            <li><a href="{{ route('register') }}">تسجيل</a></li>
                            
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            خروج
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"
        integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
    <script src="https://use.fontawesome.com/2c7a93b259.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <!--<script src="https://twitter.github.io/typeahead.js/releases/latest/typeahead.bundle.js"></script>-->
    
    <script src="//cdnjs.cloudflare.com/ajax/libs/chosen/1.4.2/chosen.jquery.min.js"></script>
    <script src="{{ asset('js/myScript.js') }}"></script>
    
    <script>
     function upload(img){
           $('#loading').css('display', 'block');
            jQuery.ajax({
              url:"{{url('uploadUserImg')}}",
               headers: {
                 'X-CSRF-TOKEN': "{{csrf_token()}}"
                 },
              data:new FormData($("#myFrm")[0]),
              method:"POST",
              processData: false,
              contentType: false,
              success:function(data){  
                $('#loading').css('display', 'none');
                $('#preview_image').attr('src', '{{asset('uploads')}}/' + data);
                console.log(data);
              },
              error:function(error){
                  $('#loading').css('display', 'none');
                  $('#preview_image').attr('src', '{{asset('images/avatar.png')}}');
                  console.log(error);
              }
           });
    };    
    
//    --------------------------------------
    jQuery(document).ready(function(){
        jQuery(".chosen").chosen();
        jQuery(".chosen").chosen().change(function (e,params){                          
            var skills_id =  $(this).val();
            var _token = "{{ csrf_token() }}";                         
            $.ajax({
                type: 'POST',
                url: "{{ url('updateSkills') }}",
                data: {  _token:_token ,skills_id:skills_id },
                success: function(response) {                                           
                }
            });
            
            if(params.deselected){ 
                $.ajax({
                    type: 'GET',
                    url: "{{ url('my_skills/delete') }}",
                    data: {  _token:_token ,item_id:params.deselected },
                    success: function(response) {   
                    }
                });
            }else{ 
//               alert("selected: " + params.selected);
            }
        })
                
    });
    
    $(document).ready(function() {
        $('.portfolio_publish:checkbox').bind('change', function(e) {
            var _token = "{{ csrf_token() }}";                         
            var item_id = $(this).val();
            $.ajax({
                    type: 'GET',
                    url: "{{ url('portfolio/changeStatus') }}",
                    data: {  _token:_token ,item_id:item_id },
                    success: function(response) {
                       
                    }
            });
        })
        
        $(".deleteRow").click(function (){
           var item_id = $(this).prev().prev().val();
           var _token = "{{ csrf_token() }}";
           var tbl = $(this).next().val();
           
           $.ajax({
                    type: 'GET',
                    url: "{{ url('/dashboard/deleteItem') }}",
                    data: {  _token:_token ,item_id:item_id,tbl:tbl },
                    success: function(response) {                       
                    }
            });
            $(this).closest('tr').remove();
        });
    });
 
    </script>
</body>
</html>
