@extends('layouts.Admin.adminpayroll')

@section('content')
{{-- HEADER --}}
<main>
    <div class="container mt-5">
        <!-- Custom page header alternative example-->
        <div class="d-flex justify-content-between align-items-sm-center flex-column flex-sm-row mb-4">
            <div class="mr-4 mb-3 mb-sm-0">
                <h1 class="mb-0">Perampungan Pajak Penghasilan</h1>
                <div class="small">
                    <span class="font-weight-500 text-primary">{{ $today }}</span>
                    · Tanggal {{ $tanggal }} · <span id="clock">12:16 PM</span>
                </div>
            </div>
            <div class="small">
                <i class="fa fa-cogs" aria-hidden="true"></i>
                <input class="form-control" id="id_perampungan" type="text"  style="display:none" value="{{ $id_perampungan }}">
                Bengkel
                <span class="font-weight-500 text-primary">{{ Auth::user()->bengkel->nama_bengkel}}</span>
                <hr>
                </hr>
            </div>
        </div>
    </div>


    <div class="container-fluid">
        <div class="card mb-4">
            <div class="card card-header-actions">
                <div class="card-header ">List Data
                    <a href="" class="btn btn-sm btn-primary" type="button" data-toggle="modal"
                        data-target="#Modaltambah">
                        Tambah Data
                    </a>
                </div>
            </div>
            <div class="card-body ">
                <div class="datatable">
                    @if(session('messageberhasil'))
                    <div class="alert alert-success" role="alert"> <i class="fas fa-check"></i>
                        {{ session('messageberhasil') }}
                        <button class="close" type="button" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    @endif
                    @if(session('messagehapus'))
                    <div class="alert alert-danger" role="alert"> <i class="fas fa-check"></i>
                        {{ session('messagehapus') }}
                        <button class="close" type="button" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    @endif

                    {{-- TABLE --}}
                    <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                        <div class="row">
                            <div class="col-sm-12">
                                <table class="table table-bordered table-hover dataTable" id="dataTable" width="100%"
                                    cellspacing="0" role="grid" aria-describedby="dataTable_info" style="width: 100%;">
                                    <thead>
                                        <tr role="row">
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1" aria-sort="ascending"
                                                aria-label="Name: activate to sort column descending"
                                                style="width: 20px;">
                                                No</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1" aria-label="Position: activate to sort column ascending"
                                                style="width: 40px;">Nama Pemotong</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1" aria-label="Position: activate to sort column ascending"
                                                style="width: 40px;">NPWP Pemotong</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1" aria-label="Position: activate to sort column ascending"
                                                style="width: 40px;">Tahun</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1" aria-label="Position: activate to sort column ascending"
                                                style="width: 150px;">Total PPh Terutang</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1" aria-label="Actions: activate to sort column ascending"
                                                style="width: 90px;">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($perampungan as $item)
                                        <tr role="row" class="odd">
                                            <th scope="row" class="small" class="sorting_1">{{ $loop->iteration}}</th>
                                            <td>{{ $item->Pemotong->nama_pegawai}}</td>
                                            <td>{{ $item->Pemotong->npwp_pegawai}}</td>
                                            <td>{{ date('Y', strtotime($item->masa_perolehan_awal)) }}</td>
                                            <td>{{ $item->total_pph_terutang}}</td>
                                            <td>
                                                <a href="{{ route('perampungan.show', $item->id_perampungan) }}"
                                                    class="btn btn-secondary btn-datatable" data-toggle="tooltip"
                                                    data-placement="top" title="" data-original-title="Detail">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                                <a href="{{ route('perampungan.edit', $item->id_perampungan) }}"
                                                    class="btn btn-primary btn-datatable" data-toggle="tooltip"
                                                    data-placement="top" title="" data-original-title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="" class="btn btn-danger btn-datatable" type="button"
                                                    data-toggle="modal"
                                                    data-target="#Modalhapus-{{ $item->id_perampungan }}">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        @empty
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

{{-- MODAL TAMBAH --}}
<div class="modal fade" id="Modaltambah" tabindex="-1" role="dialog" data-backdrop="static"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title" id="exampleModalCenterTitle">Tambah Data Perampungan</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">×</span></button>
            </div>
            <form action="{{ route('perampungan.store') }}" method="POST" id="form1" class="d-inline">
                @csrf
                <div class="modal-body">
                    <label class="small mb-1">Isikan Form Dibawah Ini</label>
                    <div class="alert alert-danger" id="alertdatakosong" role="alert" style="display:none"><i
                            class="far fa-times-circle"></i>
                        <span class="small">Error! Terdapat Data yang Masih Kosong!</span>
                        <button class="close" type="button" onclick="$(this).parent().hide()" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <hr>
                    </hr>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="small mb-1" for="tanggal_perampungan">Tanggal Perampungan</label><span
                                class="mr-4 mb-3" style="color: red">*</span>
                            <input class="form-control" id="tanggal_perampungan" type="date" name="tanggal_perampungan"
                                value="<?php echo date('Y-m-d'); ?>">
                        </div>
                        <div class="form-group col-md-6">
                            <label class="small mb-1" for="id_pegawai">Pilih Pegawai</label><span class="mr-4 mb-3"
                                style="color: red">*</span>
                            <div class="input-group input-group-joined">
                                <input class="form-control" type="text" placeholder="Pilih Pegawai" aria-label="Search"
                                    id="detailpegawai">
                                <div class="input-group-append">
                                    <a href="" class="input-group-text" type="button" data-toggle="modal"
                                        data-target="#Modalpegawai">
                                        <i class="fas fa-folder-open"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="small" id="alertsupplier" style="display:none">
                                <span class="font-weight-500 text-danger">Error! Anda Belum Memilih Pegawai!</span>
                                <button class="close" type="button" onclick="$(this).parent().hide()"
                                    aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="small mb-1">Masa Perolehan Penghasilan</label><span class="mr-4 mb-3"
                            style="color: red">*</span>
                        <div class="row">
                            <div class="col-md-5">
                                <input class="form-control" id="masa_perolehan_awal" type="month"
                                    name="masa_perolehan_awal" value="{{ old('masa_perolehan_awal') }}">
                            </div>
                            <div class="col-md-1">
                                <h3 class="mt-2 ml-2"> - </h3>
                            </div>
                            <div class="col-md-6">
                                <input class="form-control" id="masa_perolehan_akhir" type="month"
                                    name="masa_perolehan_akhir" value="{{ old('masa_perolehan_akhir') }}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                   
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                    <button class="btn btn-success" onclick="submit1(event)" type="button">Selanjutnya!</button>
                </div>
            </form>
        </div>
    </div>
</div>


@forelse ($perampungan as $item)
<div class="modal fade" id="Modalhapus-{{ $item->id_perampungan }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered " role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger-soft">
                <h5 class="modal-title" id="exampleModalCenterTitle">Konfirmasi Hapus Data</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">×</span></button>
            </div>
            <form action="{{ route('perampungan.destroy', $item->id_perampungan) }}" method="POST" class="d-inline">
                @csrf
                @method('delete')
                <div class="modal-body text-center">Apakah Anda Yakin Menghapus Data Perampungan dengan Nomor
                    <b>{{ $item->nomor }}</b> ?</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                    <button class="btn btn-danger" type="submit">Ya! Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>
@empty

@endforelse


<div class="modal fade" id="Modalpegawai" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content ">
            <div class="modal-header bg-light ">
                <h5 class="modal-title">Pilih Pegawai</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <div class="datatable">
                    <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                        <div class="row">
                            <div class="col-sm-12">
                                <table class="table table-bordered table-hover dataTable" id="dataTablePegawai"
                                    width="100%" cellspacing="0" role="grid" aria-describedby="dataTable_info"
                                    style="width: 100%;">
                                    <thead>
                                        <tr role="row">
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1" aria-sort="ascending"
                                                aria-label="Name: activate to sort column descending"
                                                style="width: 20px;">No</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1" aria-label="Position: activate to sort column ascending"
                                                style="width: 150px;">Nama Pegawai</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1" aria-label="Position: activate to sort column ascending"
                                                style="width: 70px;">NPWP Pegawai</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1" aria-label="Start date: activate to sort column ascending"
                                                style="width: 40px;">Jabatan</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1" aria-label="Actions: activate to sort column ascending"
                                                style="width: 50px;">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody id="pegawai">
                                        @forelse ($pegawai as $item)
                                        <tr id="item-{{ $item->id_pegawai }}" role="row" class="odd">
                                            <th scope="row" class="small" class="sorting_1">{{ $loop->iteration}}</th>
                                            <td class="nama_pegawai"><span
                                                    id="{{ $item->id_pegawai }}">{{ $item->nama_pegawai }}</span></td>
                                            <td class="npwp_pegawai">{{ $item->npwp_pegawai }}</td>
                                            <td class="nama_jabatan">{{ $item->Jabatan->nama_jabatan }}</td>
                                            <td>
                                                <div class="">
                                                    <input class="checkpegawai"
                                                        id="customCheck1-{{ $item->id_pegawai }}" type="checkbox" />
                                                    <label class="" for="customCheck1">Pilih</label>
                                                </div>

                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="7" class="tex-center">
                                                Data Pegawai Kosong
                                            </td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success" onclick="tambahpegawai(event)" type="button" data-dismiss="modal">Tambah
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    function submit1(event, id_pegawai) {

        var id_perampungan  = $('#id_perampungan').val()
        console.log(id_perampungan)
        var tbody = $(`#pegawai`)
        var pegawai = []
        for (let index = 0; index < tbody.length; index++) {
            var tes = $(tbody[index]).children()
            var check = tes.find('.checkpegawai').each(function (index, element) {
                var value = $(element).is(':checked')
                if (value == true) {
                    var tr = $(element).parent().parent().parent()
                    var td = $(tr).find('.nama_pegawai')[0]
                    var nama = $(td).html()

                    var span = $(td).children()[0]
                    var id = $(span).attr('id')

                    pegawai.push({
                        id_pegawai: id,
                        id_perampungan: id_perampungan
                    })
                }
            })
        }


        var _token = $('#form1').find('input[name="_token"]').val()
        var tanggal_perampungan = $('#tanggal_perampungan').val()
        var masa_perolehan_awal = $('#masa_perolehan_awal').val()
        var masa_perolehan_akhir = $('#masa_perolehan_akhir').val()


        var data = {
            _token: _token,
            tanggal_perampungan: tanggal_perampungan,
            masa_perolehan_awal: masa_perolehan_awal,
            masa_perolehan_akhir: masa_perolehan_akhir,
            pegawai: pegawai
        }

        console.log(data)

        if (tanggal_perampungan == '' | pegawai == '' | masa_perolehan_awal == '' |
            masa_perolehan_akhir == '') {
            $('#alertdatakosong').show()
        } else {

            $.ajax({
                method: 'post',
                url: "/payroll/perampungan",
                data: data,
                success: function (response) {
                    window.location.href = '/payroll/perampungan/' + response.id_perampungan + '/edit'
                },
                error: function (error) {
                    console.log(error)
                    alert(error.responseJSON.message)
                }
            });
        }
    }


    setInterval(displayclock, 500);

    function displayclock() {
        var time = new Date()
        var hrs = time.getHours()
        var min = time.getMinutes()
        var sec = time.getSeconds()
        var en = 'AM';

        if (hrs > 12) {
            en = 'PM'
        }

        if (hrs > 12) {
            hrs = hrs - 12;
        }

        if (hrs == 0) {
            hrs = 12;
        }

        if (hrs < 10) {
            hrs = '0' + hrs;
        }

        if (min < 10) {
            min = '0' + min;
        }

        if (sec < 10) {
            sec = '0' + sec;
        }

        document.getElementById('clock').innerHTML = hrs + ':' + min + ':' + sec + ' ' + en;
    }

    $(document).ready(function () {
        $('#dataTablePegawai').DataTable()
    });

</script>

@endsection
