@extends('layouts.Admin.adminpayroll')

@section('content')
{{-- HEADER --}}
<main>
    <div class="container mt-5">
        <!-- Custom page header alternative example-->
        <div class="d-flex justify-content-between align-items-sm-center flex-column flex-sm-row mb-4">
            <div class="mr-4 mb-3 mb-sm-0">
                <h1 class="mb-0">Penggajian Pegawai</h1>
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
                <div class="card-header ">List Penggajian
                    <a href="" class="btn btn-sm btn-primary" type="button" data-toggle="modal"
                        data-target="#Modaltambah">
                        Tambah Data Gaji
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
                    @if(session('messagebayar'))
                    <div class="alert alert-success" role="alert"> <i class="fas fa-check"></i>
                        {{ session('messagebayar') }}
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
                                                style="width: 20px;">Tahun</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1" aria-label="Position: activate to sort column ascending"
                                                style="width: 40px;">Bulan</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1" aria-label="Office: activate to sort column ascending"
                                                style="width: 100px;">Total Gaji</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1" aria-label="Office: activate to sort column ascending"
                                                style="width: 70px;">Total Tunjangan</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1" aria-label="Office: activate to sort column ascending"
                                                style="width: 100px;">Total Pph21</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1" aria-label="Start date: activate to sort column ascending"
                                                style="width: 40px;">Status diterima</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1" aria-label="Actions: activate to sort column ascending"
                                                style="width: 160px;">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($gaji as $item)
                                        <tr role="row" class="odd">
                                            <th scope="row" class="small" class="sorting_1">{{ $loop->iteration}}</th>
                                            <td>{{ date('Y', strtotime($item->bulan_gaji)) }}</td>
                                            <td>{{ date('F', strtotime($item->bulan_gaji)) }}</td>
                                            <td>Rp. {{ number_format($item->grand_total_gaji,2,',','.') }}</td>
                                            <td>Rp. {{ number_format($item->grand_total_tunjangan,2,',','.') }}</td>
                                            <td>Rp. {{ number_format($item->grand_total_pph21,2,',','.') }}</td>
                                            <td> @if($item->status_diterima == 'Belum Dibayarkan')
                                                <span class="badge badge-danger">
                                                    @elseif($item->status_diterima == 'Dibayarkan')
                                                    <span class="badge badge-success">
                                                        @else
                                                        <span>
                                                            @endif
                                                            {{ $item->status_diterima }}
                                                        </span>
                                            <td>
                                                @if($item->status_diterima == 'Belum Dibayarkan' and $item->status_dana == 'Dana Telah Diberikan')
                                                    <a href="" class="btn btn-success btn-datatable" type="button"
                                                        data-toggle="modal"
                                                        data-target="#Modalbayar-{{ $item->id_gaji_pegawai }}">
                                                        <i class="fas fa-check"></i>
                                                    </a>
                                                    <a href="{{ route('cetak-slip-gaji', $item->id_gaji_pegawai) }}" target="_blank" class="btn btn-teal btn-datatable" data-toggle="tooltip"
                                                        data-placement="top" title="" data-original-title="Cetak Slip">
                                                        <i class="fas fa-print"></i></i>
                                                    </a>
                                                    <a href="{{ route('gaji-pegawai.show', $item->id_gaji_pegawai) }}"
                                                        class="btn btn-secondary btn-datatable" data-toggle="tooltip"
                                                        data-placement="top" title="" data-original-title="Detail Slip">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                    <a href="{{ route('gaji-pegawai-edit', $item->id_gaji_pegawai) }}" class="btn btn-primary btn-datatable" data-toggle="tooltip"
                                                        data-placement="top" title="" data-original-title="Edit Slip">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <a href="" class="btn btn-danger btn-datatable" type="button"
                                                        data-toggle="modal"
                                                        data-target="#Modalhapus-{{ $item->id_gaji_pegawai }}">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                @elseif ($item->status_diterima == 'Belum Dibayarkan' and
                                                $item->status_dana =='Dana Belum Cair')
                                                    <a href="{{ route('cetak-slip-gaji', $item->id_gaji_pegawai) }}" target="_blank" class="btn btn-teal btn-datatable" data-toggle="tooltip"
                                                        data-placement="top" title="" data-original-title="Cetak Slip">
                                                        <i class="fas fa-print"></i></i>
                                                    </a>
                                                    <a href="{{ route('gaji-pegawai.show', $item->id_gaji_pegawai) }}"
                                                        class="btn btn-secondary btn-datatable" data-toggle="tooltip"
                                                        data-placement="top" title="" data-original-title="Detail Slip">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                    <a href="{{ route('gaji-pegawai-edit', $item->id_gaji_pegawai) }}" class="btn btn-primary btn-datatable" data-toggle="tooltip"
                                                        data-placement="top" title="" data-original-title="Edit Slip">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <a href="" class="btn btn-danger btn-datatable" type="button"
                                                        data-toggle="modal"
                                                        data-target="#Modalhapus-{{ $item->id_gaji_pegawai }}">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                @elseif ($item->status_diterima == 'Dibayarkan' and $item->status_dana == 'Dana Telah Diberikan')
                                                    <a href="{{ route('cetak-slip-gaji', $item->id_gaji_pegawai) }}" target="_blank" class="btn btn-teal btn-datatable" data-toggle="tooltip"
                                                        data-placement="top" title="" data-original-title="Cetak Slip">
                                                        <i class="fas fa-print"></i></i>
                                                    </a>
                                                    <a href="{{ route('gaji-pegawai.show', $item->id_gaji_pegawai) }}"
                                                        class="btn btn-secondary btn-datatable" data-toggle="tooltip"
                                                        data-placement="top" title="" data-original-title="Detail Slip">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                
                                                @else
                                                @endif
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
                <h5 class="modal-title" id="exampleModalCenterTitle">Tambah Data Gaji Pegawai</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">×</span></button>
            </div>
            <form action="{{ route('gaji-pegawai.store') }}" method="POST" id="form1" class="d-inline">
                @csrf
                <div class="modal-body">
                    <label class="small mb-1">Tentukan Tanggal dan Tahun Bayar Gaji Pegawai</label>
                    <div class="alert alert-danger" id="alertdatakosong" role="alert" style="display:none"><i class="far fa-times-circle"></i>
                        <span class="small">Error! Terdapat Data yang Masih Kosong!</span> 
                        <button class="close" type="button" onclick="$(this).parent().hide()" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <hr>
                    </hr>
                    <div class="form-group">
                        <label class="small mb-1" for="bulan_gaji">Bulan Bayar</label>
                        <input class="form-control" id="bulan_gaji" type="month" name="bulan_gaji"
                            class="form-control @error('bulan_gaji') is-invalid @enderror" />
                        @error('bulan_gaji')<div class="text-danger small mb-1">{{ $message }}
                        </div> @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                    <button class="btn btn-success" onclick="submit1()" type="button">Selanjutnya!</button>
                </div>
            </form>
        </div>
    </div>
</div>

@forelse ($gaji as $item)
<div class="modal fade" id="Modalbayar-{{ $item->id_gaji_pegawai }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title" id="exampleModalCenterTitle">Konfirmasi Pembayaran Gaji Pegawai</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">×</span></button>
            </div>
            <form action="{{ route('gaji-pegawai-status', $item->id_gaji_pegawai) }}?status=Dibayarkan" method="POST"
                class="d-inline">
                @csrf
                <div class="modal-body text-center">Apakah Anda Yakin untuk Melakukan Pembayaran Gaji Pegawai bulan
                    {{ $item->bulan_gaji }}, tahun {{ $item->tahun_gaji }} Sebesar Rp.
                    {{ number_format($item->grand_total_gaji,2,',','.') }} ?</div>
                <div class="modal-footer ">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                    <button class="btn btn-success" type="submit">Ya! Bayar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@empty
@endforelse

@forelse ($gaji as $item)
<div class="modal fade" id="Modalhapus-{{ $item->id_gaji_pegawai }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger-soft">
                <h5 class="modal-title" id="exampleModalCenterTitle">Konfirmasi Hapus Data</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">×</span></button>
            </div>
            <form action="{{ route('gaji-pegawai.destroy', $item->id_gaji_pegawai) }}" method="POST" class="d-inline">
                @csrf
                @method('delete')
                <div class="modal-body text-center">Apakah Anda Yakin Menghapus Data Pembayaran Gaji Pegawai bulan
                   <b>{{ $item->bulan_gaji }}</b> , tahun <b>{{ $item->tahun_gaji }}</b> ?</div>
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

    function submit1() {
        var _token = $('#form1').find('input[name="_token"]').val()
        var bulan_gaji = $('#bulan_gaji').val()
        // var tahun_gaji = $('#tahun_gaji').val()
        // var id_jenis_transaksi = $('#id_jenis_transaksi').val()

        var data = {
            _token: _token,
            bulan_gaji: bulan_gaji,
            // tahun_gaji: tahun_gaji,
            // id_jenis_transaksi: id_jenis_transaksi
        }

        console.log(data)

        if ( bulan_gaji == '') {
            $('#alertdatakosong').show()
        } else {

            $.ajax({
                method: 'post',
                url: "/payroll/gaji-pegawai",
                data: data,
                success: function (response) {
                    window.location.href = '/payroll/gaji-pegawai/' + response.id_gaji_pegawai + '/edit'
                    console.log(response)
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

</script>

@endsection
