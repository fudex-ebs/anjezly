@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">المعلومات الشخصية</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    @include('includes/flash-message')
                    <form method="POST" action="{{ url('personal_info/update') }}">
                        {{ csrf_field() }}
                        <div class="text-center"><img src="" /> </div>
                        <div class="col-md-6">
                            <label for="first_name">الاسم الاول</label>
                            <input type="text" name="first_name" id="first_name" class="form-control" value="{{ Auth::user()->first_name }}" required=""/>
                        </div>
                        <div class="col-md-6">
                            <label for="last_name">الاسم الأخير</label>
                            <input type="text" name="last_name" id="last_name" class="form-control" value="{{ Auth::user()->last_name }}" />
                        </div>
                        <div class="col-md-6">
                            <label for="mobile">الجوال  </label>
                            <input type="tel" name="mobile" id="mobile" class="form-control" value="{{ Auth::user()->mobile }}" required=""/>
                        </div>
                        <div class="col-md-6">
                            <label for="country">الدولة  </label>
                            <select name="country" id="country" class="form-control">
                                @foreach($countries as $country)
                                <option value="{{ $country->id }}" @if($country->id == Auth::user()->country) selected @endif>
                                        {{ $country->title_ar }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="gender">الجنس  </label>
                            <input type="radio" name="gender" value="male" class="radio-inline" @if(Auth::user()->gender == 'male') checked @endif /> ذكر
                            <input type="radio" name="gender" value="female" class="radio-inline" @if(Auth::user()->gender == 'female') checked @endif /> أنثى
                        </div>
                        <div class="col-md-6">
                            <label for="birth_date">تاريخ الميلاد  </label>
                            <input type="date" name="birth_date" id="birth_date" class="form-control" value="{{ Auth::user()->birth_date }}"/>
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
                        <li><a href="{{ url('/personal_info') }}">المعلومات الشخصية</a></li>
                    </ul>
                 </div>
            </div>
        </div>
    </div>
</div>
@endsection
