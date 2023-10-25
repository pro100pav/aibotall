@extends('layouts.app', ['page_name'=>'Ваша переписка с ботом'])
@section('content')
<div class="card chat dlab-chat-history-box">
    <div class="card-body msg_card_body dlab-scroll ps" id="dlab_W_Contacts_Body3" style="height: 450px;">
        @foreach ($messages as $item)

            @if ($item->messagebot != null)
                <div class="d-flex justify-content-start mb-4" >

                    <div class="msg_cotainer" style="max-width: 50%;background: #f6f6f6;padding: 5px;border-radius: 5px;">
                        {{$item->messagebot}}
                    </div>
                </div>
            @else
                <div class="d-flex justify-content-end mb-4" >
                    <div class="msg_cotainer_send" style="max-width: 50%;background: #f6f6f6;padding: 5px;border-radius: 5px;">
                        {{$item->message_client}}
                    </div>
                </div>
            @endif
        @endforeach
        
        
    <div class="ps__rail-x" style="left: 0px; bottom: 0px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 0px; right: 0px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div></div></div>
    {{-- <div class="card-footer type_msg">
        <div class="input-group">
            <textarea class="form-control" placeholder="Type your message..."></textarea>
            <div class="input-group-append">
                <button type="button" class="btn btn-primary"><i class="fa fa-location-arrow"></i></button>
            </div>
        </div>
    </div> --}}
</div>
@endsection
