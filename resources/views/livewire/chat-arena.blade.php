@section('title' , 'Chat Arena')
<div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-10">
                <h3 class=" text-center">Chat Arena</h3>
                @if(Auth::user()->getRoleNames()->first() == 'admin')
                    <a href="{{ route('chat.global-message') }}" class="btn btn-sm btn-primary float-right mb-2">Send Global Message</a>
                @endif
                <div class="messaging">
                    <div class="inbox_msg">
                        <div class="inbox_people">
                            <div class="headind_srch">
                                <div class="recent_heading">
                                    <h4>Recent</h4>
                                </div>
                            </div>
                            <div class="inbox_chat">
                                    @forelse($conversations as $conversation)
                                    @php
                                        $participants = $conversation->getParticipants();
                                    @endphp
                                    <div style="cursor: pointer" class="chat_list {{ $selectedConversationId == $conversation->id ? 'active_chat' : '' }}" wire:click="$set('selectedConversationId', {{ $conversation->id }})">
                                        <div class="chat_people">
                                                <div class="chat_img"><img
                                                        src="">
                                                </div>
                                            <div class="chat_ib">
                                                <h5>{{ $conversation->data['title'] }}</h5>
                                                    <p class="text-muted">{{ $conversation->data['description'] }}</p>
                                                <a href="#" class="btn-link" data-toggle="collapse" data-target="#parti{{ $conversation->id }}">Members</a>

                                                <div wire:ignore id="parti{{ $conversation->id }}" class="collapse">
                                                    @forelse($participants as $participant)
                                                        <a href="{{ route('profile.public' , $participant->id) }}">{{ $participant->name }}</a>
                                                    @empty
                                                    No Member Found
                                                    @endforelse
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                @endforelse

                            </div>
                        </div>

                            <div wire:poll class="mesgs">
                                @if($chat != null)
                                <div class="msg_history">

                                    @forelse($chat as $message)
                                        @php
                                            $sender = null;
                                            $receiver = null;
                                            $authId = Auth::id();
                                            $senderModel = $message->sender;
                                            if($senderModel->id === $authId)
                                                $sender = $senderModel;
                                            else
                                                $receiver = $senderModel;

                                        @endphp
                                        @if($receiver)
                                            <div class="incoming_msg">
                                                @if($receiver->userAvatar)
                                                    <div class="incoming_msg_img"><img
                                                            src="{{ asset('storage/' . $receiver->userAvatar->avatar) }}">
                                                    </div>
                                                @endif
                                                <div class="received_msg">
                                                    <div class="received_withd_msg">
                                                        <p>{{ $receiver->name }}</p>
                                                        <p>{{ $message['body'] }}</p>
                                                        <span
                                                            class="time_date"> {{ \Carbon\Carbon::parse($message->created_at)->diffForHumans() }} </span>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif

                                        @if($sender)
                                            <div class="outgoing_msg">
                                                <div class="sent_msg">
                                                    <p class="float-right">{{ $sender->name }}</p>
                                                    <p>{{ $message['body'] }}</p>
                                                    <span class="time_date">{{ \Carbon\Carbon::parse($message->created_at)->diffForHumans() }}</span>
                                                </div>
                                                @if($sender->userAvatar)
                                                    <div class="receive_msg_img"><img
                                                            src="{{ asset('storage/' . $sender->userAvatar->avatar) }}">
                                                    </div>
                                                @endif

                                            </div>
                                        @endif
                                    @empty
                                    @endforelse

                                    <div class="type_msg">
                                        <div class="input_msg_write">

                                            @if(Auth::user()->getRoleNames()->first() == 'admin')
                                                <input wire:model="messageContent" type="text" class="write_msg"
                                                       placeholder="Type a message"/>
                                            @else
                                                @if($selectedConversationId === 3)
                                                    <input wire:model="messageContent" type="text" class="write_msg"
                                                           placeholder="Type a message"/>
                                                @else
                                                <div class="form-group row">
                                                    <div class="col-md-10">
                                                        <select class="form-control write_msg" wire:model="messageContent">
                                                            <option value="" selected>Select Message</option>
                                                            @forelse($userAssignedMessages as $userAssignedMessage)
                                                                <option value="{{ $userAssignedMessage->message }}">{{ $userAssignedMessage->message }}</option>
                                                            @empty
                                                                <option value="" selected>No Message Found</option>
                                                            @endforelse
                                                        </select>
                                                    </div>
                                                </div>
                                                @endif
                                            @endif
                                            @if(strlen($messageContent) > 0)
                                                <button wire:click="sendMessage" class="msg_send_btn" type="button"><i
                                                        class="fa fa-paper-plane-o"
                                                        aria-hidden="true"></i>Send
                                                </button>
                                            @endif
                                        </div>
                                    </div>

                                </div>
                                @endif
                            </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('styles')
        <style>
            .container {
                max-width: 1170px;
                margin: auto;
            }

            img {
                max-width: 100%;
            }

            .inbox_people {
                background: #f8f8f8 none repeat scroll 0 0;
                float: left;
                overflow: hidden;
                width: 40%;
                border-right: 1px solid #c4c4c4;
            }

            .inbox_msg {
                border: 1px solid #c4c4c4;
                clear: both;
                overflow: hidden;
            }

            .top_spac {
                margin: 20px 0 0;
            }


            .recent_heading {
                float: left;
                width: 40%;
            }

            .srch_bar {
                display: inline-block;
                text-align: right;
                width: 60%;
                padding:
            }

            .headind_srch {
                padding: 10px 29px 10px 20px;
                overflow: hidden;
                border-bottom: 1px solid #c4c4c4;
            }

            .recent_heading h4 {
                color: #990033;
                font-size: 21px;
                margin: auto;
            }

            .srch_bar input {
                border: 1px solid #cdcdcd;
                border-width: 0 0 1px 0;
                width: 80%;
                padding: 2px 0 4px 6px;
                background: none;
            }

            .srch_bar .input-group-addon button {
                background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
                border: medium none;
                padding: 0;
                color: #707070;
                font-size: 18px;
            }

            .srch_bar .input-group-addon {
                margin: 0 0 0 -27px;
            }

            .chat_ib h5 {
                font-size: 15px;
                color: #464646;
                margin: 0 0 8px 0;
            }

            .chat_ib h5 span {
                font-size: 13px;
                float: right;
            }

            .chat_ib p {
                font-size: 14px;
                color: #989898;
                margin: auto
            }

            .chat_img {
                float: left;
                width: 11%;
            }

            .chat_ib {
                float: left;
                padding: 0 0 0 15px;
                width: 88%;
            }

            .chat_people {
                overflow: hidden;
                clear: both;
            }

            .chat_list {
                border-bottom: 1px solid #c4c4c4;
                margin: 0;
                padding: 18px 16px 10px;
            }

            .inbox_chat {
                height: 550px;
                overflow-y: scroll;
            }

            .active_chat {
                background: #ebebeb;
            }

            .incoming_msg_img {
                display: inline-block;
                width: 6%;
            }

            .receive_msg_img {
                display: inline-block;
                float: right;
                width: 6%;
                margin-right: 10px;
            }

            .received_msg {
                display: inline-block;
                padding: 0 0 0 10px;
                vertical-align: top;
                width: 92%;
            }

            .received_withd_msg p {
                background: #ebebeb none repeat scroll 0 0;
                border-radius: 3px;
                color: #646464;
                font-size: 14px;
                margin: 0;
                padding: 5px 10px 5px 12px;
                width: 100%;
            }

            .time_date {
                color: #747474;
                display: block;
                font-size: 12px;
                margin: 8px 0 0;
            }

            .received_withd_msg {
                width: 57%;
            }

            .mesgs {
                float: left;
                padding: 30px 15px 0 25px;
                width: 60%;
            }

            .sent_msg p {
                background: #990033 none repeat scroll 0 0;
                border-radius: 3px;
                font-size: 14px;
                margin: 0;
                color: #fff;
                padding: 5px 10px 5px 12px;
                width: 100%;
            }

            .outgoing_msg {
                overflow: hidden;
                margin: 26px 0 26px;
            }

            .sent_msg {
                float: right;
                width: 46%;
            }

            .input_msg_write input {
                background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
                border: medium none;
                color: #4c4c4c;
                font-size: 15px;
                min-height: 48px;
                width: 100%;
            }

            .type_msg {
                border-top: 1px solid #c4c4c4;
                position: relative;
            }

            .msg_send_btn {
                background: #990033 none repeat scroll 0 0;
                border: medium none;
                border-radius: 50%;
                color: #fff;
                cursor: pointer;
                font-size: 17px;
                height: 33px;
                position: absolute;
                right: 0;
                top: 11px;
                width: 33px;
            }

            .messaging {
                padding: 0 0 50px 0;
            }

            .msg_history {
                height: 516px;
                overflow-y: auto;
            }
        </style>
@endpush
