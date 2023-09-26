@extends('layout.layout')


@section('manageitembutton', 'active') {{-- ini bagian folder nya --}}
@section('showmanageitem', 'show') {{-- ini bagian folder nya yang buka tutup --}}
@section('itemreport', 'active') {{-- ini bagian button side panel yang di highlight nya --}}

@section('content')
    <div class="main-panel">
        <div class="content">
            <div class="page-inner">
                {{-- Disini customer bisa melihat posisi palet untuk setiap barang secara langsung --}}
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex justify-content-between">
                                    <div class="d-flex flex-row">
                                        <h4 class="card-title mt-1 mr-3">
                                            <span class="align-middle">
                                                <strong>
                                                    Laporan Barang
                                                </strong>
                                            </span>
                                        </h4>
                                        <div class="dropdown">
                                            <button class="btn btn-secondary dropdown-toggle" type="button"
                                                id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false"> <i class="fa fa-file-excel" aria-hidden="true"></i>
                                                Export Berdasarkan
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <a class="dropdown-item" data-target="#exportItemReportCustomerModal"
                                                    data-toggle="modal">Customer</a>
                                                <a class="dropdown-item" data-target="#exportItemReportBrandModal"
                                                    data-toggle="modal">Brand</a>
                                                <a class="dropdown-item" data-target="#exportItemReportItemModal"
                                                    data-toggle="modal">Barang</a>
                                                <a class="dropdown-item" data-target="#exportItemReportALLModal"
                                                    data-toggle="modal">Tanggal</a>
                                            </div>
                                        </div>

                                        {{-- export by CUSTOMER --}}
                                        <div class="modal fade" id="exportItemReportCustomerModal" tabindex="-1"
                                            role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h3 class="modal-title" id="exampleModalLongTitle">
                                                            <strong>
                                                                Export Laporan Berdasarkan Customer
                                                            </strong>
                                                        </h3>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>

                                                    {{-- export by customer name --}}
                                                    <div class="modal-body">
                                                        <form method="post" action="/exportItemReportCustomer">
                                                            @csrf
                                                            <div class="card-body">
                                                                <div class="form-group">
                                                                    <select class="form-control" data-width="100%"
                                                                        id="customerIdItemReport"
                                                                        name="customerIdItemReport" required>
                                                                        <option></option>
                                                                        @foreach ($customer as $data)
                                                                            <option value="{{ $data->customer_id }}">
                                                                                {{ $data->customer_name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="card mt-5 ">
                                                                        <button id=""
                                                                            class="btn btn-primary">Export
                                                                            Data</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- export by BRAND --}}
                                        <div class="modal fade" id="exportItemReportBrandModal" tabindex="-1"
                                            role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h3 class="modal-title" id="exampleModalLongTitle">
                                                            <strong>
                                                                Export Laporan Berdasarkan Brand
                                                            </strong>
                                                        </h3>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>

                                                    {{-- export by brand name --}}
                                                    <div class="modal-body">
                                                        <form method="post" action="/exportItemReportBrand">
                                                            @csrf
                                                            <div class="card-body">
                                                                <div class="form-group">
                                                                    <select class="form-control" data-width="100%"
                                                                        id="brandIdItemReport" name="brandIdItemReport"
                                                                        required>
                                                                        <option></option>
                                                                        @foreach ($brand as $data)
                                                                            <option value="{{ $data->brand_id }}">
                                                                                {{ $data->brand_name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="card mt-5 ">
                                                                        <button id=""
                                                                            class="btn btn-primary">Export
                                                                            Data</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- export by ITEM --}}
                                        <div class="modal fade" id="exportItemReportItemModal" tabindex="-1" role="dialog"
                                            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h3 class="modal-title" id="exampleModalLongTitle">
                                                            <strong>
                                                                Export Laporan Berdasarkan Barang
                                                            </strong>
                                                        </h3>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>

                                                    {{-- export by item name --}}
                                                    <div class="modal-body">
                                                        <form method="post" action="/exportItemReportItem">
                                                            @csrf
                                                            <div class="card-body">
                                                                <div class="form-group">
                                                                    <select class="form-control" data-width="100%"
                                                                        id="itemIdItemReport" name="itemIdItemReport"
                                                                        required>
                                                                        <option></option>
                                                                        @foreach ($item as $data)
                                                                            <option value="{{ $data->item_id }}">
                                                                                {{ $data->item_name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="card mt-5 ">
                                                                        <button id=""
                                                                            class="btn btn-primary">Export
                                                                            Data</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- export by ALL DATA BY DATE  --}}
                                        <div class="modal fade" id="exportItemReportALLModal" tabindex="-1"
                                            role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h3 class="modal-title" id="exampleModalLongTitle">
                                                            <strong>
                                                                Export Laporan Berdasarkan "Tanggal Sampai"
                                                            </strong>
                                                        </h3>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="post" action="/exportItemReportDate">
                                                            @csrf

                                                            <div class="card-body">
                                                                <div class="form-group">
                                                                    <label for="startRange">Start Date Range</label>
                                                                    <input type="date" class="form-control"
                                                                        id="startRange" required name="startRange">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="endRange">End Date Range</label>
                                                                    <input type="date" class="form-control"
                                                                        id="endRange" required name="endRange">
                                                                </div>

                                                                <div class="form-group">
                                                                    <div class="card mt-5 ">
                                                                        <button id=""
                                                                            class="btn btn-primary">Export
                                                                            Data</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- filter by date --}}
                                        <div class="modal fade" id="sortByDateModal" tabindex="-1" role="dialog"
                                            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h3 class="modal-title" id="exampleModalLongTitle">
                                                            <strong>
                                                                Filter by date range
                                                            </strong>
                                                        </h3>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="post" action="/filterHistoryDate">
                                                            @csrf

                                                            <div class="card-body">
                                                                <div class="form-group">
                                                                    <label for="startRange">Start Date Range</label>
                                                                    <input type="date" class="form-control"
                                                                        id="startRange" required name="startRange">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="endRange">End Date Range</label>
                                                                    <input type="date" class="form-control"
                                                                        id="endRange" required name="endRange">
                                                                </div>

                                                                <div class="form-group">
                                                                    <div class="card mt-5 ">
                                                                        <button id=""
                                                                            class="btn btn-primary">Sort</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="add-row" class="display table table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Customer</th>
                                                    <th>Brand</th>
                                                    <th>ID Barang</th>
                                                    <th>Nama Barang</th>
                                                    <th>Stok</th>
                                                    <th>Tanggal Sampai</th>
                                                    <th>Supplier</th>
                                                    <th>Deskripsi</th>
                                                    <th style="width: 13%">Gambar</th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <th>Customer</th>
                                                    <th>Brand</th>
                                                    <th>ID Barang</th>
                                                    <th>Nama Barang</th>
                                                    <th>Stok</th>
                                                    <th>Tanggal Sampai</th>
                                                    <th>Supplier</th>
                                                    <th>Deskripsi</th>
                                                    <th>Gambar</th>
                                                </tr>
                                            </tfoot>
                                            <tbody>
                                                @foreach ($incoming as $data)
                                                    <tr>
                                                        <td>{{ $data->customer->customer_name }}</td>
                                                        <td>{{ $data->brand->brand_name }}</td>
                                                        <td>{{ $data->item->item_id }}</td>
                                                        <td>{{ $data->item->item_name }}</td>
                                                        <td>{{ $data->stock_added }}</td>
                                                        <td>{{ date_format(date_create($data->arrive_date), 'D d-m-Y') }}
                                                        </td>
                                                        <td>{{ $data->supplier }}</td>
                                                        <td>{{ $data->description }}</td>
                                                        <td>
                                                            <a style="cursor: pointer"
                                                                data-target="#imageModalCenter{{ $data->id }}"
                                                                data-toggle="modal">
                                                                <img class="rounded mx-auto d-block"
                                                                    style="width: 100px; height: auto;"
                                                                    src="{{ Storage::url($data->item_pictures) }}"
                                                                    alt="no picture" loading="lazy">
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    <div class="modal fade" id="imageModalCenter{{ $data->id }}"
                                                        tabindex="-1" role="dialog"
                                                        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered modal-lg"
                                                            role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h3 class="modal-title" id="exampleModalLongTitle">
                                                                        <strong>Gambar barang "
                                                                            {{ $data->item->item_name }}"</strong>
                                                                    </h3>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <img class="rounded mx-auto d-block"
                                                                        style="width: 750px; height: auto;"
                                                                        src="{{ Storage::url($data->item_pictures) }}"
                                                                        alt="no picture" loading="lazy">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection