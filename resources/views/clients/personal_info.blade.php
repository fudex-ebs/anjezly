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
                    <form method="POST" action="{{ url('personal_info/update') }}" enctype="multipart/form-data" id="myFrm">
                        {{ csrf_field() }}
                        <div class="text-center col-md-12 col-md-offset-4">
                            @if(Auth::user()->img == null)
                                <img id="preview_image" class="img-responsive img-circle" src="{{asset('images/avatar.png')}}"/>
                            @else 
                                <img id="preview_image" class="img-responsive img-circle" src="{{asset('uploads')}}/{{ Auth::user()->img }}"/>
                            @endif
                            <div class="text-center loadImgDiv">
                            <i id="loading" class="fa fa-spinner fa-spin fa-3x fa-fw"></i> <br/>
                                <a href="javascript:changeProfile()" style="text-decoration: none;">
                                <i class="fa fa-camera"></i> تغير الصورة الشخصية
                                                </a>&nbsp;&nbsp;                                
                                <!--<a href="javascript:removeFile()" style="color: red;text-decoration: none;">Remove</a>-->                                                            
                                <input type="file" name="img" id="img" class="text-center" style="display: none;"/>
                                <input type="hidden" id="file_name"/>
                            </div>
                        </div>
                        <br/><br/>
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
                        <div class="clearfix"></div><hr/> 
                        <div class="col-md-12">
                            <label for="bio">نبذه تعريفية  </label>
                            <textarea name="bio" id="bio" class="form-control">{{ Auth::user()->bio }}</textarea>
                        </div>
                        <div class="col-md-6">
                            <label for="category">التخصص    </label>
                            <select name="category" id="category" class="form-control">
                                @foreach($categories as $category)
                                <option value="{{ $category->id }}" @if($category->id == Auth::user()->category) selected @endif>
                                        {{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="renter">نوع الحساب    </label>
                            <input type="checkbox" name="renter" value="1" @if(Auth::user()->renter == 1) checked @endif /> صاحب عمل                            
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