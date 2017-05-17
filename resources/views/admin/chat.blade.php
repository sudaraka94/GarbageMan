@extends('layouts.app')

@section('content')
<div class="container">
    <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">

    <div class="container">
        <div style="text-align: center">
            <h3>User Complaints</h3>
        </div>
        <div class="row">

            <div class="conversation-wrap col-lg-3">

                @foreach($complaints as $complaint)
                    <a href="{{route('admin_complaints',['id'=>$complaint->id])}}">
                        <div class="media conversation">
                            <div class="pull-left">
                                <img class="media-object" alt="user Image" style="width: 50px; height: 50px;" src="{{asset('img/user.png')}}">
                            </div>
                            <div class="media-body">
                                <h5 class="media-heading">{{$complaint->user->name}}</h5>
                                <small>{{str_limit($complaint->complaint, $limit = 30, $end = '...')}}</small>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>



            <div class="message-wrap col-lg-8">
                <div class="msg-wrap">


                    <div class="media msg ">
                        <div class="pull-left" >
                            <img class="media-object" alt="user Image" style="width: 50px; height: 50px;" src="{{asset('img/user.png')}}">
                        </div>
                        <div class="media-body">
                            <small class="pull-right time"><i class="fa fa-clock-o"></i> {{$complaint_sel->created_at}}</small>
                            <h5 class="media-heading">{{$complaint_sel->user->name}}</h5>
                            <small class="col-lg-10">{{$complaint_sel->complaint}}</small>
                        </div>
                    </div>
                    @foreach($complaint_sel->complaint_replies as $reply)
                        <div class="media msg ">
                            <div class="pull-left" >
                                <img class="media-object" alt="user Image" style="width: 50px; height: 50px;" src="{{asset('img/user.png')}}">
                            </div>
                            <div class="media-body">
                                <small class="pull-right time"><i class="fa fa-clock-o"></i> {{$reply->created_at}}</small>
                                <h5 class="media-heading">{{$reply->user->name}}</h5>
                                <small class="col-lg-10">{{$reply->message}}</small>
                            </div>
                        </div>
                    @endforeach

                </div>

                <form action="{{route('post_reply')}}" method="post">
                    <div class="send-wrap ">
                        <input type="hidden" value="{{$complaint_sel->id}}" name="complaint_id">
                        <textarea class="form-control send-message" name="complaint" rows="3" placeholder="Write a reply..."></textarea>
{{csrf_field()}}

                    </div>
                    <div class="btn-panel">
                        <input class=" col-lg-12 text-center btn btn-default send-message-btn" type="submit" value="Send Message">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
    <style>
        .conversation-wrap
        {
            box-shadow: -2px 0 3px #ddd;
            padding:0;
            max-height: 400px;
            overflow: auto;
        }
        .conversation
        {
            padding:5px;
            border-bottom:1px solid #ddd;
            margin:0;

        }

        .message-wrap
        {
            box-shadow: 0 0 3px #ddd;
            padding:0;

        }
        .msg
        {
            padding:5px;
            /*border-bottom:1px solid #ddd;*/
            margin:0;
        }
        .msg-wrap
        {
            padding:10px;
            max-height: 400px;
            overflow: auto;

        }

        .time
        {
            color:#bfbfbf;
        }

        .send-wrap
        {
            border-top: 1px solid #eee;
            border-bottom: 1px solid #eee;
            padding:10px;
            /*background: #f8f8f8;*/
        }

        .send-message
        {
            resize: none;
        }

        .highlight
        {
            background-color: #f7f7f9;
            border: 1px solid #e1e1e8;
        }

        .send-message-btn
        {
            border-top-left-radius: 0;
            border-top-right-radius: 0;
            border-bottom-left-radius: 0;
            border-bottom-right-radius: 0;
        }
        .btn-panel
        {
            background: #f7f7f9;
        }

        .btn-panel .btn
        {
            color:#b8b8b8;

            transition: 0.2s all ease-in-out;
        }

        .btn-panel .btn:hover
        {
            color:#666;
            background: #f8f8f8;
        }
        .btn-panel .btn:active
        {
            background: #f8f8f8;
            box-shadow: 0 0 1px #ddd;
        }

        .btn-panel-conversation .btn,.btn-panel-msg .btn
        {

            background: #f8f8f8;
        }
        .btn-panel-conversation .btn:first-child
        {
            border-right: 1px solid #ddd;
        }

        .msg-wrap .media-heading
        {
            color:#003bb3;
            font-weight: 700;
        }


        .msg-date
        {
            background: none;
            text-align: center;
            color:#aaa;
            border:none;
            box-shadow: none;
            border-bottom: 1px solid #ddd;
        }


        body::-webkit-scrollbar {
            width: 12px;
        }


        /* Let's get this party started */
        ::-webkit-scrollbar {
            width: 6px;
        }

        /* Track */
        ::-webkit-scrollbar-track {
            -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
            /*        -webkit-border-radius: 10px;
                    border-radius: 10px;*/
        }

        /* Handle */
        ::-webkit-scrollbar-thumb {
            /*        -webkit-border-radius: 10px;
                    border-radius: 10px;*/
            background:#ddd;
            -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.5);
        }
        ::-webkit-scrollbar-thumb:window-inactive {
            background: #ddd;
        }

    </style>
@endsection
