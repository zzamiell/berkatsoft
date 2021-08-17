@section('content')
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h3 class="float-left mt-3">Customer Management</h3>
                        <a href="" type="button" class="btn text-white waves-effect waves-light mt-3 float-right" style="background-color: #fc6400"
                            data-toggle="modal" data-target="#exampleModal">Add new customer</a>
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
                                                <th>nama</th>
                                                <th>Alamat</th>
                                                <th>No Hp</th>
                                                <th>Tanggal Dibuat</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($customer as $key => $item)
                                            @php
                                            $bikin = date("Y-m-d", strtotime($item->created_at));
                                            @endphp
                                            <tr align="center">
                                                <td style="vertical-align: middle;">{{ $key+1 }}</td>
                                                <td style="vertical-align: middle;">{{ $item->nama }}</td>
                                                <td style="vertical-align: middle;">{{ $item->alamat }}</td>
                                                <td style="vertical-align: middle;">{{ $item->hp }}</td>
                                                <td style="vertical-align: middle;">{{ tanggal_local($bikin) }}</td>

                                                <td style="vertical-align: middle;">
                                                    <div class="btn-group btn-group-example mb-3" role="group">
                                                        <button type="button" class="btn btn-outline-dark w-sm" data-toggle="modal" data-target="#edit{{ $item->id }}"><i
                                                                class="bx bx-sm bx bxs-edit"></i></button>
                                                        <button href="javascript:void(0);" onclick=deletedata(<?= $item->id ?>) type="button" class="btn btn-outline-dark w-sm"><i
                                                                class="bx bx-sm bx bx-trash"></i></button>
                                                    </div>
                                                </td>
                                            </tr>

                                            <!-- Modal isi edit survey -->
                                            <div class="modal fade" id="edit{{ $item->id }}" tabindex="-1" role="dialog"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <form action="{{ route('edit_customer', $item->id) }}" method="POST"
                                                            id="form-program" class="form-class" name="form-name"
                                                            enctype="multipart/form-data">
                                                            @csrf
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Edit Customer
                                                                </h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                {{-- isi --}}
                                                                <div class="form-group">
                                                                    <label>Nama</label>
                                                                    <input type="text" name="nama" class="form-control" value="{{ $item->nama }}" required placeholder="Ex : John Doe" />
                                                                </div>

                                                                <div class="form-group">
                                                                    <label>email</label>
                                                                    <input type="email" name="email" class="form-control" value="{{ $item->email }}" required placeholder="Ex : jon@gmail.com" />
                                                                </div>

                                                                <div class="form-group">
                                                                    <label>alamat</label>
                                                                    <textarea name="alamat" class="form-control" cols="30" rows="10">{{ $item->alamat }}</textarea>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label>No HP</label>
                                                                    <input type="text" name="hp" value="{{ $item->hp }}" class="form-control" required placeholder="Ex : 087771739015" />
                                                                </div>

                                                                <div class="form-group">
                                                                    <label>password</label>
                                                                    <input type="password" name="password" class="form-control" required placeholder="*********" />
                                                                </div>
                                                                {{-- end isi --}}
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="submit"
                                                                    class="btn text-white" style="background-color: #fc6400">Submit</button>
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
            <form action="{{ route('insert_customer') }}" method="POST" id="form-program" class="form-class"
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
                        <label>Nama</label>
                        <input type="text" name="nama" class="form-control" required placeholder="Ex : John Doe" />
                    </div>

                    <div class="form-group">
                        <label>email</label>
                        <input type="email" name="email" class="form-control" required placeholder="Ex : jon@gmail.com" />
                    </div>

                    <div class="form-group">
                        <label>alamat</label>
                        <textarea name="alamat" class="form-control" cols="30" rows="10"></textarea>
                    </div>

                    <div class="form-group">
                        <label>No HP</label>
                        <input type="text" name="hp" class="form-control" required placeholder="Ex : 087771739015" />
                    </div>

                    <div class="form-group">
                        <label>password</label>
                        <input type="password" name="password" class="form-control" required placeholder="*********" />
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
    swal("", "Berhasil login", "success");

</script>
@endif

@if(Session::has('data_sukses'))
<script type="text/javascript">
    swal("", "Berhasil tambah customer", "success");

</script>
@endif

@if(Session::has('edit'))
<script type="text/javascript">
    swal("", "Berhasil edit customer", "success");

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
                              url: "{{url('/hapus_customer')}}/" + id,
                              type: "post",
                              data: {
                                   _token: "{{ csrf_token() }}",
                                   id: id,
                              },
                              success: function(data) {
                                   console.log(data);
                                   swal({
                                    title: "Good job",
                                    text: "Customer berhasil dihapus",
                                    icon: "success",
                                    showCancelButton: false, // There won't be any cancel button
                                    showConfirmButton: true
                                 }).then(function(isConfirm) {
                                    if (isConfirm) {
                                        location.reload();
                                    } else {
                                        //if no clicked => do something else
                                    }
                                    });
                            },
                            error: function() {
                            swal('data gagal di hapus', 'error');
                        }
                    });
                }
            });
         }

</script>
@endsection
