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

                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="container">
        <div class="card mb-4">
            <div class="card-body ">
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
                                                style="width: 20px;">
                                                No</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1" aria-label="Position: activate to sort column ascending"
                                                style="width: 40px;">Nama Pegawai</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1" aria-label="Position: activate to sort column ascending"
                                                style="width: 40px;">NPWP Pegawai</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1" aria-label="Actions: activate to sort column ascending"
                                                style="width: 40px;">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($detailgaji as $item)
                                        <tr role="row" class="odd">
                                            <th scope="row" class="small" class="sorting_1">{{ $loop->iteration}}</th>
                                            <td>{{ $item->Pegawai->nama_pegawai}}</td>
                                            <td>{{ $item->Pegawai->npwp_pegawai}}</td>
                                            {{-- <td>1.1-{{ $blt }}.{{ $year }}-00000{{ $perampungan->Detail->id_1721a1 }}
                                            </td> --}}
                                            <td>
                                                <div id="{{ $item->id_pegawai }}-SudahTerhitung" style="display: none">
                                                    <p class="text-success">Sudah Terhitung! <span
                                                            class="badge badge-success">
                                                            <i class="fas fa-check"></i></span>
                                                    </p>
                                                </div>
                                                <div id="{{ $item->id_pegawai }}-BelumTerhitung">
                                                    <p class="text-danger">Belum Terhitung! <span
                                                            class="badge badge-danger">
                                                            <i class="fas fa-times"></i></span>
                                                    </p>
                                                </div>
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


    @forelse ($detailgaji as $item)
    <div class="container">
        <div class="card card-collapsable mb-4">
            <a class="card-header" href="#collapseCardExample-{{ $item->id_pegawai }}" data-toggle="collapse"
                role="button" aria-expanded="false" aria-controls="collapseCardExample">FORM 1721 A1
                {{ $item->Pegawai->nama_pegawai }}
                <div class="card-collapsable-arrow">
                    <i class="fas fa-chevron-down"></i>
                </div>
            </a>
            <form action="{{ route('gaji-pegawai.store') }}" method="POST" id="form1" class="d-inline">
                @csrf
                <div class="collapse show" id="collapseCardExample-{{ $item->id_pegawai }}">
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

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="nomor" class="col-sm-2 col-form-label col-form-label-sm">Nomor</label>
                                    <div class="col-sm-8">
                                        <input type="input" class="form-control form-control-sm" id="nomor" value=""
                                            readonly>
                                    </div>
                                </div>
                            </div>
                            <div class=" col-sm-6">
                                <div class="form-group row">
                                    <label for="nomor" class="col-sm-3 col-form-label col-form-label-sm">Masa
                                        Perolehan</label>
                                    <div class="col-sm-2">
                                        <input type="input" class="form-control form-control-sm" id="nomor"
                                            value="{{ date('m', strtotime($perampungan->masa_perolehan_awal)) }}"
                                            readonly>
                                    </div>
                                    <div class="col-sm-1 text-center">
                                        <span> - </span>
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="input" class="form-control form-control-sm" id="nomor"
                                            value="{{ date('m', strtotime($perampungan->masa_perolehan_akhir)) }}"
                                            readonly>
                                    </div>
                                    <label for="nomor"
                                        class="col-sm-2 text-center  col-form-label col-form-label-sm">Tahun</label>
                                    <div class="col-sm-2">
                                        <input type="input" class="form-control form-control-sm" id="nomor"
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
                                    <label for="npwp_pemotong" class="col-sm-3 col-form-label col-form-label-sm">NPWP
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
                                        <select class="form-control form-control-sm" name="id_ptkp" id="id_ptkp">
                                            <option value="{{ $item->Pegawai->PTKP->id_ptkp }}">
                                                {{ $item->Pegawai->PTKP->nama_ptkp }}</option>
                                            @foreach ($ptkp as $itemptkp)
                                            <option value="{{ $itemptkp->id_ptkp }}">{{ $itemptkp->nama_ptkp }}
                                            </option>
                                            @endforeach
                                        </select>
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
                                    <label for="nama_jabatan" class="col-sm-4 col-form-label col-form-label-sm">7. Nama
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
                                        <select name="karyawan_asing" id="karyawan_asing" class="form-control form-control-sm"
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
                                    <label for="kode_negara" class="col-sm-4 col-form-label col-form-label-sm">9. Kode
                                        Negara Domisili</label>
                                    <div class="col-sm-1 text-center">
                                        <span> : </span>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="input" class="form-control form-control-sm" id="kode_negara">
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
                                <span class="small" style="color: gray">Cek aturan PPh21 <a data-toggle="modal"
                                        data-target="#Modalpph21" class="font-weight-500 text-primary"> disini
                                    </a></span>
                            </div>
                        </div>


                        <hr class="mt-2">
                        <h6>B. Rincian Penghasilan dan Penghitungan PPh Pasal 21</h6>
                        <hr class="mb-4">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="alamat_pegawai" class="col-sm-5 col-form-label col-form-label-sm">Kode
                                        Objek
                                        Pajak</label>
                                    <div class="col-sm-1 text-center">
                                        <span> : </span>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="row" id="radio1">
                                            <div class="col-md-6">
                                                <input class="mr-1 small" value="21-100-01" type="radio" name="radio2"
                                                    checked><span class="small">21-100-01</span>
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
                                        <input type="input" class="form-control form-control-sm" id="gaji_pokok"
                                            name="gaji_pokok" value="{{ $item->total_pokok ?? '0' }}"
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
                                        <input type="input" class="form-control form-control-sm" id="tunjangan_pph"
                                            name="tunjangan_pph" value="0" placeholder="Tunj PPh">
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
                                        <input type="input" class="form-control form-control-sm" id="tunjangan_lain"
                                            name="tunjangan_lain" value="{{ $item->total_tunjangan ?? '0'}}"
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
                                        <input type="input" class="form-control form-control-sm" id="honorarium"
                                            name="honorarium" value="0" placeholder="Honorarium">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="premi_prsh" class="col-sm-5 col-form-label col-form-label-sm">5. Premi
                                        Asuransi
                                        yang Dibayar Pemberi Kerja</label>
                                    <div class="col-sm-1 text-center">
                                        <span> : </span>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="input" class="form-control form-control-sm" id="premi_prsh"
                                            name="premi_prsh" value="0" placeholder="Premi Asuransi">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="natura" class="col-sm-5 col-form-label col-form-label-sm">6. Penerimaan
                                        dalam Bentuk Natura dan Kenikmatan Lainnya yang Dikenakan Pemotongan PPh Pasal
                                        21</label>
                                    <div class="col-sm-1 text-center">
                                        <span> : </span>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="input" class="form-control form-control-sm" id="natura"
                                            name="natura" value="0" placeholder="Natura">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="bonusthr" class="col-sm-5 col-form-label col-form-label-sm">7. Tantiem,
                                        Bonus,
                                        Gratifikasi, Jasa Produksi dan THR</label>
                                    <div class="col-sm-1 text-center">
                                        <span> : </span>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="input" class="form-control form-control-sm" id="bonusthr"
                                            name="bonusthr" value="0" placeholder="Bonus THR">
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
                                                <button class="btn btn-sm btn-primary"
                                                    onclick="hitungpenghasilanbruto()" type="button">Hitung</button>
                                            </div>
                                            <input type="input" class="form-control form-control-sm" id="bruto"
                                                name="bruto" value="0" placeholder="Jumlah Penghasilan">
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
                                        <input type="input" class="form-control form-control-sm" id="biaya_jabatan"
                                            name="biaya_jabatan" value="0" placeholder="Biaya Jabatan">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="iuran_jht" class="col-sm-5 col-form-label col-form-label-sm">10. Iuran
                                        Pensiun atau Iuran THT/JHT</label>
                                    <div class="col-sm-1 text-center">
                                        <span> : </span>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="input" class="form-control form-control-sm" id="iuran_jht"
                                            name="iuran_jht" value="0" placeholder="Iuran">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="total_pengurangan" class="col-sm-5 col-form-label col-form-label-sm">11.
                                        Jumlah
                                        Pengurangan (9 s.d. 10)</label>
                                    <div class="col-sm-1 text-center">
                                        <span> : </span>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="input-group input-group-joined">
                                            <div class="input-group-prepend">
                                                <button class="btn btn-sm btn-primary" onclick="hitungpengurangan()"
                                                    type="button">Hitung</button>
                                            </div>
                                            <input type="input" class="form-control form-control-sm"
                                                id="total_pengurangan" name="total_pengurangan" value="0"
                                                placeholder="Jumlah Pengurangan">
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
                                        Penghasilan Neto (8-11)</label>
                                    <div class="col-sm-1 text-center">
                                        <span> : </span>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="input-group input-group-joined">
                                            <div class="input-group-prepend">
                                                <button class="btn btn-sm btn-primary" onclick="hitungpenghasilanneto()"
                                                    type="button">Hitung</button>
                                            </div>
                                            <input type="input" class="form-control form-control-sm" id="netto"
                                                name="netto" value="0" placeholder="Jumlah Penghasilan Netto">
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="netto_sebelumnya" class="col-sm-5 col-form-label col-form-label-sm">13.
                                        Penghasilan
                                        Neto Masa Sebelumnya</label>
                                    <div class="col-sm-1 text-center">
                                        <span> : </span>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="input" class="form-control form-control-sm" id="netto_sebelumnya"
                                            name="netto_sebelumnya" value="0" placeholder="Netto Sebelumnya">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="tunjangan_pph" class="col-sm-5 col-form-label col-form-label-sm">14.
                                        Jumlah
                                        Penghasilan Neto untuk Penghitungan PPh Pasal 21 (Setahun/Disetahunkan)</label>
                                    <div class="col-sm-1 text-center">
                                        <span> : </span>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="row" id="radio2">
                                            <div class="col-md-6">
                                                <input class="mr-1 small" value="setahun" type="radio"
                                                    name="jenis_netto" checked><span class="small">Setahun</span>
                                            </div>
                                            <div class="col-md-6">
                                                <input class="mr-1 small" value="disetahunkan" type="radio"
                                                    name="jenis_netto"><span class="small">Disetahunkan</span>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <input type="input" class="form-control form-control-sm" id="netto_pph21"
                                            name="netto_pph21" value="0" placeholder="Jumlah Penghasilan Netto">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="ptkp" class="col-sm-5 col-form-label col-form-label-sm">15. Penghasilan
                                        Tidak Kena Pajak (PTKP)</label>
                                    <div class="col-sm-1 text-center">
                                        <span> : </span>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="input" class="form-control form-control-sm" id="ptkp" name="ptkp"
                                            value="{{ $item->Pegawai->PTKP->besaran_ptkp }}" placeholder="Besaran PTKP">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="pkp" class="col-sm-5 col-form-label col-form-label-sm">16. Penghasilan
                                        Kena Pajak Setahun/Disetahunkan (14-15)</label>
                                    <div class="col-sm-1 text-center">
                                        <span> : </span>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="input-group input-group-joined">
                                            <div class="input-group-prepend">
                                                <button class="btn btn-sm btn-primary"
                                                    onclick="hitungpenghasilankenapajak()" type="button">Hitung</button>
                                            </div>
                                            <input type="input" class="form-control form-control-sm" id="pkp" name="pkp"
                                                value="0" placeholder="Jumlah Penghasilan Kena Pajak">
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
                                                <button class="btn btn-sm btn-primary" onclick="hitungpph21()"
                                                    type="button">Hitung</button>
                                            </div>
                                            <input type="input" class="form-control form-control-sm" id="pph21_pkp"
                                                name="pph21_pkp" value="0" placeholder="PPh Pasal 21 PKP">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="pph21_telah_pot" class="col-sm-5 col-form-label col-form-label-sm">18.
                                        PPh
                                        Pasal 21
                                        Yang Telah Dipotong Masa Sebelumnya</label>
                                    <div class="col-sm-1 text-center">
                                        <span> : </span>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="input" class="form-control form-control-sm" id="pph21_telah_pot"
                                            name="pph21_telah_pot" value="0" placeholder="PPh21 Telah Pot">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="pph21_terutang" class="col-sm-5 col-form-label col-form-label-sm">19.
                                        PPh
                                        Pasal
                                        21 Terutang</label>
                                    <div class="col-sm-1 text-center">
                                        <span> : </span>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="input-group input-group-joined">
                                            <div class="input-group-prepend">
                                                <button class="btn btn-sm btn-primary" onclick="pph21terutang()"
                                                    type="button">Hitung</button>
                                            </div>
                                            <input type="input" class="form-control form-control-sm" id="pph21_terutang"
                                                name="pph21_terutang" value="0" placeholder="PPh Pasal 21 Terutang">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="pph21_lunas" class="col-sm-5 col-form-label col-form-label-sm">20. PPh
                                        Pasal
                                        21
                                        dan PPh Pasal 26 Yang Telah Dipotong dan Dilunasi</label>
                                    <div class="col-sm-1 text-center">
                                        <span> : </span>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="input" class="form-control form-control-sm" id="pph21_lunas"
                                            name="pph21_lunas" value="0" placeholder="PPh21 dan PPh26">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @empty

    @endforelse

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

<script>
    function hitungpenghasilanbruto() {
        var gaji_pokok = $('#gaji_pokok').val()
        var tunjangan_pph = $('#tunjangan_pph').val()
        var tunjangan_lain = $('#tunjangan_lain').val()
        var honorarium = $('#honorarium').val()
        var premi_prsh = $('#premi_prsh').val()
        var natura = $('#natura').val()
        var bonusthr = $('#bonusthr').val()


        var brutofix = parseInt(gaji_pokok) + parseInt(tunjangan_pph) + parseInt(tunjangan_lain) + parseInt(
                honorarium) +
            parseInt(premi_prsh) + parseInt(natura) + parseInt(bonusthr)



        $('#bruto').val(brutofix)


        var biayajabatan = brutofix * 5
        var biayajabatanfix = biayajabatan / 100
        var maxbiayajabatan = 6000000


        if (biayajabatanfix >= maxbiayajabatan) {
            $('#biaya_jabatan').val(maxbiayajabatan)
        } else {
            $('#biaya_jabatan').val(biayajabatanfix)
        }

        alert('Penghasilan Bruto dan Biaya Jabatan Berhasil Dihitung')
    }

    function hitungpengurangan() {
        var biaya_jabatan = $('#biaya_jabatan').val()
        var iuran_jht = $('#iuran_jht').val()
        var bruto = $('#bruto').val()

        if (bruto == 0) {
            alert('Anda Belum Melakukan Perhitungan Gaji Bruto')
        } else {
            var total_pengurangan = parseInt(biaya_jabatan) + parseInt(iuran_jht)
            $('#total_pengurangan').val(total_pengurangan)


            alert('Jumlah Pengurangan Berhasil dihitung')
        }
    }

    function hitungpenghasilanneto() {

        var gaji_bruto = $('#bruto').val()
        var total_pengurangan = $('#total_pengurangan').val()

        if (gaji_bruto == 0 && total_pengurangan == 0) {
            alert('Anda Belum Melakukan Perhitungan Gaji Bruto dan Jumlah Pengurangan')
        } else {
            var neto = parseInt(gaji_bruto) - parseInt(total_pengurangan)
            $('#netto').val(neto)
            $('#netto_pph21').val(neto)
        }
    }

    function hitungpenghasilankenapajak() {
        var netto_pph21 = $('#netto_pph21').val()
        var ptkp = $('#ptkp').val()
        var netto = $('#netto').val()

        if (netto == 0) {
            alert('Anda Belum Melakukan Perhitungan Gaji Netto')
        } else {
            var pkp = parseInt(netto_pph21) - parseInt(ptkp)
            $('#pkp').val(pkp)
        }

    }

    function hitungpph21() {
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

        console.log(pph1, pph2, pph3)

        // Penghasilan Kena Pajak
        var pkpasik = $('#pkp').val()
        var pkp = parseInt(pkpasik)

        if (pkp == 0) {
            alert('Anda Belum Melakukan Perhitungan PKP')
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
                console.log(pphlevel1fix, pphlevel1tahun)

                // $('#pph21_pkp').val(pphlevel1tahun)
                // alert('PPH LEVEL 1')

                if (pphlevel1tahun <= 0) {
                    var pajaknull = 0
                    $('#pph21_pkp').val(pajaknull)
                    alert('BEBAS PAJAK')
                } else {
                    $('#pph21_pkp').val(pphlevel1tahun)
                    alert('PPH LEVEL 1')
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
                console.log(pphkena15sangat, pphkena5sangat)

                // Penambahan
                var pphlevel2 = parseInt(pphkena5sangat + pphkena15sangat)
                console.log(pphlevel2)
                // var pphlevel2hampir = pphlevel2 / 12

                // Memecah Bilangan Decimal
                var str = pphlevel2.toString();
                var numarray = str.split('.');
                var a = new Array();
                a = numarray;

                // FIX PPH Level 2
                var pphlevel2tahun = a[0];

                console.log(pphlevel2tahun)
                $('#pph21_pkp').val(pphlevel2tahun)
                alert('PPH LEVEL 2')

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
                $('#pph21_pkp').val(pphlevel3tahun)
                alert('PPH LEVEL 3')
            }
        }




    }

    function pph21terutang() {
        var pph21_pkp = $('#pph21_pkp').val()
        var pph21_telah_pot = $('#pph21_telah_pot').val()

        if (pph21_pkp == 0) {
            alert('Anda Belum Melakukan Perhitungan PPh21')
        } else {
            var pph21_terutang = parseInt(pph21_pkp) + parseInt(pph21_telah_pot)
            $('#pph21_terutang').val(pph21_terutang)

            var pph_final_bulan = pph21_terutang / 12
            var str = pph_final_bulan.toString();
            var numarray = str.split('.');
            var a = new Array();
            a = numarray;

            pph_final_bulan_fix = a[0];


            $('#pph21_lunas').val(pph_final_bulan_fix)

            alert('Berhasil Melakukan Perhitungan PPh21 Final')
        }



    }

</script>



@endsection
