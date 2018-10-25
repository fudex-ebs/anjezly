@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">مهاراتى  </div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    @include('includes/flash-message')
                    <form method="POST" action="{{ url('portfolio/add') }}" enctype="multipart/form-data" id="myFrm">
                        {{ csrf_field() }}
                       
                        <div class="col-md-12">
                            <label for="first_name">المهــارات  </label>     
                             
                            <select class="chosen form-control" multiple="true"  name="skills">
                                @foreach($userSkills as $userSkill)
                                    <option value="{{ $userSkill->id }}" selected >{{ $userSkill->title }}</option>
                                @endforeach
                                @foreach($allSkills as $skill)                                   
                                    <option value="{{ $skill->id }}">{{ $skill->title }}</option>                                       
                                @endforeach
                        </select>
                            
                        </div>
                        
                    </form>
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
                    
                    
                    <h3>اعدادات</h3>
                    <ul>
                        <li><a href="{{ url('/personal_info') }}">المعلومات الشخصية</a></li>
                        <li><a href="{{ url('/my_skills') }}">  مهـارتى</a></li>
                        <li><a href="{{ url('/portfolio') }}">  أعمالى</a></li>
                    </ul>
                 </div>
            </div>
        </div>
    </div>
</div>
@endsection