@extends('layout')

@section('content')
    <div class="container min-height mt-3 d-flex flex-column  align-items-center">
        @if(count($notifications) > 0)
            <div class="row d-flex flex-column  align-items-center box_shadow p-3">
                <h3 class="text-success">Notifications</h3>
                <p class="text-muted">Here you can see all of your notifications</p>
                <hr>

                @foreach ($notifications as $notification)
                <div class="col-12 mb-3 border @if (!$notification->read_at) border-success @endif rounded p-3">
                    <div class="row">
                        <div class="col-6">
                            <h5 class="text-success">{{$notification->data['head']}}</h5>
                        </div>
                        <div class="col-6 d-flex justify-content-end">
                            <p class="text-muted">{{$notification->created_at->diffForHumans()}}</p>
                        </div>
                        <div class="col-sm-9">
                            <p class="text-muted"><span style="font-weight: bold">{{$notification->data['greeting']}}</span> . {{$notification->data['body']}}</p>
                        </div>
                        <div class="col-sm-3 d-flex justify-content-end">
                            <a href="{{$notification->data['url']}}?notification_id={{$notification->id}}" class="btn @if (!$notification->read_at) btn-success @else btn-light @endif">Get Details</a>
                        </div>
                    </div>
                </div>
                @endforeach
                
            </div>
        @else
            <h3 class="mt-3">No Notifications</h3>
        @endif
    </div>
@endsection