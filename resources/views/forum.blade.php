@include('layouts.header')

        <title>Forum Diskusi | Yatno's Bike</title>
    </head>

    <body>
        @include('layouts.navbar')
        <center><h3 class="mt-3">Forum Diskusi</h3></center>
        <div class="container">
            @if (session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>                
            @endif
            <button type="button" class="btn btn-secondary mb-3" data-bs-toggle="modal" data-bs-target="#createforum">
                Buat Forum Diskusi
            </button>
            @foreach ($forums as $forum)
                <div class="card mb-3">
                    <div class="card-header">
                        <b>{{ $forum->name }}</b> - {{ $forum->created_at }}
                        @if ($forum->user_id == session('user_id'))
                            <div class="d-flex justify-content-end">
                                <form action="{{ route('forumDelete', [$forum->id]) }}" method="POST">
                                    @method('delete')
                                    @csrf
                                    <button class="btn btn-danger" onclick="return confirm('Anda yakin ingin menghapus?')"><i class="fa-solid fa-trash"></i></button>
                                </form>  
                            </div>
                        @endif
                    </div>
                    <div class="card-body">
                        <p class="card-text">{{ $forum->forum_title }}</p>
                        <a href="{{ route('forumDetail', [$forum->id]) }}" class="btn btn-primary">Lihat Balasan</a>
                    </div>
                </div>                
            @endforeach
        </div>

        <div class="modal fade" id="createforum" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Buat Forum Diskusi</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('forumCreate') }}" method="post" class="mt-3">
                            @csrf
                            <div class="mb-3">
                                <label for="" class="form-label">Judul: </label>
                                <textarea name="forum_title" id="" cols="30" rows="5" class="form-control" required></textarea>
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