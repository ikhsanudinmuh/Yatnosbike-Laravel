@include('layouts.header')

        <title>Forum Diskusi '{{ $forum->forum_title }}' | Yatno's Bike</title>
    </head>

    <body>
        @include('layouts.navbar')
        <div class="container">
            <h3 class="mt-3">Forum Diskusi</h3>
            @if (session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>                
            @endif

            <div class="card mb-3">
                <div class="card-header">
                    <b>{{ $forum->name }}</b> - {{ $forum->created_at }}
                </div>
                <div class="card-body">
                    <p class="card-text">{{ $forum->forum_title }}</p>
                </div>
            </div>
            <button type="button" class="btn btn-secondary mb-3" data-bs-toggle="modal" data-bs-target="#createforumchats">
                Balas Forum
            </button>             
            <hr>
            @if ($forum_chats->isEmpty())
                <center><h5>Belum ada balasan</h5></center>
            @else
                <h4>Balasan :</h4>
                @foreach ($forum_chats as $forum_chat)
                    <div class="card mb-3">
                        <div class="card-header">
                            <b>{{ $forum_chat->name }}</b> - {{ $forum_chat->created_at }}
                            <div class="d-flex justify-content-end">
                                {{-- @if ($forum_chat->user_id == session('user_id'))
                                    <form action="{{ route('forumChatDelete', ['id' => $forum_chat->forum_id, 'forum_chat_id' => $forum_chat->id]) }}" method="POST">
                                        @method('delete')
                                        @csrf
                                        <button class="btn btn-danger" onclick="return confirm('Anda yakin ingin menghapus?')"><i class="fa-solid fa-trash"></i></button>
                                    </form>                                    
                                @endif --}}
                            </div>
                        </div>
                        <div class="card-body">
                            <p class="card-text">{{ $forum_chat->forum_chat_text }}</p>
                        </div>
                    </div>                       
                @endforeach
            @endif   
        </div>

        <div class="modal fade" id="createforumchats" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Balas Forum Diskusi</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('forumChat', [$forum->id]) }}" method="post" class="mt-3">
                            @csrf
                            <div class="mb-3">
                                <label for="" class="form-label">Teks: </label>
                                <textarea name="forum_chat_text" id="" cols="30" rows="5" class="form-control" required></textarea>
                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-secondary">Kirim</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </body>
</html>