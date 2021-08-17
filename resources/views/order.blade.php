@section('content')
<script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h3 class="float-left mt-3">Sales Order</h3>
                        <a href="" type="button" class="btn text-white waves-effect waves-light mt-3 float-right" style="background-color: #fc6400"
                            data-toggle="modal" data-target="#exampleModal">Add new order</a>
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
                                                <th>Customer </th>
                                                <th>Produk</th>
                                                <th>Qty</th>
                                                <th>Catatan</th>
                                                <th>No Hp</th>
                                                <th>Total Harga</th>
                                                <th>Tanggal Order</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($order as $key => $item)
                                            @php
                                            $bikin = date("Y-m-d", strtotime($item->created_at));
                                            @endphp
                                            <tr align="center">
                                                <td style="vertical-align: middle;">{{ $key+1 }}</td>
                                                <td style="vertical-align: middle;">{{ $item->customer }}</td>
                                                <td style="vertical-align: middle;">{{ $item->nama_produk }}</td>
                                                <td style="vertical-align: middle;">{{ $item->qty }}</td>
                                                <td style="vertical-align: middle;">{{ $item->catatan }}</td>
                                                <td style="vertical-align: middle;">{{ $item->hp }}</td>
                                                <td style="vertical-align: middle;">Rp. {{ format_uang($item->total_harga) }}</td>
                                                <td style="vertical-align: middle;">{{ tanggal_local($bikin) }}</td>

                                                {{-- <td style="vertical-align: middle;">
                                                    <div class="btn-group btn-group-example mb-3" role="group">
                                                        <button type="button" class="btn btn-outline-dark w-sm" data-toggle="modal" data-target="#edit{{ $item->id }}"><i
                                                                class="bx bx-sm bx bxs-edit"></i></button>
                                                        <button href="javascript:void(0);" onclick=deletedata(<?= $item->id ?>) type="button" class="btn btn-outline-dark w-sm"><i
                                                                class="bx bx-sm bx bx-trash"></i></button>
                                                    </div>
                                                </td> --}}
                                            </tr>
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
            <form action="{{ route('insert_order') }}" method="POST" id="form-program" class="form-class"
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
                        <label>Pilih Customer</label>
                        <select name="id_user" class="form-control" id="">
                            @foreach ($user as $item)
                            <option value="{{ $item->id }}">{{ $item->nama }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Pilih Produk</label>
                        <select name="id_produk" id="harga_produk" class="form-control">
                            @foreach ($produk as $item)
                            <option value="{{ $item->id }}">{{ $item->nama_produk .'- Rp. '.format_uang($item->harga) }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Qty</label>
                        <input name="text" onkeypress="return hanyaAngka(event)" onkeyup="cek(this)" id="qty" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Catatan</label>
                        <textarea name="catatan" class="form-control" cols="30" rows="10"></textarea>
                    </div>

                    <div class="form-group">
                        <label>Total Harga</label>
                        <input type="text" id="totalharga" name="total_harga" class="form-control" readonly />
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
    swal("", "Berhasil tambah order", "success");

</script>
@endif

@if(Session::has('edit'))
<script type="text/javascript">
    swal("", "Berhasil edit customer", "success");

</script>
@endif


<script type="text/javascript">

function cek(params) {
    var harga = $('#harga_produk').find(":selected").text();
    var qty = $( "#qty" ).val();

    const myArr = harga.split("-");
    const removeRP = myArr[1].replace('Rp.','');
    const removetitik = removeRP.replace('.','');
    var harganya = parseInt(removetitik);

    var total = harganya * qty;
    $("#totalharga").val(total);
}

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
@section('script')
@endsection
