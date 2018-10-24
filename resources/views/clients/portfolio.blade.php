@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">أعمالى</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    @include('includes/flash-message')
                    <div class="text-left">
                        <a href="{{ url('/portfolio/add') }}"><i class="fa fa-plus"></i> أضف عمل </a> 
                        <br/><br/>
                    </div>
                    <table class="table table-responsive table-hover">
<!--                        <thead>
                            <tr>
                                <th>الصورة التوضيحية</th>
                                <th>اسم العمل</th>
                                <th>نشر/اخفاء</th>
                                <th>عمليات</th>
                            </tr>
                        </thead>-->
                    @foreach($portfolio as $portf)
                    <tr>
                        <td><img class="img-responsive" width="100" src="{{ asset('uploads') }}/{{ $portf->img }}" /></td>
                        <td><a href="">{{ $portf->title }}</a></td>
                        <td><input class="portfolio_publish" type="checkbox" name="publish" 
                                   value="{{ $portf->id }}" @if($portf->publish == 1) checked @endif /> نشر</td>
                        <td>
                            <input type="hidden" value="{{ $portf->id }}" />
                            <a href="{{ url('portfolio/edit') }}/{{ $portf->id }}"><i class="fa fa-edit"></i> تعديل</a>
                            <a href="javascript:void(0);" class="deleteRow"><i class="fa fa-archive"></i> حذف</a>
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