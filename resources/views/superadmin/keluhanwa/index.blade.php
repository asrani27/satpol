@extends('layouts.app')
@push('css')
<!-- DataTables -->
<link rel="stylesheet" href="/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="/admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
@endpush
@section('content')
<br />
<div class="row">
    <div class="col-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">DATA PEGAWAI</h3>
                <div class="card-tools">
                    <a href="/pegawai/create" type="button" class="btn bg-gradient-secondary btn-sm">
                        <i class="fa fa-plus"></i> TAMBAH</a>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-2">
                <table id="example1" class="table table-bordered table-sm">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tgl</th>
                            <th>Nomor</th>
                            <th>Isi</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    @php
                    $no =1;
                    @endphp
                    <tbody>
                        @foreach ($data as $key => $item)
                        <tr style="font-size: 12px;">
                            <td>{{$no++}}</td>
                            <td>{{$item->created_at}}</td>
                            <td>SIPADU{{$item->id}}</td>
                            <td>{{$item->isi}}</td>
                            <td>
                                @if ($item->status == 0)
                                <span class="badge badge-primary">Baru</span>
                                @endif
                                @if ($item->status == 1)
                                <span class="badge badge-danger">di proses</span>
                                @endif
                                @if ($item->status == 2)
                                <span class="badge badge-success">selesai</span>
                                @endif
                            </td>
                            <td>
                                {{-- @if ($item->status != 2)

                                <a href="/data/masuk/kirim/{{$item->id}}" class="btn btn-xs btn-success"><i
                                        class="fas fa-paper-plane"></i> Kirim Ke Semua</a>
                                @endif
                                <a href="/data/masuk/delete/{{$item->id}}" class="btn btn-xs btn-danger"
                                    onclick="return confirm('yakin Di Hapus?');"><i class="fas fa-trash"></i> Hapus</a> --}}

                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
</div>

@endsection

@push('js')

<!-- DataTables  & Plugins -->
<script src="/admin/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="/admin/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="/admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="/admin/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="/admin/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="/admin/plugins/jszip/jszip.min.js"></script>
<script src="/admin/plugins/pdfmake/pdfmake.min.js"></script>
<script src="/admin/plugins/pdfmake/vfs_fonts.js"></script>
<script src="/admin/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="/admin/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="/admin/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<script>
    $(function () {
      $("#example1").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
    });
</script>
@endpush