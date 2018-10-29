@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">مشاريعى</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    @include('includes/flash-message')
                    <div class="text-left">
                        <a href="{{ url('/project/add') }}"><i class="fa fa-plus"></i> أضف مشروع </a> 
                        <br/><br/>
                    </div>
                    <table class="table table-responsive table-hover">
                        <thead>
                            <tr>                                
                                <th class="text-right">اسم المشروع</th>
                                <th class="text-right">الحالة</th>
                                <th class="text-right">السعر المقترح</th>
                                <th class="text-right">العروض المقدمة</th>
                                <th class="text-right">عمليات</th>
                            </tr>
                        </thead>
                    @foreach($items as $item)
                    <tr>                         
                        <td><a href="{{ url('project') }}/{{ $item->projID }}">{{ $item->projName }}</a></td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->budgName }}</td>
                        <td></td>
                        <td>
                            <input type="hidden" value="{{ $item->projID }}" />
                            <a href="{{ url('project/edit') }}/{{ $item->projID }}"><i class="fa fa-edit"></i> تعديل</a>
                            <a href="javascript:void(0);" class="deleteRow"><i class="fa fa-archive"></i> حذف</a>
                            <input type="hidden" value="projects" />
                        </td>
                    </tr>
                    @endforeach
                        </thead>
                    </table>
                    
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