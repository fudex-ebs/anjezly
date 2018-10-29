@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading"> تعديل  | {{ $item->title }}  </div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    @include('includes/flash-message')
                    <form method="POST" action="{{ url('portfolio/update') }}/{{ $item->id }}" enctype="multipart/form-data" id="myFrm">
                        {{ csrf_field() }}
                         <div class="col-md-12">
                            <label for="title">  صورة العمل  </label>
                            <input type="file" name="file" />
                            <img src="{{ asset('uploads') }}/{{$item->img}}" width="100" class="img-circle img-responsive text-left" />
                        </div>
                        <div class="col-md-12">
                            <label for="title">  اسم العمل</label>
                            <input type="text" name="title" id="title" class="form-control" required="" value="{{$item->title}}"/>
                        </div>
                         <div class="col-md-12">
                            <label for="description">وصف العمل    </label>
                            <textarea name="description" id="description" class="form-control">{{$item->description}}</textarea>
                        </div>
                        <div class="col-md-6">
                            <label for="link">رابط العمل  </label>
                            <input type="url" name="link" id="link" class="form-control" value="{{$item->link}}"/>
                        </div>
                        <div class="col-md-6">
                            <label for="end_date">تاريخ انتهاء المشروع  </label>
                            <input type="date" name="end_date" id="end_date" class="form-control" value="{{$item->end_date}}"/>
                        </div>
                        <div class="col-md-12">
                            <label for="skills_in">المهــارات  </label>    
                             
                            <select class="chosen form-control" multiple="true"  name="skills_in[]"> 
                                @foreach($allSkills as $skill ) 
                                    <option value="{{ $skill->id }}">{{ $skill->title }}</option>                                
                                @endforeach
                                
                                @foreach($allSkills as $skill ) 
                                @foreach($mySkills as $sk)
                                    @if($sk == $skill->id)
                                    <option value="{{ $skill->id }}" selected="">{{ $skill->title }}</option>   
                                    @endif
                                @endforeach
                                @endforeach
                            </select>
                        </div>
                        <div class="clearfix"></div><br/>
                        <div class="col-md-9 text-center col-md-offset-4">
                            <input type="submit" value="تعديل" class="btn btn-success col-md-6" />
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