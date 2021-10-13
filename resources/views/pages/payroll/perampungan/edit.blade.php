@extends('layouts.Admin.adminpayroll')

@section('content')

<main>
    <div class="container-fluid">
        <div class="card">
            <div class="card-header border-bottom">
                <div class="nav nav-pills nav-justified flex-column flex-xl-row nav-wizard" id="cardTab" role="tablist">
                    <a class="nav-item nav-link active" id="wizard1-tab" href="#wizard1" data-toggle="tab" role="tab"
                        aria-controls="wizard1" aria-selected="true">
                        <div class="wizard-step-icon">1</div>
                        <div class="wizard-step-text">
                            <div class="wizard-step-text-name">Identitas</div>
                            <div class="wizard-step-text-details">Penerima Penghasil yang dipotong</div>
                        </div>
                    </a>
                    <a class="nav-item nav-link" id="wizard2-tab" href="#wizard2" data-toggle="tab" role="tab"
                        aria-controls="wizard2" aria-selected="false">
                        <div class="wizard-step-icon">2</div>
                        <div class="wizard-step-text">
                            <div class="wizard-step-text-name">Rincian</div>
                            <div class="wizard-step-text-details">Penghasilan dan Penghitungan PPh Pasal 21</div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="tab-content" id="cardTabContent">
                    <div class="tab-pane py-5 py-xl-10 fade active show" id="wizard1" role="tabpanel"
                        aria-labelledby="wizard1-tab">
                        <div class="row justify-content-center">
                            <div class="col">
                                <h3 class="text-primary">Step 1</h3>
                                <h5 class="card-title">Enter your account information</h5>
                                <form>
                                    
                                    <hr class="my-4">
                                    <div class="d-flex justify-content-between">
                                        <button class="btn btn-light disabled" type="button"
                                            disabled="">Previous</button>
                                        <button class="btn btn-primary" type="button">Next</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane py-5 py-xl-10 fade" id="wizard2" role="tabpanel" aria-labelledby="wizard2-tab">
                        <div class="row justify-content-center">
                            <div class="col">
                                <h3 class="text-primary">Step 2</h3>
                                <h5 class="card-title">Enter your billing details</h5>
                                <form>
                                   
                                    <hr class="my-4">
                                    <div class="d-flex justify-content-between">
                                        <button class="btn btn-light" type="button">Previous</button>
                                        <button class="btn btn-primary" type="button">Next</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>




@endsection
