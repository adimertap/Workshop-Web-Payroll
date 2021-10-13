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
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">Basic Card Example</div>
            <div class="card-body">
                <h6>Enter your account information</h6>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group row">
                            <label for="tanggal_perampungan" class="col-sm-2 col-form-label col-form-label-sm">Tanggal</label>
                            <div class="col-sm-6">
                                <input type="input" class="form-control form-control-sm" id="tanggal_perampungan"
                                    value="{{ $perampungan->tanggal_perampungan }}" readonly>
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
                                <input type="input" class="form-control form-control-sm" id="nomor"
                                    value="{{ $perampungan->nomor }}" readonly>
                            </div>
                        </div>
                    </div>
                    <div class=" col-sm-6">
                        <div class="form-group row">
                            <label for="nomor" class="col-sm-3 col-form-label col-form-label-sm">Masa Perolehan</label>
                            <div class="col-sm-2">
                                <input type="input" class="form-control form-control-sm" id="nomor"
                                    value="{{ date('m', strtotime($perampungan->masa_perolehan_awal)) }}" readonly>
                            </div>
                            <div class="col-sm-1 text-center">
                                <span> - </span>
                            </div>
                            <div class="col-sm-2">
                                <input type="input" class="form-control form-control-sm" id="nomor"
                                    value="{{ date('m', strtotime($perampungan->masa_perolehan_akhir)) }}" readonly>
                            </div>
                            <label for="nomor" class="col-sm-2 text-center  col-form-label col-form-label-sm">Th.</label>
                            <div class="col-sm-2">
                                <input type="input" class="form-control form-control-sm" id="nomor"
                                    value="{{ date('Y', strtotime($perampungan->masa_perolehan_awal)) }}" readonly>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group row">
                            <label for="id_pemotong" class="col-sm-2 col-form-label col-form-label-sm">Pemotong</label>
                            <div class="col-sm-8">
                                <input type="input" class="form-control form-control-sm" id="id_pemotong"
                                    value="{{ Auth::user()->pegawai->nama_pegawai }}" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group row">
                            <label for="npwp_pemotong" class="col-sm-3 col-form-label col-form-label-sm">NPWP Pemotong</label>
                            <div class="col-sm-6">
                                <input type="input" class="form-control form-control-sm" id="npwp_pemotong"
                                    value="{{ Auth::user()->pegawai->npwp_pegawai }}" readonly>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
</main>




@endsection
