@extends('layouts.Admin.adminpayroll')

@section('content')

<main>
    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
        <div class="container-fluid">
            <div class="page-header-content">
                <div class="row align-items-center justify-content-between pt-3">
                    <div class="col-auto mb-3">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"></div>
                            Tambah Data Perampungan
                        </h1>
                    </div>
                    <div class="col-12 col-xl-auto mb-3">
                        <span class="small" style="color: gray">Cek aturan PPh21 <a data-toggle="modal"
                                data-target="#Modalpph21" class="font-weight-500 text-primary"> disini
                            </a></span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="container">
        <div class="card mb-4">
            <div class="card-body">
                <div class="alert alert-danger" id="alertbelumhitung" role="alert" style="display:none"> <i
                        class="fas fa-times"></i>
                    Error! Anda belum melakukan perhitungan PPH21!
                    <button class="close" type="button" onclick="$(this).parent().hide()" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="{{ route('gaji-pegawai.store') }}" method="POST" id="form1" class="d-inline">
                    @csrf
                    <div class="datatable">
                        <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table class="table table-bordered table-hover dataTable" id="dataTableA"
                                        width="100%" cellspacing="0" role="grid" aria-describedby="dataTable_info"
                                        style="width: 100%;">
                                        <thead>
                                            <tr role="row">
                                                <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                    colspan="1" aria-sort="ascending"
                                                    aria-label="Name: activate to sort column descending"
                                                    style="width: 20px;">
                                                    No</th>
                                                <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                    colspan="1" aria-label="Position: activate to sort column ascending"
                                                    style="width: 90px;">Nama Pegawai</th>
                                                <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                    colspan="1" aria-label="Position: activate to sort column ascending"
                                                    style="width: 50px;">NPWP Pegawai</th>
                                                <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                    colspan="1" aria-label="Actions: activate to sort column ascending"
                                                    style="width: 60px;">Nomor</th>
                                                <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                    colspan="1" aria-label="Actions: activate to sort column ascending"
                                                    style="width: 60px;">Status</th>
                                                <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                    colspan="1" aria-label="Actions: activate to sort column ascending"
                                                    style="width: 40px;">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($gas as $item)
                                            <tr role="row" class="odd">
                                                <th scope="row" class="small" class="sorting_1">{{ $loop->iteration}}
                                                </th>
                                                <td>{{ $item->nama_pegawai}}</td>
                                                <td>{{ $item->npwp_pegawai}}</td>
                                                
                                                <td id="nomor-{{ $item->id_pegawai }}">1.1-{{ $blt }}.{{ $year }}-00000{{ $item->id_1721a1 }}</td>
                                                <td>
                                                    <div id="SudahTerhitung-{{ $item->id_pegawai }}"
                                                        style="display: none">
                                                        <p class="text-success">Sudah Terhitung! <span
                                                                class="badge badge-success">
                                                                <i class="fas fa-check"></i></span>
                                                        </p>
                                                    </div>
                                                    <div id="BelumTerhitung-{{ $item->id_pegawai }}">
                                                        <p class="text-danger">Belum Terhitung! <span
                                                                class="badge badge-danger">
                                                                <i class="fas fa-times"></i></span>
                                                        </p>
                                                    </div>
                                                </td>
                                                <td>
                                                    <a class="btn btn-xs btn-primary"
                                                        href="#collapseCardExample-{{ $item->id_pegawai }}"
                                                        data-toggle="collapse" role="button" aria-expanded="false"
                                                        aria-controls="collapseCardExample">
                                                        Form 1721-A1</a>
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
            <div class="card-footer">
                <div class="text-right">
                    <button class="btn btn-primary btn-sm" type="button" data-toggle="modal"
                        data-target="#Modalsumbit">Simpan Data</button>
                </div>
            </div>
        </div>
    </div>


    <div id="gaji">

        @forelse ($detailgaji as $item)
            @if ($item->total_pph21 > 0)
            <div class="container">
                <div class="card card-collapsable mb-4">
                    <a class="card-header collapsed" href="#collapseCardExample-{{ $item->id_pegawai }}"
                        data-toggle="collapse" role="button" aria-expanded="false" aria-controls="collapseCardExample">FORM
                        1721 A1
                        {{ $item->Pegawai->nama_pegawai }}
                        <div class="card-collapsable-arrow">
                            <i class="fas fa-chevron-down"></i>
                        </div>
                    </a>
                    <form action="{{ route('gaji-pegawai.store') }}" method="POST" id="form2-{{ $item->id_pegawai }}"
                        class="d-inline">
                        @csrf
                        <div class="collapse" id="collapseCardExample-{{ $item->id_pegawai }}">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group row">
                                            <label for="tanggal_perampungan"
                                                class="col-sm-2 col-form-label col-form-label-sm">Tanggal</label>
                                            <div class="col-sm-6">
                                                <input type="input" class="form-control form-control-sm"
                                                    id="tanggal_perampungan" value="{{ $perampungan->tanggal_perampungan }}"
                                                    readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-5">
                                        <input style="display: none" type="input" class="form-control form-control-sm"
                                            id="id_pegawai" name="id_pegawai" value="{{ $item->id_pegawai }}" readonly>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group row">
                                            <label for="nomor"
                                                class="col-sm-2 col-form-label col-form-label-sm">Nomor</label>
                                            <div class="col-sm-8">
                                                <input type="input" class="form-control form-control-sm" id="nomor2-{{ $item->id_pegawai }}" name="nomor"
                                                    placeholder="Otomatis Terisi" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class=" col-sm-6">
                                        <div class="form-group row">
                                            <label for="nomor" class="col-sm-3 col-form-label col-form-label-sm">Masa
                                                Perolehan</label>
                                            <div class="col-sm-2">
                                                <input type="input" class="form-control form-control-sm" id="s"
                                                    value="{{ date('m', strtotime($perampungan->masa_perolehan_awal)) }}"
                                                    readonly>
                                            </div>
                                            <div class="col-sm-1 text-center">
                                                <span> - </span>
                                            </div>
                                            <div class="col-sm-2">
                                                <input type="input" class="form-control form-control-sm" id="s"
                                                    value="{{ date('m', strtotime($perampungan->masa_perolehan_akhir)) }}"
                                                    readonly>
                                            </div>
                                            <label for="nomor"
                                                class="col-sm-2 text-center  col-form-label col-form-label-sm">Tahun</label>
                                            <div class="col-sm-2">
                                                <input type="input" class="form-control form-control-sm" id="s"
                                                    value="{{ date('Y', strtotime($perampungan->masa_perolehan_awal)) }}"
                                                    readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
    
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group row">
                                            <label for="id_pemotong"
                                                class="col-sm-2 col-form-label col-form-label-sm">Pemotong</label>
                                            <div class="col-sm-8">
                                                <input type="input" class="form-control form-control-sm" id="id_pemotong"
                                                    value="{{ Auth::user()->pegawai->nama_pegawai }}" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group row">
                                            <label for="npwp_pemotong"
                                                class="col-sm-3 col-form-label col-form-label-sm">NPWP
                                                Pemotong</label>
                                            <div class="col-sm-6">
                                                <input type="input" class="form-control form-control-sm" id="npwp_pemotong"
                                                    value="{{ Auth::user()->pegawai->npwp_pegawai }}" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
    
    
                                <hr class="mt-2">
                                <h6>A. Identitas Penerima Penghasil yang Dipotong</h6>
                                <hr class="mb-4">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group row">
                                            <label for="npwp_terpotong" class="col-sm-4 col-form-label col-form-label-sm">1.
                                                NPWP</label>
                                            <div class="col-sm-1 text-center">
                                                <span> : </span>
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="input" class="form-control form-control-sm" id="npwp_terpotong"
                                                    value="{{ $item->Pegawai->nama_pegawai }}" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group row">
                                            <label for="id_ptkp" class="col-sm-4 col-form-label col-form-label-sm">6.
                                                Status/Jumlah Tanggungan Keluarga</label>
                                            <div class="col-sm-1 text-center">
                                                <span> : </span>
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="input" class="form-control form-control-sm" id="id_ptkp"
                                                    value="{{ $item->Pegawai->PTKP->nama_ptkp }}, {{ $item->Pegawai->PTKP->keterangan_ptkp }}"
                                                    readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group row">
                                            <label for="nik_terpotong" class="col-sm-4 col-form-label col-form-label-sm">2.
                                                NIK/No Paspor</label>
                                            <div class="col-sm-1 text-center">
                                                <span> : </span>
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="input" class="form-control form-control-sm" id="nik_terpotong"
                                                    value="{{ $item->Pegawai->nik_pegawai }}" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group row">
                                            <label for="nama_jabatan" class="col-sm-4 col-form-label col-form-label-sm">7.
                                                Nama
                                                Jabatan</label>
                                            <div class="col-sm-1 text-center">
                                                <span> : </span>
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="input" class="form-control form-control-sm" id="nama_jabatan"
                                                    value="{{ $item->Pegawai->Jabatan->nama_jabatan }}" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group row">
                                            <label for="nama_pegawai" class="col-sm-4 col-form-label col-form-label-sm">3.
                                                Nama</label>
                                            <div class="col-sm-1 text-center">
                                                <span> : </span>
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="input" class="form-control form-control-sm" id="nama_pegawai"
                                                    value="{{ $item->Pegawai->nama_pegawai }}" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group row">
                                            <label for="karyawan_asing" class="col-sm-4 col-form-label col-form-label-sm">8.
                                                Karyawan Asing</label>
                                            <div class="col-sm-1 text-center">
                                                <span> : </span>
                                            </div>
                                            <div class="col-sm-6">
                                                <select name="karyawan_asing" id="karyawan_asing"
                                                    class="form-control form-control-sm"
                                                    value="{{ old('karyawan_asing') }}">
                                                    <option value="Tidak">Tidak</option>
                                                    <option value="Ya">Ya</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group row">
                                            <label for="jenis_kelamin" class="col-sm-4 col-form-label col-form-label-sm">5.
                                                Jenis Kelamin</label>
                                            <div class="col-sm-1 text-center">
                                                <span> : </span>
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="input" class="form-control form-control-sm" id="jenis_kelamin"
                                                    value="{{ $item->Pegawai->jenis_kelamin }}" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group row">
                                            <label for="kode_negara" class="col-sm-4 col-form-label col-form-label-sm">9.
                                                Kode
                                                Negara Domisili</label>
                                            <div class="col-sm-1 text-center">
                                                <span> : </span>
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="input" name="kode_negara" class="form-control form-control-sm"
                                                    id="kode_negara" value="-">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group row">
                                            <label for="alamat_pegawai" class="col-sm-4 col-form-label col-form-label-sm">4.
                                                Alamat</label>
                                            <div class="col-sm-1 text-center">
                                                <span> : </span>
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="input" class="form-control form-control-sm" id="alamat_pegawai"
                                                    value="{{ $item->Pegawai->alamat }}" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
    
                                    </div>
                                </div>
    
    
                                <hr class="mt-2">
                                <h6>B. Rincian Penghasilan dan Penghitungan PPh Pasal 21</h6>
                                <hr class="mb-4">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group row">
                                            <label for="alamat_pegawai"
                                                class="col-sm-5 col-form-label col-form-label-sm">Kode
                                                Objek
                                                Pajak</label>
                                            <div class="col-sm-1 text-center">
                                                <span> : </span>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="row" id="radio1-{{ $item->id_pegawai }}">
                                                    <div class="col-md-6">
                                                        <input class="mr-1 small" value="21-100-01" type="radio"
                                                            name="radio2" checked><span class="small">21-100-01</span>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input class="mr-1 small" value="21-100-02" type="radio"
                                                            name="radio2"><span class="small">21-100-02</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
    
                                    </div>
                                </div>
    
    
                                <p class="font-italic">Penghasilan Bruto :</p>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group row">
                                            <label for="gaji_pokok" class="col-sm-5 col-form-label col-form-label-sm">1.
                                                Gaji/Pensiun
                                                Atau THT/JHT</label>
                                            <div class="col-sm-1 text-center">
                                                <span> : </span>
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="input" class="form-control form-control-sm"
                                                    id="gaji_pokok-{{ $item->id_pegawai }}" name="gaji_pokok"
                                                    value="{{ number_format($item->total_pokok) ?? '0' }}"
                                                    placeholder="Gaji/Pensiun Atau THT/JHT">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group row">
                                            <label for="tunjangan_pph" class="col-sm-5 col-form-label col-form-label-sm">2.
                                                Tunjangan
                                                PPh</label>
                                            <div class="col-sm-1 text-center">
                                                <span> : </span>
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="input" class="form-control form-control-sm"
                                                    id="tunjangan_pph-{{ $item->id_pegawai }}" name="tunjangan_pph"
                                                    value="0" placeholder="Tunj PPh">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group row">
                                            <label for="tunjangan_lain" class="col-sm-5 col-form-label col-form-label-sm">3.
                                                Tunjangan
                                                Lainnya, Uang Lembur dan Sebagainya</label>
                                            <div class="col-sm-1 text-center">
                                                <span> : </span>
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="input" class="form-control form-control-sm"
                                                    id="tunjangan_lain-{{ $item->id_pegawai }}" name="tunjangan_lain"
                                                    value="{{ number_format($item->total_tunjangan) ?? '0' }}"
                                                    placeholder="Tunj Lain">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group row">
                                            <label for="honorarium" class="col-sm-5 col-form-label col-form-label-sm">4.
                                                Honorarium
                                                dan Imbalan Lain Sejenisnya</label>
                                            <div class="col-sm-1 text-center">
                                                <span> : </span>
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="input" class="form-control form-control-sm"
                                                    id="honorarium-{{ $item->id_pegawai }}" name="honorarium" value="0"
                                                    placeholder="Honorarium">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group row">
                                            <label for="premi_prsh" class="col-sm-5 col-form-label col-form-label-sm">5.
                                                Premi
                                                Asuransi
                                                yang Dibayar Pemberi Kerja</label>
                                            <div class="col-sm-1 text-center">
                                                <span> : </span>
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="input" class="form-control form-control-sm"
                                                    id="premi_prsh-{{ $item->id_pegawai }}" name="premi_prsh" value="0"
                                                    placeholder="Premi Asuransi">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group row">
                                            <label for="natura" class="col-sm-5 col-form-label col-form-label-sm">6.
                                                Penerimaan
                                                dalam Bentuk Natura dan Kenikmatan Lainnya yang Dikenakan Pemotongan PPh
                                                Pasal
                                                21</label>
                                            <div class="col-sm-1 text-center">
                                                <span> : </span>
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="input" class="form-control form-control-sm"
                                                    id="natura-{{ $item->id_pegawai }}" name="natura" value="0"
                                                    placeholder="Natura">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group row">
                                            <label for="bonusthr" class="col-sm-5 col-form-label col-form-label-sm">7.
                                                Tantiem,
                                                Bonus,
                                                Gratifikasi, Jasa Produksi dan THR</label>
                                            <div class="col-sm-1 text-center">
                                                <span> : </span>
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="input" class="form-control form-control-sm"
                                                    id="bonusthr-{{ $item->id_pegawai }}" name="bonusthr" value="0"
                                                    placeholder="Bonus THR">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group row">
                                            <label for="bruto" class="col-sm-5 col-form-label col-form-label-sm">8. Jumlah
                                                Penghasilan Bruto (1 s.d. 7)</label>
                                            <div class="col-sm-1 text-center">
                                                <span> : </span>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="input-group input-group-joined">
                                                    <div class="input-group-prepend">
                                                        <button id="hitungbruto-{{ $item->id_pegawai }}"
                                                            class="btn btn-sm btn-primary"
                                                            onclick="hitungpenghasilanbruto(event, {{ $item->id_pegawai }})"
                                                            type="button">Hitung</button>
                                                    </div>
                                                    <input type="input" class="form-control form-control-sm"
                                                        id="bruto-{{ $item->id_pegawai }}" name="bruto" value="0"
                                                        placeholder="Jumlah Penghasilan">
                                                </div>
    
                                            </div>
                                        </div>
                                    </div>
                                </div>
    
    
                                <p class="font-italic">Pengurangan :</p>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group row">
                                            <label for="biaya_jabatan" class="col-sm-5 col-form-label col-form-label-sm">9.
                                                Biaya
                                                Jabatan/Biaya Pensiun</label>
                                            <div class="col-sm-1 text-center">
                                                <span> : </span>
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="input" class="form-control form-control-sm"
                                                    id="biaya_jabatan-{{ $item->id_pegawai }}" name="biaya_jabatan"
                                                    value="0" placeholder="Biaya Jabatan">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group row">
                                            <label for="iuran_jht" class="col-sm-5 col-form-label col-form-label-sm">10.
                                                Iuran
                                                Pensiun atau Iuran THT/JHT</label>
                                            <div class="col-sm-1 text-center">
                                                <span> : </span>
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="input" class="form-control form-control-sm"
                                                    id="iuran_jht-{{ $item->id_pegawai }}" name="iuran_jht" value="0"
                                                    placeholder="Iuran">
                                            </div>
                                        </div>
                                    </div>
                                </div>
    
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group row">
                                            <label for="total_pengurangan"
                                                class="col-sm-5 col-form-label col-form-label-sm">11.
                                                Jumlah
                                                Pengurangan (9 s.d. 10)</label>
                                            <div class="col-sm-1 text-center">
                                                <span> : </span>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="input-group input-group-joined">
                                                    <div class="input-group-prepend">
                                                        <button id="buttonpengurangan-{{ $item->id_pegawai }}"
                                                            class="btn btn-sm btn-primary"
                                                            onclick="hitungpengurangan(event, {{ $item->id_pegawai }})"
                                                            type="button">Hitung</button>
                                                    </div>
                                                    <input type="input" class="form-control form-control-sm"
                                                        id="total_pengurangan-{{ $item->id_pegawai }}"
                                                        name="total_pengurangan" value="0" placeholder="Jumlah Pengurangan">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
    
                                    </div>
                                </div>
    
                                <p class="font-italic">Penghitungan PPh Pasal 21 :</p>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group row">
                                            <label for="netto" class="col-sm-5 col-form-label col-form-label-sm">12. Jumlah
                                                Penghasilan Netto (8-11)</label>
                                            <div class="col-sm-1 text-center">
                                                <span> : </span>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="input-group input-group-joined">
                                                    <div class="input-group-prepend">
                                                        <button id="buttonnetto-{{ $item->id_pegawai }}"
                                                            class="btn btn-sm btn-primary"
                                                            onclick="hitungpenghasilanneto(event, {{ $item->id_pegawai }})"
                                                            type="button">Hitung</button>
                                                    </div>
                                                    <input type="input" class="form-control form-control-sm"
                                                        id="netto-{{ $item->id_pegawai }}" name="netto" value="0"
                                                        placeholder="Jumlah Penghasilan Netto">
                                                </div>
    
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group row">
                                            <label for="netto_sebelumnya"
                                                class="col-sm-5 col-form-label col-form-label-sm">13.
                                                Penghasilan
                                                Neto Masa Sebelumnya</label>
                                            <div class="col-sm-1 text-center">
                                                <span> : </span>
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="input" class="form-control form-control-sm"
                                                    id="netto_sebelumnya-{{ $item->id_pegawai }}" name="netto_sebelumnya"
                                                    value="0" placeholder="Netto Sebelumnya">
                                            </div>
                                        </div>
                                    </div>
                                </div>
    
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group row">
                                            <label for="netto" class="col-sm-5 col-form-label col-form-label-sm">14. Jumlah
                                                Penghasilan Netto untuk Perhitungan PPh Pasal 21(Setahun/Disetahunkan) </label>
                                            <div class="col-sm-1 text-center">
                                                <span> : </span>
                                            </div>
                                            <div class="col-sm-6">
                                                
                                                    <input type="input" class="form-control form-control-sm"
                                                        id="netto_pph21-{{ $item->id_pegawai }}" name="netto_pph21" value="0"
                                                        placeholder="Jumlah Penghasilan Netto">
                                                
    
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                       
                                    </div>
                                </div>
    
                               
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group row">
                                            <label for="ptkp" class="col-sm-5 col-form-label col-form-label-sm">15.
                                                Penghasilan
                                                Tidak Kena Pajak (PTKP)</label>
                                            <div class="col-sm-1 text-center">
                                                <span> : </span>
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="input" class="form-control form-control-sm"
                                                    id="ptkp-{{ $item->id_pegawai }}" name="ptkp"
                                                    value="{{ number_format($item->Pegawai->PTKP->besaran_ptkp) }}"
                                                    placeholder="Besaran PTKP">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group row">
                                            <label for="pkp" class="col-sm-5 col-form-label col-form-label-sm">16.
                                                Penghasilan
                                                Kena Pajak Setahun/Disetahunkan (14-15)</label>
                                            <div class="col-sm-1 text-center">
                                                <span> : </span>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="input-group input-group-joined">
                                                    <div class="input-group-prepend">
                                                        <button class="btn btn-sm btn-primary"
                                                            id="hitungpkp-{{ $item->id_pegawai }}"
                                                            onclick="hitungpenghasilankenapajak(event, {{ $item->id_pegawai }})"
                                                            type="button">Hitung</button>
                                                    </div>
                                                    <input type="input" class="form-control form-control-sm"
                                                        id="pkp-{{ $item->id_pegawai }}" name="pkp" value="0"
                                                        placeholder="Jumlah Penghasilan Kena Pajak">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
    
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group row">
                                            <label for="pph21_pkp" class="col-sm-5 col-form-label col-form-label-sm">17. PPh
                                                Pasal
                                                21 Atas Penghasilan Kena Pajak Setahun/Disetahunkan</label>
                                            <div class="col-sm-1 text-center">
                                                <span> : </span>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="input-group input-group-joined">
                                                    <div class="input-group-prepend">
                                                        <button class="btn btn-sm btn-primary"
                                                            onclick="hitungpph21(event, {{ $item->id_pegawai }})"
                                                            type="button">Hitung</button>
                                                    </div>
                                                    <input type="input" class="form-control form-control-sm"
                                                        id="pph21_pkp-{{ $item->id_pegawai }}" name="pph21_pkp" value="0"
                                                        placeholder="PPh Pasal 21 PKP">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group row">
                                            <label for="pph21_telah_pot"
                                                class="col-sm-5 col-form-label col-form-label-sm">18.
                                                PPh
                                                Pasal 21
                                                Yang Telah Dipotong Masa Sebelumnya</label>
                                            <div class="col-sm-1 text-center">
                                                <span> : </span>
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="input" class="form-control form-control-sm"
                                                    id="pph21_telah_pot-{{ $item->id_pegawai }}" name="pph21_telah_pot"
                                                    value="0" placeholder="PPh21 Telah Pot">
                                            </div>
                                        </div>
                                    </div>
                                </div>
    
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group row">
                                            <label for="pph21_terutang"
                                                class="col-sm-5 col-form-label col-form-label-sm">19.
                                                PPh
                                                Pasal
                                                21 Terutang</label>
                                            <div class="col-sm-1 text-center">
                                                <span> : </span>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="input-group input-group-joined">
                                                    <div class="input-group-prepend">
                                                        <button class="btn btn-sm btn-primary"
                                                            id="hitungpph21terutang-{{ $item->id_pegawai }}"
                                                            onclick="pph21terutang(event, {{ $item->id_pegawai }})"
                                                            type="button">Hitung</button>
                                                    </div>
                                                    <input type="input" class="form-control form-control-sm"
                                                        id="pph21_terutang-{{ $item->id_pegawai }}" name="pph21_terutang"
                                                        value="0" placeholder="PPh Pasal 21 Terutang">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group row">
                                            <label for="pph21_lunas" class="col-sm-5 col-form-label col-form-label-sm">20.
                                                PPh
                                                Pasal
                                                21
                                                dan PPh Pasal 26 Yang Telah Dipotong dan Dilunasi</label>
                                            <div class="col-sm-1 text-center">
                                                <span> : </span>
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="input" class="form-control form-control-sm"
                                                    id="pph21_lunas-{{ $item->id_pegawai }}" name="pph21_lunas"
                                                    value="{{ number_format($item->total_pph21) }}"
                                                    placeholder="PPh21 dan PPh26">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </form>
                </div>
            </div>
        </div>
            @endif
        
    @empty

    @endforelse
    </form>
</main>

<div class="modal fade" id="Modalpph21" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title" id="staticBackdropLabel">Aturan Pph21</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <div class="datatable">
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
                                                style="width: 30px;">No</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1" aria-label="Position: activate to sort column ascending"
                                                style="width: 250px;">Nama Pph21</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1" aria-label="Position: activate to sort column ascending"
                                                style="width: 100px;">Kumulatif Tahunan</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1" aria-label="Position: activate to sort column ascending"
                                                style="width: 90px;">Besaran Pph21 (%)</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tablepph21">
                                        @forelse ($pph21 as $items)
                                        <tr role="row" class="odd">
                                            <th scope="row" class="small" class="sorting_1">
                                                {{ $loop->iteration}}</th>
                                            <td>{{ $items->nama_pph21 }}</td>
                                            <td class="jumlah_pph21">
                                                Rp.{{ number_format($items->kumulatif_tahunan,2,',','.') }}</td>
                                            <td class="text-center">{{ $items->besaran_pph21 }}</td>
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
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="Modalsumbit" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success-soft">
                <h5 class="modal-title" id="staticBackdropLabel">Konfirmasi Simpan Data</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <div class="form-group text-center">Apakah Form yang Anda inputkan sudah benar?</div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                <button class="btn btn-primary" type="button"
                    onclick="simpandata(event, {{ $perampungan->id_perampungan }})">Ya
                    Sudah!</button>
            </div>
        </div>
    </div>
</div>

<script>
    function simpandata(event, id_perampungan) {
        event.preventDefault()
        var _token = $('#form1').find('input[name="_token"]').val()
        var detailperampungan = []

        var datapegawai = $('#gaji').children()
        for (let index = 0; index < datapegawai.length; index++) {
            var form = $(datapegawai[index]).children().children()
            var id_pegawai = form.find('input[name="id_pegawai"]').val()
            var kode_negara = form.find('input[name="kode_negara"]').val()
            var nomor = form.find('input[name="nomor"]').val()
            var gaji_pokok_element = form.find('input[name="gaji_pokok"]').val()

            var gaji_pokok = gaji_pokok_element.replace('&nbsp;', '')
                .replace(',', '').replace(',', '').replace(',50', '').trim()

            var karyawan_asing = form.find('select[name=karyawan_asing]').val()
            var kode_objek_pajak = form.find('input[name="radio2"]:checked').val()
            var tunjangan_pph = form.find('input[name="tunjangan_pph"]').val()
            var tunjangan_lain_element = form.find('input[name="tunjangan_lain"]').val()
            var tunjangan_lain = tunjangan_lain_element.replace('&nbsp;', '')
                .replace(',', '').replace(',', '').replace(',50', '').trim()

            var honorarium = form.find('input[name="honorarium"]').val()
            var premi_prsh = form.find('input[name="premi_prsh"]').val()
            var natura = form.find('input[name="natura"]').val()
            var bonusthr = form.find('input[name="bonusthr"]').val()
            var bruto_element = form.find('input[name="bruto"]').val()
            var bruto = bruto_element.replace('&nbsp;', '')
                .replace('.', '').replace('.', '').replace(',50', '').trim()

            var biaya_jabatan_element = form.find('input[name="biaya_jabatan"]').val()
            var biaya_jabatan = biaya_jabatan_element.replace('&nbsp;', '')
                .replace('.', '').replace('.', '').replace(',50', '').trim()

            var iuran_jht = form.find('input[name="iuran_jht"]').val()
            var total_pengurangan_element = form.find('input[name="total_pengurangan"]').val()
            var total_pengurangan = total_pengurangan_element.replace('&nbsp;', '')
                .replace('.', '').replace('.', '').replace(',50', '').trim()

            var netto_element = form.find('input[name="netto"]').val()
            var netto = netto_element.replace('&nbsp;', '')
                .replace('.', '').replace('.', '').replace(',50', '').trim()

            var netto_sebelumnya = form.find('input[name="netto_sebelumnya"]').val()
            var netto_pph21_element = form.find('input[name="netto_pph21"]').val()
            var netto_pph21 = netto_pph21_element.replace('&nbsp;', '')
                .replace('.', '').replace('.', '').replace(',50', '').trim()

            var ptkp_element = form.find('input[name="ptkp"]').val()
            var ptkp = ptkp_element.replace('&nbsp;', '')
                .replace(',', '').replace(',', '').replace(',50', '').trim()

            var pkp_element = form.find('input[name="pkp"]').val()
            var pkp = pkp_element.replace('&nbsp;', '')
                .replace('.', '').replace('.', '').replace(',50', '').trim()

            var pph21_pkp_element = form.find('input[name="pph21_pkp"]').val()
            var pph21_pkp = pph21_pkp_element.replace('&nbsp;', '')
                .replace('.', '').replace('.', '').replace(',50', '').trim()

            var pph21_telah_pot = form.find('input[name="pph21_telah_pot"]').val()
            var pph21_terutang_element = form.find('input[name="pph21_terutang"]').val()
            var pph21_terutang = pph21_terutang_element.replace('&nbsp;', '')
                .replace('.', '').replace('.', '').replace(',50', '').trim()

            var pph21_lunas_element = form.find('input[name="pph21_lunas"]').val()
            var pph21_lunas = pph21_lunas_element.replace('&nbsp;', '')
                .replace(',', '').replace(',', '').replace(',50', '').trim()

            if (pph21_terutang == 0) {
                Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Anda Belum Melakukan Perhitungan PPh21 Final!',
            })
            } else {
                detailperampungan.push({
                    nomor: nomor,
                    id_pegawai: id_pegawai,
                    id_perampungan: id_perampungan,
                    kode_negara: kode_negara,
                    karyawan_asing: karyawan_asing,
                    kode_objek_pajak: kode_objek_pajak,
                    gaji_pokok: gaji_pokok,
                    tunjangan_pph: tunjangan_pph,
                    tunjangan_lain: tunjangan_lain,
                    honorarium: honorarium,
                    premi_prsh: premi_prsh,
                    natura: natura,
                    bonusthr: bonusthr,
                    bruto: bruto,
                    biaya_jabatan: biaya_jabatan,
                    iuran_jht: iuran_jht,
                    total_pengurangan: total_pengurangan,
                    netto: netto,
                    netto_sebelumnya: netto_sebelumnya,
                    netto_pph21: netto_pph21,
                    ptkp: ptkp,
                    pkp: pkp,
                    pph21_pkp: pph21_pkp,
                    pph21_telah_pot: pph21_telah_pot,
                    pph21_terutang: pph21_terutang,
                    pph21_lunas: pph21_lunas
                })
            }
        }

        var data = {
            _token: _token,
            detail: detailperampungan
        }

        var sweet_loader =
                '<div class="sweet_loader"><svg viewBox="0 0 140 140" width="140" height="140"><g class="outline"><path d="m 70 28 a 1 1 0 0 0 0 84 a 1 1 0 0 0 0 -84" stroke="rgba(0,0,0,0.1)" stroke-width="4" fill="none" stroke-linecap="round" stroke-linejoin="round"></path></g><g class="circle"><path d="m 70 28 a 1 1 0 0 0 0 84 a 1 1 0 0 0 0 -84" stroke="#71BBFF" stroke-width="4" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-dashoffset="200" stroke-dasharray="300"></path></g></svg></div>';
                
        $.ajax({
            method: 'put',
            url: '/payroll/perampungan/' + id_perampungan,
            data: data,
            beforeSend: function () {
                    swal.fire({
                        title: 'Mohon Tunggu!',
                        html: 'Data Perampungan Sedang Diproses...',
                        showConfirmButton: false,
                        onRender: function () {
                            // there will only ever be one sweet alert open.
                            $('.swal2-content').prepend(sweet_loader);
                        }
                    });
                },
            success: function (response) {
                console.log(response)
                swal.fire({
                        icon: 'success',
                        showConfirmButton: false,
                        html: '<h5>Success!</h5>'
                    });
                window.location.href = '/payroll/perampungan'

            },
            error: function (response) {
                console.log(response)
                swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        html: error.responseJSON.message
                    });
            }
        });


    }


    function hitungpenghasilanbruto(event, id_pegawai) {
        var gaji_pokok_element = $(`#gaji_pokok-${id_pegawai}`).val()
        var gaji_pokok = gaji_pokok_element.replace('&nbsp;', '')
            .replace(',', '').replace(',', '').replace(',50', '').trim()

        var tunjangan_pph = $(`#tunjangan_pph-${id_pegawai}`).val()
        var tunjangan_lain_element = $(`#tunjangan_lain-${id_pegawai}`).val()
        var tunjangan_lain = tunjangan_lain_element.replace('&nbsp;', '')
            .replace(',', '').replace(',', '').replace(',50', '').trim()

        var honorarium = $(`#honorarium-${id_pegawai}`).val()
        var premi_prsh = $(`#premi_prsh-${id_pegawai}`).val()
        var natura = $(`#natura-${id_pegawai}`).val()
        var bonusthr = $(`#bonusthr-${id_pegawai}`).val()


        var brutofix = parseInt(gaji_pokok) + parseInt(tunjangan_pph) + parseInt(tunjangan_lain) + parseInt(
                honorarium) +
            parseInt(premi_prsh) + parseInt(natura) + parseInt(bonusthr)



        $(`#bruto-${id_pegawai}`).val(
            new Intl.NumberFormat('id', {}).format(brutofix))


        var biayajabatan = brutofix * 5
        var biayajabatanfix = biayajabatan / 100
        var maxbiayajabatan = 6000000


        if (biayajabatanfix >= maxbiayajabatan) {
            $(`#biaya_jabatan-${id_pegawai}`).val(
                new Intl.NumberFormat('id', {}).format(maxbiayajabatan))
        } else {
            $(`#biaya_jabatan-${id_pegawai}`).val(
                new Intl.NumberFormat('id', {}).format(biayajabatanfix))
        }

        var nomor = $(`#nomor-${id_pegawai}`).html()
        var nomor_fix = $(`#nomor2-${id_pegawai}`).val(nomor)

        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })

        Toast.fire({
            icon: 'success',
            title: 'Berhasil Menghitung Bruto dan Biaya Jabatan'
        })
    }

    function hitungpengurangan(event, id_pegawai) {
        var biaya_jabatan_element = $(`#biaya_jabatan-${id_pegawai}`).val()
        var biaya_jabatan = biaya_jabatan_element.replace('&nbsp;', '')
            .replace('.', '').replace('.', '').replace(',50', '').trim()

        var iuran_jht = $(`#iuran_jht-${id_pegawai}`).val()
        var bruto = $(`#bruto-${id_pegawai}`).val()

        if (bruto == 0) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Belum Menghitung Gaji Bruto',
                timer: 2000,
                timerProgressBar: true,
            })
        } else {
            var total_pengurangan = parseInt(biaya_jabatan) + parseInt(iuran_jht)
            $(`#total_pengurangan-${id_pegawai}`).val(new Intl.NumberFormat('id', {}).format(total_pengurangan))
            
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })

            Toast.fire({
                icon: 'success',
                title: 'Jumlah Pengurangan Berhasil dihitung'
            })

        }
    }

    function hitungpenghasilanneto(event, id_pegawai) {

        var gaji_bruto_element = $(`#bruto-${id_pegawai}`).val()
        var gaji_bruto = gaji_bruto_element.replace('&nbsp;', '')
            .replace('.', '').replace('.', '').replace(',50', '').trim()

        var total_pengurangan_element = $(`#total_pengurangan-${id_pegawai}`).val()
        var total_pengurangan = total_pengurangan_element.replace('&nbsp;', '')
            .replace('.', '').replace('.', '').replace(',50', '').trim()

        if (gaji_bruto == 0 && total_pengurangan == 0) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Belum Menghitung Gaji Bruto dan Jumlah Pengurangan',
                timer: 2000,
                timerProgressBar: true,
            })
        } else {
            var neto = parseInt(gaji_bruto) - parseInt(total_pengurangan)
            $(`#netto-${id_pegawai}`).val(new Intl.NumberFormat('id', {}).format(neto))
            $(`#netto_pph21-${id_pegawai}`).val(new Intl.NumberFormat('id', {}).format(neto))

            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })

            Toast.fire({
                icon: 'success',
                title: 'Penghasilan Netto Berhasil dihitung'
            })


        }
    }

    function hitungpenghasilankenapajak(event, id_pegawai) {
        var netto_pph21_element = $(`#netto_pph21-${id_pegawai}`).val()
        var netto_pph21 = netto_pph21_element.replace('&nbsp;', '')
            .replace('.', '').replace('.', '').replace(',50', '').trim()

        var ptkp_element = $(`#ptkp-${id_pegawai}`).val()
        var ptkp = ptkp_element.replace('&nbsp;', '')
            .replace(',', '').replace(',', '').replace(',50', '').trim()

        var netto = $(`#netto-${id_pegawai}`).val()

        if (netto == 0) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Belum Menghitung Gaji Netto',
                timer: 2000,
                timerProgressBar: true,
            })
        } else {
            var pkp = parseInt(netto_pph21) - parseInt(ptkp)
            $(`#pkp-${id_pegawai}`).val(new Intl.NumberFormat('id', {}).format(pkp))
            
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })

            Toast.fire({
                icon: 'success',
                title: 'Jumlah PKP Berhasil dihitung'
            })


        }

    }

    function hitungpph21(event, id_pegawai) {
        var datapph21 = $('#tablepph21').children()
        var children = $(datapph21).children()

        // 50JT
        var td1 = children[2]
        var pph1 = $($(td1)).html().split('Rp')[1].replace('.', '').replace('.', '').replace('.', '').replace(',00',
            '').trim()
        var tdpersen1 = children[3]
        var pphpersen1 = $($(tdpersen1)).html()

        // 250JT
        var td2 = children[6]
        var pph2 = $($(td2)).html().split('Rp')[1].replace('.', '').replace('.', '').replace('.', '').replace(',00',
            '').trim()
        var tdpersen2 = children[7]
        var pphpersen2 = $($(tdpersen2)).html()

        // 500JT
        var td3 = children[10]
        var pph3 = $($(td3)).html().split('Rp')[1].replace('.', '').replace('.', '').replace('.', '').replace(',00',
            '').trim()
        var tdpersen3 = children[11]
        var pphpersen3 = $($(tdpersen3)).html()

        // DIATAS 500JT
        var tdpersen4 = children[15]
        var pphpersen4 = $($(tdpersen4)).html()


        // Penghasilan Kena Pajak
        var pkpasik_element = $(`#pkp-${id_pegawai}`).val()
        var pkpasik = pkpasik_element.replace('&nbsp;', '')
            .replace('.', '').replace('.', '').replace(',50', '').trim()

        var pkp = parseInt(pkpasik)

        if (pkp == 0) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Belum Menghitung PKP',
                timer: 2000,
                timerProgressBar: true,
            })
        } else {
            if (pkp <= pph1) {
                var pphlevel1 = pkp * pphpersen1
                var pphlevel1fix = pphlevel1 / 100

                var str = pphlevel1fix.toString();
                var numarray = str.split('.');
                var a = new Array();
                a = numarray;

                // FIX PPH Level 2
                var pphlevel1tahun = a[0];


                if (pphlevel1tahun <= 0) {
                    var pajaknull = 0
                    $(`#pph21_pkp-${id_pegawai}`).val(new Intl.NumberFormat('id', {}).format(pajaknull))
                    swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        html: 'Pegawai Tidak dikenakan PPh21',
                        timer: 2500,
                        timerProgressBar: true,
                    });
                   
                } else {
                    $(`#pph21_pkp-${id_pegawai}`).val(new Intl.NumberFormat('id', {}).format(pphlevel1tahun))
                    swal.fire({
                        icon: 'success',
                        title: 'Berhasil Menghitung PPh21' ,
                        html: 'Pegawai dikenakan sebesar Rp.' + pphlevel1tahun,
                        timer: 2500,
                        timerProgressBar: true,
                    });
                }

            } else if (pkp > pph1 && pkp <= pph2) {
                // Perhitungan 5%
                var pphkena5 = pph1
                var pphkena5fix = pphkena5 * pphpersen1
                var pphkena5sangat = pphkena5fix / 100

                // Perhitungan 15%
                var pphkena15 = pkp - pph1
                var pphkena15fix = pphkena15 * pphpersen2
                var pphkena15sangat = pphkena15fix / 100


                // Penambahan
                var pphlevel2 = parseInt(pphkena5sangat + pphkena15sangat)

                // var pphlevel2hampir = pphlevel2 / 12

                // Memecah Bilangan Decimal
                var str = pphlevel2.toString();
                var numarray = str.split('.');
                var a = new Array();
                a = numarray;

                // FIX PPH Level 2
                var pphlevel2tahun = a[0];


                $(`#pph21_pkp-${id_pegawai}`).val(new Intl.NumberFormat('id', {}).format(pphlevel2tahun))
                swal.fire({
                        icon: 'success',
                        title: 'Berhasil Menghitung PPh21' ,
                        html: 'Pegawai dikenakan sebesar Rp.' + pphlevel2tahun,
                        timer: 2500,
                        timerProgressBar: true,
                    });

            } else if (pkp > pph2 && pkp <= pph3) {
                // Perhitungan 5%
                var pph3kena5 = pph1
                var pph3kena5fix = pph3kena5 * pphpersen1
                var pph3kena5sangat = pph3kena5fix / 100


                // Perhitungan 15 %
                var pph3kena15 = pph2
                var pph3kena15fix = pph3kena15 * pphpersen2
                var pph3kena15sangat = pph3kena15fix / 100


                // Perhitungan 25%
                var pph3kena25 = parseInt(pph3kena15) + parseInt(pph3kena5)
                var tespph3kena25 = parseInt(pkp - pph3kena25)
                var pph3kena25fix = tespph3kena25 * pphpersen3
                var pph3kena25sangat = pph3kena25fix / 100

                var pphlevel3 = parseInt(pph3kena5sangat + pph3kena15sangat + pph3kena25sangat)

                var str = pphlevel3.toString();
                var numarray = str.split('.');
                var a = new Array();
                a = numarray;

                // FIX PPH Level 2
                var pphlevel3tahun = a[0];
                $(`#pph21_pkp-${id_pegawai}`).val(new Intl.NumberFormat('id', {}).format(pphlevel3tahun))
                swal.fire({
                        icon: 'success',
                        title: 'Berhasil Menghitung PPh21' ,
                        html: 'Pegawai dikenakan sebesar Rp.' + pphlevel3tahun,
                        timer: 2500,
                        timerProgressBar: true,
                    });

            }
        }




    }

    function pph21terutang(event, id_pegawai) {
        var pph21_pkp_element = $(`#pph21_pkp-${id_pegawai}`).val()
        var pph21_pkp = pph21_pkp_element.replace('&nbsp;', '')
            .replace('.', '').replace('.', '').replace(',50', '').trim()

        var pph21_telah_pot = $(`#pph21_telah_pot-${id_pegawai}`).val()

        if (pph21_pkp == 0) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Belum Menghitung PPh21',
                timer: 2000,
                timerProgressBar: true,
            })
        } else {
            var pph21_terutang = parseInt(pph21_pkp) + parseInt(pph21_telah_pot)
            $(`#pph21_terutang-${id_pegawai}`).val(new Intl.NumberFormat('id', {}).format(pph21_terutang))
            $(`#SudahTerhitung-${id_pegawai}`).show()
            $(`#BelumTerhitung-${id_pegawai}`).hide()

            swal.fire({
                icon: 'success',
                title: 'Berhasil' ,
                html: 'Berhasil Menghitung PPh21 Final',
                timer: 3000,
                timerProgressBar: true,
            });
        }

    }

</script>



@endsection
