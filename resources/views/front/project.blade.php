@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">{{$item->name}}</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    @include('includes/flash-message')
                    
                    <span style="float: left;"><i class="fa fa-clock"></i> {{$item->created_at}}</span>
                    
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>تكلفة المناقصة </th>
                            <td>{{$budget->name}}</td>
                            <th>وقت المناقصة </th>
                            <td>{{$item->duration}}</td>                            
                        </tr>
                        <tr>
                            <th>حالة المشروع </th>
                            <td>{{$status->name}}</td>
                            <th>التصنيف</th>
                            <td>{{$category->name}}</td>
                        </tr>
                        @if($item->file != '')
                        <tr>
                            <th>الملفات الملحقة</th>
                            <td><a href="{{url('uploads')}}/{{$item->file}}">مشاهدة</a></td>
                        </tr>
                        @endif
                    </table>
                    
                    <ul class="skillsBid">
                    @foreach($bidSkills as $bidSkill)
                    <li><a href=""> {{$bidSkill->title}} </a></li>
                    @endforeach
                    </ul>
                    <hr/>
                    <h4>تفاصيل المناقصة</h4>
                    <p>{!! $item->description !!}</p>
                    
                    
                    
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-default">
                 <div class="panel-body">
                     <h4>معلومات عن صاحب المناقصة</h4>
                     <hr/>
                     <div class="col-md-4">
                         @if($client->img != '') <img src="{{asset('uploads')}}/{{$client->img}}" class="img-responsive"/>                         
                         @else
                         <img src="{{asset('images/avatar.png')}}" class="img-responsive"/>
                         @endif
                         <br/><br/>
                         <div class="text-center">
                            <a href="" class="btn btn-primary text-center">اشترك فى المناقصة</a>
                         </div>
                     </div>
                     <div class="col-md-8">{{$client->first_name}}  {{$client->last_name}}</div>
                 </div>
            </div>
        </div>
    </div>
</div>
@endsection