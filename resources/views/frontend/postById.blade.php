<!doctype html>
<html lang="en">

<head>
  <meta charset="sutf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Post</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

  <style>
    * {
      box-sizing: border-box;
    }




    /* Create two unequal columns that floats next to each other */
    /* Left column */
    .leftcolumn {
      float: left;
      width: 75%;
    }

    /* Right column */
    .rightcolumn {
      float: left;
      width: 25%;
      padding-left: 20px;
    }

    /* Fake image */
    .fakeimg {
      background-color: #aaa;
      width: 100%;
      padding: 20px;
    }

    /* Add a card effect for articles */
    .card {
      background-color: white;
      padding: 20px;
      margin-top: 20px;
      box-shadow: 8px 8px 5px #888888;
    }

    /* Clear floats after the columns */
    .row:after {
      content: "";
      display: table;
      clear: both;
    }

    /* Footer */



    @media screen and (max-width: 800px) {

      .leftcolumn,
      .rightcolumn {
        width: 100%;
        padding: 0;
      }
    }


    .heading {
      color: #666666;
      text-align: center;
    }

    body {
      font-family: Arial, sans-serif;
      color: #404040;
      background-color: #eee;
    }

    .container {
      width: 520px;
      margin-top: 20px;
    }

    .button-group {
      margin-bottom: 20px;
    }

    .counter {
      display: inline;
      margin-top: 0;
      margin-bottom: 0;
      margin-right: 10px;
    }

    .posts {
      clear: both;
      list-style: none;
      padding-left: 0;
      width: 100%;
      text-align: left;
    }

    .posts li {
      background-color: #fff;
      border: 1.5px solid #d8d8d8;
      border-radius: 10px;
      padding-top: 10px;
      padding-left: 20px;
      padding-right: 20px;
      padding-bottom: 10px;
      margin-bottom: 10px;
      word-wrap: break-word;
      min-height: 42px;
      box-shadow: 8px 8px 5px #888888;
    }

    .btn-primary {
      color: #fff;
      background-color: #337ab7;
      border-color: #2e6da4;
    }
    .clickable {
    cursor: pointer;
}
  </style>
</head>

<body>
  <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
      <a class="navbar-brand" href="#"></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="{{url('/')}}">Add Post</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="{{url('frontend/homepage')}}">All Post</a>
          </li>



        </ul>

      </div>
    </div>
  </nav>


  <div class="container">
    <div class="row">
      <div class="header">
        <h2>Post</h2>
      </div>

      @if(Session::has('error'))
      {{Session::get('error')}}
      @endif

      <div class="row">
        <div class="leftcolumn">
          <!-- print_r($data);
    die(); -->

          <div class="card">
            <p>{{$data['item']}}</p>
            <p>{{$data['content']}}</p>


          </div>




        </div>

      </div>
      <div class="container">
        <form action="{{route('comment.store')}}" method="POST">
          @csrf
          <input type="hidden" name="post_id" value="{{$data['id']}}">
          <div class="form-group">
            <!-- <textarea class="form-control status-box" rows="3" name="content" placeholder="Enter your comment here..."></textarea> -->
            <textarea class="form-control status-box" type="text" name="content">
             </textarea>
          </div>

          <div class="button-group pull-right">
            <!-- <p class="counter">250</p> -->
            <!-- <a type="submit" class="btn btn-primary">Post</a> -->
            <input class="mt-2" type="submit" value="submit">
          </div>
        </form>
        <div id="comments">
          <ul class="posts">
            @foreach($nestedComments as $com)

            <li class="commentID-{{$com['comment']->id}} comment" data-commentId="{{$com['comment']->id}}" style="background-color:orange">{{$com['comment']->content}} {{$com['comment']->id}} </li>

            @if (!empty($com['replies']))

            @else
            <button class="reply-{{$com['comment']->id}} reply firstcommentbutton clickable " data-id="{{$data['id']}}" data-comment-id="{{$com['comment']->id}}" data-depth="{{$com['comment']->depth}}">Reply</button>
            @endif

            @if (!empty($com['replies']))
            <div class="replies">
              @foreach ($com['replies'] as $reply)
              <div class="re" style="display: flex; align-items: center; gap: 10px;">
                <li class="form-control secondreply" style="margin-left: 11%;width:85%;background-color:lightgreen;list-style:none;" data-depth="{{$reply['comment']->depth}}">{{ $reply['comment']->content }}</li>

                @if(!empty($reply['replies']))
                
                @else
                <button class="btn-sm btn-info replyBtn" data-post-id="{{$reply['comment']->post_id}}" data-parent-comment-id="{{$reply['comment']->id}}" data-depth="{{$reply['comment']->depth}}">Reply</button>
                @endif
              </div>

              <div class="replies">
                @foreach($reply['replies'] as $lastcomment)
                <div class="re" style="display: flex; align-items: center; gap: 10px;">
                  <li class="form-control lastreply" style="margin-left: 11%;width:85%;background-color:lightgreen;list-style:none;" data-depth="{{$lastcomment['comment']->depth}}">{{ $lastcomment['comment']->content }}</li>
                  <!-- <button class="btn-sm btn-info replyBtn" data-post-id ="{{$lastcomment['comment']->post_id}}" data-parent-comment-id="{{$lastcomment['comment']->id}}" data-depth="{{$lastcomment['comment']->depth}}">Reply</button> -->
                </div>
                @endforeach
              </div>

              @endforeach
            </div>
            @endif





            @endforeach
          </ul>

        </div>

        <ul class="reply-more">

        </ul>
      </div>
</body>





<script>
  $(document).ready(function() {
    var main = function() {
      $('.btn').click(function() {
        var post = $('.status-box').val();
        $('<li>').text(post).prependTo('.posts');
        $('.status-box').val('');
        $('.counter').text('250');
        $('.btn').addClass('disabled');
      });
      $('.status-box').keyup(function() {
        var postLength = $(this).val().length;
        var charactersLeft = 250 - postLength;
        $('.counter').text(charactersLeft);
        if (charactersLeft < 0) {
          $('.btn').addClass('disabled');
        } else if (charactersLeft === 250) {
          $('.btn').addClass('disabled');
        } else {
          $('.btn').removeClass('disabled');
        }
      });
    }
    $('.btn').addClass('disabled');
    $(document).ready(main)




    $('#comments').on('click', '.reply', function() {
      const commentDiv = $(this).closest('.comment');
      const post_id = $(this).data('id');
      const parent_comment_id = $(this).data('comment-id');
      const depth = $(this).data('depth');

      // $('.firstcommentbutton').hide();

      console.log(parent_comment_id);
      // console.log(parent_comment_id);



      $('.reply-more').append(`
      <div>
      <form action="{{route('reply.store')}}" method="POST">
      @csrf 
      <input type="hidden" value="${post_id}" name="post_id">
      <input type="hidden" name="parent_comment_id" value="${parent_comment_id}"> 
      <input type="hidden" name="depth" value="${depth}">
      <input type="text" class="dynamic-input form-control" name="content" placeholder="Enter text here">
      <br>
      <input class="btn btn-sm btn-primary" type="submit" value="submit">
      </form>
      </div>`);

    });


    // reply form append


    $('.replyBtn').on('click', function(e) {
      //  alert();
      e.preventDefault();
      const repost_id = $(this).data('post-id');
      const reparent_comment_id = $(this).data('parent-comment-id');
      const depth = $(this).data('depth');



      // console.log(reparent_comment_id,repost_id);
      // console.log();


      $('.reply-more').append(`
      <div>
      <form action="{{route('reply.store')}}" method="POST">
      @csrf 
      <input type="hidden" value="${repost_id}" name="post_id">
       <input type="hidden" name="parent_comment_id" value="${reparent_comment_id}">
        <input type="hidden" name="depth" value="${depth}">
        <input type="text" class="dynamic-input form-control" name="content" placeholder="Enter text here">
        <br>
        <input  type="submit" value="submit">
        </form>
        </div>`);

    });



  });
</script>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>