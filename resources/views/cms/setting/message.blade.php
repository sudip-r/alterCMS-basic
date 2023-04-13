@extends('cms.layouts.master')

@section('content')

<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Messages</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Messages</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <section class="content">
    <div class="row">
     
      <!-- /.col -->
      <div class="col-md-10">
        <div class="card direct-chat direct-chat-warning">
            <div class="card-header">
              <h3 class="card-title" id="chat-with">Direct Chat</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body" id="no-selection">
              <div class="__non_selected">
                  <p>Select user to chat</p>
              </div>
            </div>
            <div class="card-body __message_body">
              <!-- Conversations are loaded here -->
              <div class="direct-chat-messages __chat_box">
                <div class="__chat_messages">
                @if($latestThread != null)
                @foreach($latestThread as $message)
                @if($message->message_to == $user->id)
                <div class="direct-chat-msg">
                  <div class="direct-chat-infos clearfix">
                    <span class="direct-chat-timestamp float-right">{{date('F j, H:i', strtotime($message->created_at))}}</span>
                  </div>
                  <!-- /.direct-chat-infos -->
                  <img class="direct-chat-img" src="{{$message->received->image}}" alt="message user image">
                  <!-- /.direct-chat-img -->
                  <div class="direct-chat-text">
                    {!!$message->message!!} 
                  </div>
                  <!-- /.direct-chat-text -->
                </div>
                @elseif($message->message_from == $user->id)
                <div class="direct-chat-msg right">
                  <div class="direct-chat-infos clearfix">
                    <span class="direct-chat-timestamp float-left">{{date('F j, H:i', strtotime($message->created_at))}}</span>
                  </div>
                  <!-- /.direct-chat-infos -->
                  <img class="direct-chat-img" src="{{$message->received->image}}" alt="message user image">
                  <!-- /.direct-chat-img -->
                  <div class="direct-chat-text">
                    {{$message->message}}
                  </div>
                  <!-- /.direct-chat-text -->
                </div>
                @endif
                @endforeach
                @endif
                </div>
              </div>
              <!--/.direct-chat-messages-->
            </div>
            <!-- /.card-body -->
            <div class="card-footer __message_body">
                <div class="input-group">
                  <textarea class="form-control __message" placeholder="Type Message..." name="message" id="message" ></textarea>
                  <span class="input-group-append">
                    <button type="button" id="send-btn" class="btn btn-warning">Send</button>
                  </span>
                </div>
            </div>
            <!-- /.card-footer-->
          </div>
      </div>
      <!-- /.col -->
      <div class="col-md-2">
        <!-- USERS LIST -->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Members</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body p-0">
            <ul class="users-list __user_list clearfix">
                @foreach($users as $list)
                @if($list->id == $user->id)
                    @continue
                @endif
              <li>
                <a class="__users_list_name" href="javascript:void(0);">
                  <img src="{{$list->image}}" alt="User Image">
                  <span class="__user_name" id="{{$list->id}}">{{$list->name}}</span>
                </a>
              </li>
              @endforeach
            </ul>
            <!-- /.users-list -->
          </div>
          <!-- /.card-body -->
          <div class="card-footer text-center">
            <a href="javascript:void();">&nbsp;</a>
          </div>
          <!-- /.card-footer -->
        </div>
        <!--/.card -->
      </div>
    </div>
    <!-- /.row -->
  </section>

@endsection

@section('custom-scripts')
<script>
var user = null;
var current = "{{auth()->user()->id}}";
function sendMessage()
{
  let message = $("#message").val();

  if(message.length <= 0)
  {
    return false;
  }

  alert('Sending message '+message);
}

document.addEventListener('DOMContentLoaded', () => {
  const chatWindow = document.querySelector('.__chat_box');
  chatWindow.scrollTop = chatWindow.scrollHeight;
});

$(document).ready(function(){
  $("#send-btn").click(function(event){
    event.preventDefault();
    sendMessage();
  });
  $("#message").keypress(function(event) {
    if (event.which === 13 && !event.shiftKey) { 
      event.preventDefault(); 
      sendMessage(); 
    }
  });
  $(".__user_name").click(function(){
    user = $(this).attr("id");
    var username = $(this).html();
    $(".__message_body").show();
    $(".__non_selected").hide();

    $("#chat-with").html("Direct chat with " + username);

    var data = {
      _token : "{{csrf_token()}}",
      _myId : current,
      _userId : user
    }

    $.ajax({
        url: "{{ route('api::get.messages') }}", 
        type: "POST",
        data: data, 
        success: function(response) {
            console.log(response);
        },
        error: function(xhr) {
            // Handle any errors that occurred during the request
        }
    });

  });

});
</script>
@endsection