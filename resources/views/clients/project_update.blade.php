@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading"> تعديل  | {{ $item->name }}  </div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    @include('includes/flash-message')
                    <form method="POST" action="{{ url('project/update') }}/{{ $item->id }}" enctype="multipart/form-data" id="myFrm">
                        {{ csrf_field() }}
                         <div class="col-md-6">
                            <label for="name">اسم المشروع  </label>
                            <input type="text" name="name" id="name" class="form-control" required="" value="{{$item->name}}"/>
                        </div>
                        <div class="col-md-6">
                            <label for="category">القسم    </label>
                            <select name="category" id="category" class="form-control">
                                @foreach($categories as $category)
                                <option value="{{ $category->id }}" @if($item->category == $category->id) selected @endif>
                                        {{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="budget_id">ميزانية المشروع    </label>
                            <select name="budget_id" id="budget_id" class="form-control">
                                @foreach($budgets as $budget)
                                <option value="{{ $budget->id }}" @if($item->budget_id == $budget->id) selected @endif>
                                        {{ $budget->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="duration">فتره انتهاء المشروع  </label>
                            <input type="number" name="duration" id="duration" class="form-control" min="1" value="{{$item->duration}}" /> أيام
                        </div>
                         
                        <div class="clearfix"></div><hr/> 
                        <div class="col-md-12">
                            <label for="description">وصف المشروع  </label>
                            <textarea name="description" id="description" class="form-control" required="">{{$item->description}}</textarea>
                        </div>
                        
                         <div class="col-md-12">
                            <label for="skills">المهارات المطلوبة  </label>                                  
                            <select class="chosen form-control" multiple="true"  name="skills[]"> 
                                
                                @foreach($skills as $skill)    
                                @foreach($mySkills as $mySkill)
                                    @if($mySkill == $skill->id)
                                    <option value="{{$mySkill}}" selected="">{{$skill->title}}</option>
                                    @endif
                                @endforeach
                                    <option value="{{ $skill->id }}" @if($skill->id == $item->skills) @endif>{{ $skill->title }}</option>                                       
                                @endforeach
                        </select>                            
                        </div>
                        <div class="col-md-6">
                            <label for="file"> رفع ملف  </label>
                            <input type="file" name="file" id="file" class="form-control" />                             
                        </div>
                        <div class="col-md-6">
                            @if($item->file != null || $item->file != '') 
                                <label>المرفقات</label> <br/>                           
                                <a href="{{asset('uploads')}}/{{$item->file}}" target="_blank">الملف المرفق</a> 
                            @endif
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