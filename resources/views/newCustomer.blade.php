@extends('layout.layout')

@section('content')

@section('managecustomerbutton', 'active')
@section('newcustomer', 'active')
@section('showmanagecustomer', 'show')

<div class="main-panel">
    <div class="content">
        {{-- ini page buat add new customer --}}

        <div class="page-inner">

            @if (session('sukses_addNewCustomer'))
                <div class="alert alert-success alert-block" id="alertSuccess">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ session('sukses_addNewCustomer') }}</strong>
                </div>
                {{-- @elseif (session('formatError'))
                <div class="alert alert-danger alert-block" id="alertFailed">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>Data Gagal Dimasukkan, {{ session('formatError') }} <span style="color: red"> \ /  : * ? " < > |
                    </span></strong>
                </div> --}}
                gagalEmail_addNewCustomer
            @elseif ($errors->any())
                <div class="alert alert-danger alert-block" id="alertFailed">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>Data Gagal Dimasukkan: {{ $errors->first() }}</strong>
                </div>
            @elseif (session('gagalEmail_addNewCustomer'))
                <div class="alert alert-danger alert-block" id="alertFailed">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>Data Gagal Dimasukkan: Invalid Email</strong>
                </div>
            @endif
            {{-- @if ($errors->any())
                <div class="alert alert-danger alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>Customer input failed, validation not met, check error in the bottom</strong>
                </div>
            @endif --}}



            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <form method="post" action="/makeCustomer">
                            @csrf
                            <div class="card-header">
                                <div class="card-title"><strong>Masukkan Customer Baru</strong><a class="ml-3 mb-2"
                                        style="cursor: pointer">
                                        <i class="fa fa-question-circle text-primary" data-toggle="tooltip"
                                            data-original-title="Jika suatu informasi belum diketahui, tidak perlu diisi (kecuali diharuskan di form). Jika memang tidak ada atau tidak punya informasinya (misal customer tidak punya website), isi dengan strip (-)"></i>
                                    </a></div>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="largeInput">ID Customer<span style="color: red"> (harus diisi)
                                        </span></label>
                                    <input type="text" class="form-control form-control" placeholder="Contoh: CU001"
                                        id="customerid" name="customerid">
                                    {{--  --}}
                                </div>
                                <div class="form-group">
                                    <label for="largeInput">Nama Customer<span style="color: red"> (harus diisi)
                                        </span></label>
                                    <input type="text" class="form-control form-control"
                                        placeholder="masukkan nama lengkap customer" id="customername"
                                        name="customername">
                                    {{--  --}}
                                </div>
                                <div class="form-group">
                                    <label for="largeInput">Alamat Customer<span style="color: red"> (harus diisi)
                                        </span></label>
                                    <input type="text" class="form-control form-control"
                                        placeholder="masukkan alamat customer" id="address" name="address">
                                    {{--  --}}
                                </div>
                                <div class="form-group">
                                    <label for="email">Email Customer</label>
                                    <input type="text" class="form-control" placeholder="masukkan email customer"
                                        id="email" name="email">
                                </div>
                                <div class="form-group">
                                    <label for="largeInput">Nomor Telpon 1 Customer</label>
                                    <input type="text" class="form-control form-control" placeholder="(021)"
                                        id="phone1" name="phone1">
                                </div>
                                <div class="form-group">
                                    <label for="largeInput">Nomor Telpon 2 Customer</label>
                                    <input type="text" class="form-control form-control" placeholder="+62"
                                        id="phone2" name="phone2">
                                </div>
                                <div class="form-group">
                                    <label for="largeInput">Nomor Fax Customer</label>
                                    <input type="text" class="form-control form-control" placeholder="(021)"
                                        id="fax" name="fax">
                                </div>
                                <div class="form-group">
                                    <label for="largeInput">Website Customer</label>
                                    <input type="text" class="form-control form-control"
                                        placeholder="contoh: https://www.user.com" id="website" name="website">
                                </div>
                                <div class="form-group">
                                    <label for="largeInput">Nama PIC (person in charge)</label>
                                    <input type="text" class="form-control form-control"
                                        placeholder="masukkan nama lengkap PIC" id="picname" name="picname">
                                </div>
                                <div class="form-group">
                                    <label for="largeInput">Nomor Telpon PIC</label>
                                    <input type="text" class="form-control form-control"
                                        placeholder="(021) atau +62" id="picnumber" name="picnumber">
                                </div>
                                <div class="form-group">
                                    <label for="largeInput">NPWP (Nomor Pokok Wajib Pajak)</label>
                                    <input type="text" class="form-control form-control"
                                        placeholder="Contoh: 08.111.555.1-123.321" id="npwp" name="npwp">
                                </div>
                                <div class="form-group">
                                    <div class="card mt-4">
                                        <button class="btn btn-success"><strong>Tambahkan Customer
                                                Baru</strong></button>
                                    </div>
                                </div>

                                {{-- @if ($errors->any())
                                    @foreach ($errors->all() as $err)
                                        <li class="text-danger">{{ $err }}</li>
                                    @endforeach
                                @endif --}}
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
