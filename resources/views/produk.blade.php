@section('content')
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h3 class="float-left mt-3">Produk Management</h3>
                        <a href="" type="button" class="btn text-white waves-effect waves-light mt-3 float-right"
                            style="background-color: #fc6400" data-toggle="modal" data-target="#exampleModal">Add new
                            produk</a>
                    </div>
                    <hr>
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="mb-3">
                                    <table id="datatable" class="table table-bordered full-width"
                                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                            <tr align="center">
                                                <th>No</th>
                                                <th>Produk</th>
                                                <th>Nama</th>
                                                <th>Deskripsi</th>
                                                <th>Stok</th>
                                                <th>Harga</th>
                                                <th>Tanggal Dibuat</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($produk as $key => $item)
                                            @php
                                            $bikin = date("Y-m-d", strtotime($item->created_at));
                                            @endphp
                                            <tr align="center">
                                                <td style="vertical-align: middle;">{{ $key+1 }}</td>
                                                <td style="vertical-align: middle;">
                                                    <img src="{{ $item->image }}" onclick="window.open(this.src, '_blank');" border="0" width="100" class="img-rounded" align="center">
                                                </td>
                                                <td style="vertical-align: middle;">{{ $item->nama_produk }}</td>
                                                <td style="vertical-align: middle;">{{ $item->deskripsi }}</td>
                                                <td style="vertical-align: middle;">{{ $item->qty }}</td>
                                                <td style="vertical-align: middle;">Rp. {{ format_uang($item->harga) }}
                                                </td>
                                                <td style="vertical-align: middle;">{{ tanggal_local($bikin) }}</td>

                                                <td style="vertical-align: middle;">
                                                    <div class="btn-group btn-group-example mb-3" role="group">
                                                        <button type="button" class="btn btn-outline-dark w-sm"
                                                            data-toggle="modal" data-target="#edit{{ $item->id }}"><i
                                                                class="bx bx-sm bx bxs-edit"></i></button>
                                                        <button href="javascript:void(0);"
                                                            onclick=deletedata(<?= $item->id ?>) type="button"
                                                            class="btn btn-outline-dark w-sm"><i
                                                                class="bx bx-sm bx bx-trash"></i></button>
                                                    </div>
                                                </td>
                                            </tr>

                                            <!-- Modal isi edit survey -->
                                            <div class="modal fade" id="edit{{ $item->id }}" tabindex="-1" role="dialog"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <form action="{{ route('edit_produk', $item->id) }}"
                                                            method="POST" id="form-program" class="form-class"
                                                            name="form-name" enctype="multipart/form-data">
                                                            @csrf
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Edit
                                                                    Customer
                                                                </h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                {{-- isi --}}
                                                                <div class="form-group">
                                                                    <label>Nama Produk</label>
                                                                    <input type="text" name="nama" class="form-control"
                                                                        value="{{ $item->nama_produk }}" required placeholder="Ex : Buku" />
                                                                </div>

                                                                <div class="form-group">
                                                                    <label>Deskripsi</label>
                                                                    <textarea name="deskripsi" class="form-control"
                                                                        cols="30" rows="10">{{ $item->deskripsi }}</textarea>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label>Stok</label>
                                                                    <input type="text" onkeypress="return hanyaAngka(event)" name="stok" class="form-control"
                                                                        value="{{ $item->qty }}" required placeholder="Ex : 5" />
                                                                </div>

                                                                <div class="form-group">
                                                                    <label>Harga</label>
                                                                    <input type="text" onkeypress="return hanyaAngka(event)" name="harga" value="{{ format_uang($item->harga) }}"
                                                                        class="form-control" required
                                                                        placeholder="Ex : 12000" />
                                                                </div>

                                                                <div class="form-group">
                                                                    <label>Foto Produk</label>
                                                                    <input type="file" name="file" class="form-control"
                                                                        required />
                                                                </div>
                                                                <hr>
                                                                <h3>Foto Produk : </h3>
                                                                <hr>
                                                                <div class="text-center">
                                                                    <img src="{{ $item->image }}" onclick="window.open(this.src, '_blank');" border="0" width="100" class="img-rounded" align="center">
                                                                </div>
                                                                {{-- end isi --}}
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="submit" class="btn text-white"
                                                                    style="background-color: #fc6400">Submit</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->
    </div>
</div>

<!-- Modal isi tambah banner -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form action="{{ route('insert_produk') }}" method="POST" id="form-program" class="form-class"
                name="form-name" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{-- isi --}}
                    <div class="form-group">
                        <label>Nama Produk</label>
                        <input type="text" name="nama" class="form-control" required placeholder="Ex : Buku" />
                    </div>

                    <div class="form-group">
                        <label>Deskripsi</label>
                        <textarea name="deskripsi" class="form-control" cols="30" rows="10"></textarea>
                    </div>

                    <div class="form-group">
                        <label>Stok</label>
                        <input type="text" onkeypress="return hanyaAngka(event)" name="stok" class="form-control" required placeholder="Ex : 5" />
                    </div>

                    <div class="form-group">
                        <label>Harga</label>
                        <input type="text" onkeypress="return hanyaAngka(event)" name="harga" class="form-control" required placeholder="Ex : 12000" />
                    </div>

                    <div class="form-group">
                        <label>Foto Produk</label>
                        <input type="file" name="file" class="form-control" required />
                    </div>

                    {{-- end isi --}}
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn text-white" style="background-color: #fc6400">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script src="{{ asset('sweetalert/sweetalert.min.js') }}"></script>
@if(Session::has('data'))
<script type="text/javascript">
    swal("", "Berhasil tambah produk", "success");

</script>
@endif

@if(Session::has('edit'))
<script type="text/javascript">
    swal("", "Berhasil edit produk", "success");

</script>
@endif


<script type="text/javascript">
    function deletedata(id) {
        event.preventDefault();
        swal({
                title: "Apa Anda Yakin?",
                text: "Customer yang dihapus akan hilang ",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: "{{url('/hapus_produk')}}/" + id,
                        type: "post",
                        data: {
                            _token: "{{ csrf_token() }}",
                            id: id,
                        },
                        success: function (data) {
                            console.log(data);
                            swal({
                                title: "Good job",
                                text: "Produk berhasil dihapus",
                                icon: "success",
                                showCancelButton: false, // There won't be any cancel button
                                showConfirmButton: true
                            }).then(function (isConfirm) {
                                if (isConfirm) {
                                    location.reload();
                                } else {
                                    //if no clicked => do something else
                                }
                            });
                        },
                        error: function () {
                            swal('data gagal di hapus', 'error');
                        }
                    });
                }
            });
    }

</script>
@endsection
