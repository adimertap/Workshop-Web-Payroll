<!DOCTYPE html>
<html lang="en">

<head>
    
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Cetak Slip Gaji {{ date('M', strtotime($gaji->bulan_gaji)) }}, {{ date('Y', strtotime($gaji->bulan_gaji)) }}</title>
    <link href="{{ url('backend/dist/css/styles.css')}}" rel="stylesheet" />
    <link rel="shortcut icon" href="{{ asset('image/favicon.png') }}">
    <link rel="stylesheet" href="{{ url('/node_modules/sweetalert2/dist/sweetalert2.min.css') }}">
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet"
        crossorigin="anonymous" />
    <link rel="icon" type="image/x-icon" href={{ url('favicon.png')}} />

    <script data-search-pseudo-elements defer
        src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.27.0/feather.min.js" crossorigin="anonymous">
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="{{ url('/node_modules/sweetalert2/dist/sweetalert2.all.min.js') }}"></script>
</head>

<body >
    <div>
        <main>
            @forelse ($gaji->Detailpegawai as $item)
            <div class="container col-lg-6 mt-5">
                <div class="card invoice">
                    <div class="card-header border-bottom-0 bg-gradient-light-to-secondary text-white-50">
                        <div class="row justify-content-between align-items-center mt-2 ">
                            <div class="col-2 text-center text-lg-left">
                                <img class="invoice-brand-img rounded-circle" src="{{ asset('logo.png') }}" alt="" />
                            </div>
                            <div class="col-5 text-center text-lg-left">
                                <div class="h2 text-primary">{{ Auth::user()->bengkel->nama_bengkel }}</div>
                                <span class="text-dark">{{ Auth::user()->bengkel->alamat_bengkel }}</span>
                            </div>
                            <div class="col-5 text-right">
                                <div class="h3 text-primary">Slip Gaji</div>
                                <span class="text-dark">Pembayaran Gaji Pegawai</span>
                                <br>
                                <span class="text-dark">{{ $now }}</span>
                                {{-- <span class="text-dark">Tahun {{ $gaji->tahun_gaji }}, Bulan {{ $gaji->bulan_gaji }}</span> --}}
                            </div>
                        </div>
                    </div>
                    <hr class="mr-5 ml-5">
                    <div class="card-body">
                        <h5 class="text-center">Slip Gaji Pegawai</h5>
                        <h6 class="text-dark text-center">Periode Bulan {{ date('M', strtotime($gaji->bulan_gaji)) }}, Tahun {{ date('Y', strtotime($gaji->bulan_gaji)) }}</h6>

                        <div class="row justify-content-between align-items-center mb-4 mt-4 ml-4">
                            <div class="col-6 text-lg-left" style="line-height: 1rem">
                                <label class="font-weight-500">Pegawai: </label>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="d-flex flex-column font-weight-bold">
                                            <label class="small"> NIK </label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <label class="small">: {{ $item->nik_pegawai }} </label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="d-flex flex-column font-weight-bold">
                                            <label class="small"> Nama </label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <label class="small">: {{ $item->nama_pegawai }} </label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="d-flex flex-column font-weight-bold">
                                            <label class="small">Jabatan </label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <label class="small">: {{ $item->Jabatan->nama_jabatan }} </label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="d-flex flex-column font-weight-bold">
                                            <label class="small line-height-normal">Nomor Telp.</label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <label class="small">: {{ $item->no_telp }} </label>
                                    </div>
                                </div>
                            </div>

                            
                            <div class="col-6 text-lg-left" style="line-height: 1rem">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="font-weight-bold">
                                            <label class="small">NPWP </label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <label class="small">: {{ $item->npwp_pegawai }} </label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="font-weight-bold">
                                            <label class="small ">Status PTKP </label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <label class="small">: {{ $item->PTKP->nama_ptkp }} </label>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                      

                        <div class="row mt-4 ml-4">
                            <div class="col-6 text-lg-left">
                                <label class="font-weight-500">Penghasilan: </label>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="d-flex flex-column font-weight-bold">
                                            <label class="small"> Gaji Pokok </label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <label class="small">= Rp. {{ number_format($item->Jabatan->Gajipokok->besaran_gaji,2,',','.') }}</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="d-flex flex-column font-weight-bold">
                                            <label class="small"> Total Tunjangan</label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <label class="small">= Rp. {{ number_format($item->pivot->total_tunjangan,2,',','.') }}</label>
                                    </div>
                                </div>


                               

                                <hr class="mr-5">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="d-flex flex-column font-weight-bold">
                                            <label class="small font-weight-500">Total (A) </label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <label class="small font-weight-500">=  Rp. {{ number_format($item->Jabatan->Gajipokok->besaran_gaji + $item->pivot->total_tunjangan,2,',','.') }}</label>
                                    </div>
                                </div>
                            </div>

                            
                            <div class="col-6 text-lg-left">
                                <label class="font-weight-500">Potongan: </label>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="font-weight-bold">
                                            <label class="small">PPh21 </label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <label class="small">= Rp. {{ number_format($item->pivot->total_pph21,2,',','.') }}</label>
                                    </div>
                                </div>
                                <hr class="mr-5">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="d-flex flex-column font-weight-bold">
                                            <label class="small font-weight-500">Total (B) </label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <label class="small font-weight-500">= Rp. {{ number_format($item->pivot->total_pph21,2,',','.') }}</label>
                                    </div>
                                </div>
                               
                                
                            </div>
                        </div>
                        <hr class="mr-5 ml-5">
                        <div class="row">
                            <div class="col-6">
                                <h6 class="font-weight-500 text-center">Penerimaan Bersih (A-B) :</h6>
                            </div>
                            <div class="col-6">
                                <h6 class="font-weight-500 text-center">Rp. {{ number_format($item->pivot->total_gaji,2,',','.') }}</h6>

                            </div>
                        </div>
                        <hr class="mr-5 ml-5">
                        
                      

                    </div>
                    <div class="card-footer p-4 p-lg-5 border-top-0 bg-white mr-5">
                        <div class="row">
                            <div class="mx-auto col-9 text-center d-flex justify-content-between">
                                <div class="mb-4">
                                </div>
                                <div class="mb-4">
                                    <div class="small">{{ $now }}</div>
                                    <div class="h6 mb-0">Pemilik Bengkel</div>
                                    <div class="h6 mt-10 font-weight-500">{{ Auth::user()->Pegawai->nama_pegawai }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @empty
                
            @endforelse
           


                </div>
            </div>
        </main>
    </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="{{ url('/backend/dist/js/scripts.js')}}"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="{{ url('/backend/dist/assets/demo/datatables-demo.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="{{ url('/backend/dist/assets/demo/datatables-demo.js') }}"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>

</body>

</html>

<script type="text/javascript">
    window.print();
    

</script>
