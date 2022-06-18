@include('layouts.header')        
        {{-- memanggil css dan js untuk menggunakan datatables --}}
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.0/css/jquery.dataTables.css">        
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.0/js/jquery.dataTables.js"></script>
        
        <title>Kelola Produk | Yatno's Bike</title>
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
            <h3>Kelola Produk</h3>

            <button type="button" class="btn btn-secondary mb-3" data-bs-toggle="modal" data-bs-target="#addproduct">
                Tambah Produk
            </button>

            <table id="products_table" class="display">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Produk</th>
                        <th>Gambar</th>
                        <th>Stok</th>
                        <th>Harga</th>
                        <th>Detail</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $i = 1;
                    @endphp
                    @foreach ($products as $product)
                        {{-- data tabel --}}
                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{ $product->name }}</td>
                            <td>
                                <img src="/assets/{{ $product->image }}" alt="gambar produk" style="width:100px; height:50px">
                            </td>
                            <td>{{ $product->stock }}</td>
                            <td>Rp.{{ $product->price }}</td>
                            <td>
                                <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#productdetail{{ $product->id }}">
                                    Lihat Detail
                                </button>
                            </td>
                            <td>
                                <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#editproduct{{ $product->id }}">
                                    Edit Produk
                                </button>
                                <form action="{{ route('productDelete', [$product->id]) }}" method="POST">
                                    @method('delete')
                                    @csrf
                                    <button class="btn btn-danger" onclick="return confirm('Anda yakin ingin menghapus?')"><i class="fa-solid fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>          
                        @php
                            $i++
                        @endphp          
                    @endforeach
                </tbody>
            </table>
        </div>        

        <div class="modal fade" id="addproduct" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Produk</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('productCreate') }}" method="post" class="mt-3" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Nama Produk :</label>
                                <input type="text" class="form-control" id="exampleFormControlInput1" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Gambar :</label>
                                <input type="file" class="form-control" id="exampleFormControlInput1" name="gambar" required>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Deskripsi :</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="4" name="description" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Kategori :</label>
                                <select name="category" id="" class="form-control">
                                    <option value="sepeda">Sepeda</option>
                                    <option value="part">Part</option>
                                    <option value="aksesoris">Aksesoris</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Harga :</label>
                                <input type="number" class="form-control" id="exampleFormControlInput1" name="price" required>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Stok :</label>
                                <input type="number" class="form-control" id="exampleFormControlInput1" name="stock" required>
                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-secondary">Tambah</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @foreach ($products as $product)
            <div class="modal fade" id="productdetail{{ $product->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Detail Produk</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <h4>{{ $product->name }}</h4>
                            <img src="/assets/{{ $product->image }}" alt="gambar produk" style="width:400px">
                            <h6>Deskripsi : </h6>
                            {{ $product->description }}
                            <p><b>Kategori : </b>{{ $product->category }}</p>
                            <p><b>Stok : </b>{{ $product->stock }}</p>
                            <p><b>Harga : </b>{{ $product->price }}</p>
                            <p><b>Terjual : </b>{{ $product->sold }}</p>
                            <p><b>Rate : </b>{{ $product->rate }}</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="modal fade" id="editproduct{{ $product->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Produk</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('productUpdate', [$product->id]) }}" method="post" class="mt-3" enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Nama Produk :</label>
                                    <input type="text" class="form-control" id="exampleFormControlInput1" name="name" value='{{ $product->name }}' required>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Gambar :</label>
                                    <input type="file" class="form-control" id="exampleFormControlInput1" name="gambar">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlTextarea1" class="form-label">Deskripsi :</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="4" name="description" required>{{ $product->description }}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlTextarea1" class="form-label">Kategori :</label>
                                    <select name="category" id="" class="form-control">
                                        @if ($product->category == 'sepeda')
                                            <option value="sepeda" selected>Sepeda</option>
                                            <option value="part">Part</option>
                                            <option value="aksesoris">Aksesoris</option>      
                                        @elseif ($product->category == 'part')                                      
                                            <option value="sepeda">Sepeda</option>
                                            <option value="part" selected>Part</option>
                                            <option value="aksesoris">Aksesoris</option>      
                                        @elseif ($product->category == 'aksesoris')                                      
                                            <option value="sepeda">Sepeda</option>
                                            <option value="part">Part</option>
                                            <option value="aksesoris" selected>Aksesoris</option>      
                                        @endif
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Harga :</label>
                                    <input type="number" class="form-control" id="exampleFormControlInput1" name="price" value="{{ $product->price }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Stok :</label>
                                    <input type="number" class="form-control" id="exampleFormControlInput1" name="stock" value="{{ $product->stock }}" required>
                                </div>                            
                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-secondary">Edit</button>
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
                $('#products_table').DataTable();
            } );
        </script>
    </body>

</html>