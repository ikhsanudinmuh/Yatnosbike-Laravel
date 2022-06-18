@include('layouts.header')        
        {{-- memanggil css dan js untuk menggunakan datatables --}}
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.0/css/jquery.dataTables.css">        
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.0/js/jquery.dataTables.js"></script>
        
        <title>Transaksi | Yatno's Bike</title>
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
            <h3>Transaksi</h3>

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
                                @if ($transaction->status == 'paid')
                                    <form action="{{ route('transactionProcess', [$transaction->id]) }}" method="POST">
                                        @csrf
                                        @method('put')
                                        <button class="btn btn-secondary">Proses</button>
                                    </form>
                                @elseif ($transaction->status == 'process')
                                    <form action="{{ route('transactionDeliver', [$transaction->id]) }}" method="POST">
                                        @csrf
                                        @method('put')
                                        <button class="btn btn-primary">Kirim</button>
                                    </form>
                                @elseif ($transaction->status == 'check')
                                    <form action="{{ route('transactionCheck', ['id' => $transaction->id, 'product_id' => $transaction->product_id]) }}" method="POST">
                                        @csrf
                                        @method('put')
                                        <button class="btn btn-secondary">Terima Pembayaran</button>
                                    </form>
                                    <form action="{{ route('transactionCancel', [$transaction->id]) }}" method="POST">
                                        @csrf
                                        @method('put')
                                        <button class="btn btn-danger" onclick="return confirm('Apakah anda yakin ingin menolak transaksi ini?')">Cancel</button>
                                    </form>
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
                            <p><b>Pembeli : </b>{{ $transaction->user_name }}</p>
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
        @endforeach

        {{-- datatables --}}
        <script>
            $(document).ready( function () {
                $('#transactions_table').DataTable();
            } );
        </script>
    </body>

</html>