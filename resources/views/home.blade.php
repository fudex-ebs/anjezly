@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                    
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-default">
                 <div class="panel-body">
                    @if (Auth::check())
                        {{ Auth::user()->first_name }}
                        <img class="img-circle img-responsive" src=""/>
                    @endif
                    
                    <hr/>
                    <h3>اعدادات</h3>
                    <ul>
                        <li><a href="{{ url('/dashboard/personal_info') }}">المعلومات الشخصية</a></li>
                        <li><a href="{{ url('/dashboard/my_skills') }}">  مهـارتى</a></li>
                        <li><a href="{{ url('/dashboard/portfolio') }}">  أعمالى</a></li>
                        <li><a href="{{ url('/dashboard/my_projects') }}">  مشاريعى</a></li>
                    </ul>
                    
                 </div>
            </div>
        </div>
    </div>
</div>
@endsection
