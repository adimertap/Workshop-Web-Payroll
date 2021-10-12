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
                                                style="width: 80px;">Nomor</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1" aria-label="Position: activate to sort column ascending"
                                                style="width: 40px;">Tahun</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1" aria-label="Office: activate to sort column ascending"
                                                style="width: 100px;">Pegawai</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1" aria-label="Office: activate to sort column ascending"
                                                style="width: 100px;">NPWP</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1" aria-label="Actions: activate to sort column ascending"
                                                style="width: 90px;">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($perampungan as $item)
                                        <tr role="row" class="odd">
                                            <th scope="row" class="small" class="sorting_1">{{ $loop->iteration}}</th>
                                            <td>{{ $item->nomor }}</td>
                                            <td>{{ $item->tahun}}</td>
                                            <td>{{ $item->Pegawai->nama_pegawai}}</td>
                                            <td>{{ $item->Pegawai->npwp_pegawai}}</td>
                                            <td>
                                                <a href="{{ route('perampungan.show', $item->id_perampungan) }}"
                                                    class="btn btn-secondary btn-datatable" data-toggle="tooltip"
                                                    data-placement="top" title="" data-original-title="Detail Slip">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                                <a href="{{ route('perampungan.edit', $item->id_perampungan) }}"
                                                    class="btn btn-primary btn-datatable" data-toggle="tooltip"
                                                    data-placement="top" title="" data-original-title="Edit Slip">
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
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
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
                            <label class="small mb-1" for="tanggal_perampungan">Tanggal</label>
                            <input class="form-control" id="tanggal_perampungan" type="date" name="tanggal_perampungan"
                                value="{{ old('tanggal_perampungan') }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label class="small mb-1 mr-1" for="id_pegawai">Pilih Pegawai</label><span class="mr-4 mb-3"
                                style="color: red">*</span>
                            <select class="form-control" name="id_pegawai" id="id_pegawai"
                                class="form-control @error('id_pegawai') is-invalid @enderror">
                                <option>Pilih Pegawai</option>
                                @foreach ($pegawai as $pegawais)
                                <option value="{{ $pegawais->id_pegawai }}">{{ $pegawais->nama_pegawai }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-8">
                            <label class="small mb-1">Masa Perolehan Penghasilan</label>
                            <div class="row">
                                <div class="col-md-5">
                                    <input class="form-control" id="masa_perolehan_awal" type="date"
                                        name="masa_perolehan_awal" value="{{ old('masa_perolehan_awal') }}">
                                </div>
                                <div class="col-md-1">
                                    <label class="small mt-1">sampai</label>
                                </div>
                                <div class="col-md-5">
                                    <input class="form-control" id="masa_perolehan_akhir" type="date"
                                        name="masa_perolehan_akhir" value="{{ old('masa_perolehan_akhir') }}">
                                </div>
                            </div>

                        </div>
                        <div class="form-group col-md-4">
                            <label class="small mb-1" for="tahun">Tahun</label>
                            <input class="form-control" id="tahun" type="input" name="tahun" value="{{ old('tahun') }}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="small mb-1" for="karyawan_asing">Karyawan Asing</label>
                            <select name="karyawan_asing" id="karyawan_asing" class="form-control"
                                class="form-control @error('karyawan_asing') is-invalid @enderror">
                                <option value="Tidak">Tidak</option>
                                <option value="Ya">Ya</option>
                            </select>
                            @error('karyawan_asing')<div class="text-danger small mb-1">{{ $message }}
                            </div> @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label class="small mb-1" for="kode_negara">Kode Negara Domisili</label>
                            <input class="form-control" id="kode_negara" type="input" name="kode_negara"
                                value="{{ old('kode_negara') }}">
                        </div>
                    </div>

                    {{-- <div class="row">
                        
                        <div class="form-group col-md-6">
                            <label class="small mb-1" for="bulan_gaji">Bulan</label>
                            <select name="bulan_gaji" id="bulan_gaji" class="form-control"
                                class="form-control @error('bulan_gaji') is-invalid @enderror">
                                <option value="{{ old('bulan_gaji')}}">Pilih Bulan Gaji</option>
                    <option value="Januari">Januari</option>
                    <option value="Februari">Februari</option>
                    <option value="Maret">Maret</option>
                    <option value="April">April</option>
                    <option value="Mei">Mei</option>
                    <option value="Juni">Juni</option>
                    <option value="Juli">Juli</option>
                    <option value="Agustus">Agustus</option>
                    <option value="September">September</option>
                    <option value="Oktober">Oktober</option>
                    <option value="November">November</option>
                    <option value="Desember">Desember</option>
                    </select>
                    @error('bulan_gaji')<div class="text-danger small mb-1">{{ $message }}
                    </div> @enderror
                </div>
        </div> --}}
    </div>
    <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
        <button class="btn btn-success" onclick="submit1()" type="button">Selanjutnya!</button>
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

<script>
    // function submit1() {
    //     var _token = $('#form1').find('input[name="_token"]').val()
    //     var bulan_gaji = $('#bulan_gaji').val()
    //     var tahun_gaji = $('#tahun_gaji').val()
    //     // var id_jenis_transaksi = $('#id_jenis_transaksi').val()

    //     var data = {
    //         _token: _token,
    //         bulan_gaji: bulan_gaji,
    //         tahun_gaji: tahun_gaji,
    //         // id_jenis_transaksi: id_jenis_transaksi
    //     }

    //     if (tahun_gaji == 0 | tahun_gaji == '' | bulan_gaji == 0 | bulan_gaji == 'Pilih Bulan Gaji') {
    //         $('#alertdatakosong').show()
    //     } else {

    //         $.ajax({
    //             method: 'post',
    //             url: "/payroll/gaji-pegawai",
    //             data: data,
    //             success: function (response) {
    //                 window.location.href = '/payroll/gaji-pegawai/' + response.id_gaji_pegawai + '/edit'
    //             },
    //             error: function (error) {
    //                 console.log(error)
    //                 alert(error.responseJSON.message)
    //             }
    //         });
    //     }
    // }    

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

</script>

@endsection
