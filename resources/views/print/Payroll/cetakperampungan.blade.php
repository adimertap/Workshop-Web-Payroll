<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Cetak Form 1721 A1 Tahun {{ date('Y', strtotime($perampungan->masa_perolehan_awal)) }}</title>
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

<body>

    <main>

        @forelse ($perampungan->Detail as $item)
        <div class="container-fluid mt-2">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group row">
                                <label for="tanggal_perampungan"
                                    class="col-sm-2 col-form-label col-form-label-sm">Tanggal</label>
                                <div class="col-sm-6">
                                    <span class="small">{{ $perampungan->tanggal_perampungan }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-5">
                            <div class="form-group row">
                                <label for="nomor" class="col-sm-3 col-form-label col-form-label-sm">Masa
                                    Perolehan</label>
                                <div class="col-sm-2">
                                    <span class="small">{{ date('m', strtotime($perampungan->masa_perolehan_awal)) }}</span>
                                </div>
                                <div class="col-sm-1 text-center">
                                    <span> - </span>
                                </div>
                                <div class="col-sm-2">
                                    <span class="small">{{ date('m', strtotime($perampungan->masa_perolehan_akhir)) }}</span>
                                </div>
                                <label for="nomor"
                                    class="col-sm-2 text-center  col-form-label col-form-label-sm">Tahun</label>
                                <div class="col-sm-2">
                                    <span
                                        class="small">{{ date('Y', strtotime($perampungan->masa_perolehan_awal)) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                   

                
                    <h6>A. Identitas Penerima Penghasil yang Dipotong</h6>
            
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group row">
                                <label for="npwp_terpotong" class="col-sm-4 col-form-label col-form-label-sm">1.
                                    NPWP</label>
                                <div class="col-sm-1 text-center">
                                    <span> : </span>
                                </div>
                                <div class="col-sm-6">
                                    <span class="small">{{ $item->npwp_pegawai }}</span>
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
                                    <span class="small">{{ $item->PTKP->nama_ptkp }},
                                        {{ $item->PTKP->keterangan_ptkp }}</span>
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
                                    <span class="small">{{ $item->nik_pegawai }}</span>
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
                                    <span class="small">{{ $item->Jabatan->nama_jabatan }}</span>
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
                                    <span class="small">{{ $item->nama_pegawai }}</span>
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
                                    <span class="small">{{ $item->pivot->karyawan_asing }}</span>
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
                                    <span class="small">{{ $item->jenis_kelamin }}</span>
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
                                    <span class="small">{{ $item->pivot->kode_negara }}</span>
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
                                    <span class="small">{{ $item->alamat }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">

                        </div>
                    </div>


        
                    <h6>B. Rincian Penghasilan dan Penghitungan PPh Pasal 21</h6>
        
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
                                    <span class="small">{{ $item->pivot->kode_objek_pajak }}</span>
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
                                    <span class="small">Rp. {{ number_format($item->pivot->gaji_pokok) }}</span>
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
                                    <span class="small">Rp. {{ number_format($item->pivot->tunjangan_pph) }}</span>
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
                                    <span class="small">Rp. {{ number_format($item->pivot->tunjangan_lain) }}</span>
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
                                    <span class="small">Rp. {{ number_format($item->pivot->honorarium) }}</span>
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
                                    <span class="small">Rp. {{ number_format($item->pivot->premi_prsh) }}</span>
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
                                    <span class="small">Rp. {{ number_format($item->pivot->natura) }}</span>
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
                                    <span class="small">Rp. {{ number_format($item->pivot->bonusthr) }}</span>
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
                                    <span class="small">Rp. {{ number_format($item->pivot->bruto) }}</span>
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
                                    <span class="small">Rp. {{ number_format($item->pivot->biaya_jabatan) }}</span>
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
                                    <span class="small">Rp. {{ number_format($item->pivot->iuran_jht) }}</span>
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
                                    <span class="small">Rp.
                                        {{ number_format($item->pivot->total_pengurangan) }}</span>
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
                                    <span class="small">Rp. {{ number_format($item->pivot->netto) }}</span>
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
                                    <span class="small">Rp.
                                        {{ number_format($item->pivot->netto_sebelumnya) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group row">
                                <label for="tunjangan_pph" class="col-sm-5 col-form-label col-form-label-sm">14.
                                    Jumlah
                                    Penghasilan Neto untuk Penghitungan PPh Pasal 21
                                    ({{ $item->pivot->jenis_netto }})</label>
                                <div class="col-sm-1 text-center">
                                    <span> : </span>
                                </div>
                                <div class="col-sm-6">
                                    <span class="small">Rp. {{ number_format($item->pivot->netto_pph21) }}</span>
                                </div>

                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group row">
                                <div class="col-sm-6">

                                </div>
                            </div>
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
                                    <span class="small">Rp. {{ number_format($item->PTKP->besaran_ptkp) }}</span>
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
                                    <span class="small">Rp. {{ number_format($item->pivot->pkp) }}</span>
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
                                    <span class="small">Rp. {{ number_format($item->pivot->pph21_pkp) }}</span>
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
                                    <span class="small">Rp.
                                        {{ number_format($item->pivot->pph21_telah_pot) }}</span>
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
                                    <span class="small">Rp. {{ number_format($item->pivot->pph21_terutang) }}</span>
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
                                    <span class="small">Rp. {{ number_format($item->pivot->pph21_lunas) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>


             
                    <h6>C. Identitas Pemotong</h6>
                
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group row">
                                <label for="npwp_terpotong" class="col-sm-4 col-form-label col-form-label-sm">1.
                                    NPWP</label>
                                <div class="col-sm-1 text-center">
                                    <span> : </span>
                                </div>
                                <div class="col-sm-6">
                                    <span class="small">{{ $perampungan->npwp_pemotong }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group row">
                                <label for="id_ptkp" class="col-sm-4 col-form-label col-form-label-sm">6.
                                   Tanggal</label>
                                <div class="col-sm-1 text-center">
                                    <span> : </span>
                                </div>
                                <div class="col-sm-6">
                                    <span class="small">{{ $perampungan->tanggal_perampungan }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group row">
                                <label for="nik_terpotong" class="col-sm-4 col-form-label col-form-label-sm">2.
                                    Nama Pemotong</label>
                                <div class="col-sm-1 text-center">
                                    <span> : </span>
                                </div>
                                <div class="col-sm-6">
                                    <span class="small">{{ $perampungan->nama_pemotong }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                          
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @empty

        @endforelse
    </main>

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
