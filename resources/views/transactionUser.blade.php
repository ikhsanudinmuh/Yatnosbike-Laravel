@include('layouts.header')        
        {{-- memanggil css dan js untuk menggunakan datatables --}}
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.0/css/jquery.dataTables.css">        
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.0/js/jquery.dataTables.js"></script>
        
        <title>Transaksi {{ session('name') }} | Yatno's Bike</title>
    </head>

    <body>
        @include('layouts.navbar')
        <div class="container mt-4">
            @if (session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>                
            @endif
            <h3>Transaksi {{ session('name') }}</h3>

            {{-- tabel transaksi --}}
            <table id="transactions_table" class="display">
                <thead>
                    <tr>
                        <th>Produk</th>
                        <th>Gambar</th>
                        <th>Kuantitas</th>
                        <th>Total Harga</th>
                        <th>Detail</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- data tabel --}}
                    @foreach ($transactions as $transaction)
                        <tr>
                            <td>{{ $transaction->product_name }}</td>
                            <td>
                                <img src="/assets/{{ $transaction->product_image }}" alt="gambar produk" style="width:100px; height:50px">
                            </td>
                            <td>{{ $transaction->quantity }}</td>
                            <td>Rp.{{ $transaction->price }}</td>
                            <td>
                                {{-- button untuk menampilkan detail transaksi --}}
                                <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#detailtransactions{{ $transaction->id }}">
                                    Lihat Detail
                                </button>
                            </td>
                            <td>
                                @if ($transaction->status == 'pending')
                                    <span class="badge bg-warning">Belum Dibayar</span>
                                @elseif ($transaction->status == 'check')
                                    <span class="badge bg-secondary">Pembayaran Sedang Dicek</span>                                    
                                @elseif ($transaction->status == 'paid')
                                    <span class="badge bg-primary">Sudah Dibayar</span>
                                @elseif ($transaction->status == 'process')
                                    <span class="badge bg-secondary">Diproses Admin</span>                                    
                                @elseif ($transaction->status == 'delivering')
                                    <span class="badge bg-info">Sedang Dikirim</span>                                    
                                @elseif ($transaction->status == 'delivered')
                                    <span class="badge bg-secondary">Sudah Diterima</span>                                    
                                @elseif ($transaction->status == 'rating')
                                    <span class="badge bg-warning">Perlu Memberi Ulasan</span>                                    
                                @elseif ($transaction->status == 'done')
                                    <span class="badge bg-success">Selesai</span>       
                                @elseif ($transaction->status == 'cancelled')
                                    <span class="badge bg-danger">Transaksi ditolak</span>
                                @endif
                            </td>
                            <td>
                                @if ($transaction->status == 'pending')
                                    {{-- button untuk menampilkan modal upload bukti pembayaran --}}
                                    <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#uploadpayment{{ $transaction->id }}">
                                        Upload Bukti Pembayaran
                                    </button>
                                    <form action="{{ route('transactionDelete', [$transaction->id]) }}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-danger" onclick="return confirm('Apakah anda yakin ingin menghapus transaksi?')">Hapus Transaksi</button>
                                    </form>
                                @elseif($transaction->status == 'delivering')
                                    <form action="{{ route('transactionDelivered', [$transaction->id]) }}" method="POST">
                                        @csrf
                                        @method('put')
                                        <button class="btn btn-primary">Terima</button>
                                    </form>
                                @elseif($transaction->status == 'delivered')
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#reviewtransactions{{ $transaction->id }}">
                                        Beri Ulasan
                                    </button>
                                @endif
                            </td>
                        </tr>                        
                    @endforeach
                </tbody>
            </table>
        </div>        

        @foreach ($transactions as $transaction)
            {{-- modal detail transaksi --}}
            <div class="modal fade" id="detailtransactions{{ $transaction->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Detail Transaksi</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <h4>{{ $transaction->product_name }}</h4>
                            <img src="/assets/{{ $transaction->product_image }}" alt="gambar produk" style="width:400px">
                            <p><b>Kuantitas : </b>{{ $transaction->quantity }}</p>
                            <h6>Alamat : </h6>
                            {{ $transaction->address }}
                            <p><b>Harga : </b>Rp.{{ $transaction->price }}</p>
                            <p><b>Opsi Pengiriman : </b>{{ $transaction->shipping_option}}</p>
                            <p><b>Pembayaran : </b>{{ $transaction->payment_option }}</p>
                            <h6>Bukti Pembayaran : </h6>
                            @if ($transaction->payment_proof != null)
                                <img src="/assets/{{ $transaction->payment_proof }}" alt="bukti pembayaran" style="width:400px">
                            @else
                                <span class="badge bg-warning">Belum Dibayar</span>
                            @endif
                            <p><b>Status : </b>{{ $transaction->status }}</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- modal upload bukti pembayaran --}}
            <div class="modal fade" id="uploadpayment{{ $transaction->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Upload Bukti Pembayaran</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('transactionUpload', [$transaction->id]) }}" method="post" class="mt-3" enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <div class="mb-3">
                                    <label for="" class="form-label">Bukti Pembayaran :</label>
                                    <input type="file" name="gambar" id="" class="form-control" required>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-secondary">Upload</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>           
            
            <div class="modal fade" id="reviewtransactions{{ $transaction->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Beri Ulasan Transaksi</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('transactionRating', ['id' => $transaction->id, 'product_id' => $transaction->product_id]) }}" method="post" class="mt-3">
                                @csrf
                                @method('put')
                                <div class="mb-3">
                                    <label for="" class="form-label">Ulasan :</label>
                                    <textarea name="review_text" id="" class="form-control" cols="30" rows="5" required></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label">Penilaian(1.0 - 5.0) :</label>
                                    <input type="number" step="0.1" name="rate" id="" class="form-control" min="1.0" max="5.0" required>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-secondary">Kirim</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>            
        @endforeach

        {{-- datatables --}}
        <script>
            $(document).ready( function () {
                $('#transactions_table').DataTable();
            } );
        </script>
    </body>

</html>