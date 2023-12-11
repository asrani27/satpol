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
                <h3 class="card-title">DATA KELUHAN VIA BOT WA</h3>
                <div class="card-tools">
                    
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
                            <th>Bukti Dukung</th>
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
                            <td>
                                <table>
                                    <tr>
                                        <td>Nama</td>
                                        <td>{{$item->nama}}</td>
                                    </tr>
                                    <tr>
                                        <td>Kecamatan</td>
                                        <td>{{$item->kecamatan}}</td>
                                    </tr>
                                    <tr>
                                        <td>Kelurahan</td>
                                        <td>{{$item->kelurahan}}</td>
                                    </tr>
                                    <tr>
                                        <td>Kategori</td>
                                        <td>{{$item->kategori}}</td>
                                    </tr>
                                    <tr>
                                        <td>Isi</td>
                                        <td>{{$item->isikeluhan}}</td>
                                    </tr>
                                    <tr>
                                        <td>Nomor Pengirim</td>
                                        <td>{{$item->pengirim}}</td>
                                    </tr>
                                </table>

                            </td>
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
                                @if ($item->file != null)
                                    <img src="/storage/foto/{{$item->file}}" width="100px"><br/>
                                @endif
                                <a href="#" class="btn btn-xs btn-primary upload-bukti" data-id="{{$item->id}}"><i class="fa fa-upload"></i> Upload bukti</a>
                            </td>
                            <td>
                                {{-- @if ($item->status != 2)

                                <a href="/data/masuk/kirim/{{$item->id}}" class="btn btn-xs btn-success"><i
                                        class="fas fa-paper-plane"></i> Kirim Ke Semua</a>
                                @endif --}}
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-success"><i class="fas fa-cog"></i>  Aksi</button>
                                        <button type="button" class="btn btn-sm btn-success dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="false">
                                          <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <div class="dropdown-menu" role="menu" style="">
                                            <a class="dropdown-item btn-xs" href="#"><i class="fas fa-comments"></i> Kirim Ke Petugas</a>
                                          <div class="dropdown-divider"></div>
                                          <a class="dropdown-item btn-xs" href="#"><strong>Ubah Status :</strong></a>
                                          <a class="dropdown-item btn-xs" href="/data/keluhanwa/ubahstatusbaru/{{$item->id}}" onclick="return confirm('yakin di ubah menjadi Baru?');"><i class="fas fa-arrow-right"></i> Baru</a>
                                          <a class="dropdown-item btn-xs" href="/data/keluhanwa/ubahstatusdiproses/{{$item->id}}" onclick="return confirm('yakin di ubah menjadi DiProses?');"><i class="fas fa-arrow-right"></i> Diproses</a>
                                          <a class="dropdown-item btn-xs" href="/data/keluhanwa/ubahstatusselesai/{{$item->id}}" onclick="return confirm('yakin di ubah menjadi Selesai?');"><i class="fas fa-arrow-right"></i> Selesai</a>
                                          <div class="dropdown-divider"></div>
                                          <a class="dropdown-item btn-xs" href="/data/keluhanwa/delete/{{$item->id}}" onclick="return confirm('yakin Di Hapus?');"><i class="fas fa-trash"></i> Hapus</a>
                                        </div>
                                      </div>
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
<div class="modal fade" id="modal-upload">
    <div class="modal-dialog">
      <div class="modal-content ">
        <div class="modal-header">
          <h4 class="modal-title">Upload Bukti</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="post" action="/data/keluhanwa/uploadbukti" enctype="multipart/form-data">
        <div class="modal-body">
            @csrf
            <div class="form-group">
                <label>Upload</label>
                <input type="file" id="file" class="form-control" name="file" required>
                <input type="hidden" id="id_keluhan" class="form-control" name="id_keluhan" readonly>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn bg-grey pull-left" data-dismiss="modal"><i class="fa fa-sign-out"></i> Close</button>
          <button type="submit" class="btn bg-purple"><i class="fa fa-save"></i> Simpan</button>
        </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>

<div class="modal fade" id="modal-upload">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-default">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title"><i class="ion ion-clipboard"></i> Upload Bukti</h4>
        </div>
        <form method="post" action="/data/keluhanwa/uploadbukti">
        <div class="modal-body">
            @csrf
            <div class="form-group">
                <label>Upload</label>
                <input type="file" id="file" class="form-control" name="file" required>
                <input type="text" id="id_keluhan" class="form-control" name="id_keluhan" readonly>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn bg-grey pull-left" data-dismiss="modal"><i class="fa fa-sign-out"></i> Close</button>
          <button type="submit" class="btn bg-purple"><i class="fa fa-save"></i> Simpan</button>
        </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
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
    $(document).on('click', '.upload-bukti', function() {
    $('#id_keluhan').val($(this).data('id'));
    $("#modal-upload").modal();
  });
  </script>
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