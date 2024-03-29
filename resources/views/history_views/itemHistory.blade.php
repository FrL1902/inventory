@extends('layout.layout')

@section('manageitembutton', 'active submenu')
@section('managehistory', 'active')
@section('showmanageitem', 'show')

@section('content')
    <div class="main-panel">
        <div class="content">
            {{-- ini page buat liat history keluar masuk stock tiap produk / item --}}
            <div class="page-inner">
                <div class="page-header">
                    <h4 class="page-title">History Stok by pcs</h4>
                    <ul class="breadcrumbs">
                        <li class="nav-home">
                            <i class="flaticon-home"></i>
                        </li>
                        <li class="separator">
                            <i class="flaticon-right-arrow"></i>
                        </li>
                        <li class="separator">
                            <a>Kelola Barang</a>
                        </li>
                        <li class="separator">
                            <i class="flaticon-right-arrow"></i>
                        </li>
                        <li class="separator">
                            <a>History Stok by pcs</a>
                        </li>
                    </ul>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex justify-content-between">
                                    <div class="d-flex flex-row">
                                        <span>

                                        </span>
                                        <h4 class="card-title mt-1 mr-3">
                                            <span class="align-middle">Sejarah Barang
                                            </span>
                                        </h4>
                                        <div class="ml-3 mr-2 mt-2">
                                            <span class="align-middle">
                                                Export Berdasarkan
                                            </span>
                                        </div>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-secondary"
                                                data-target="#exportItemHistorymModal"
                                                data-toggle="modal"><strong>Barang</strong>
                                            </button>
                                            <button type="button" class="btn btn-secondary"
                                                data-target="#exportHistoryByDateModal"
                                                data-toggle="modal"><strong>Tanggal</strong>
                                            </button>
                                        </div>
                                    </div>
                                    <div>
                                        <button type="button" class="btn btn-secondary" data-target="#sortByDateModal"
                                            data-toggle="modal"><strong>Filter by Date</strong>
                                        </button>
                                        @if (session('deleteFilterButton'))
                                            <a type="button" class="btn btn-danger" style="cursor: pointer"
                                                href="/manageHistory">Remove Filter</a>
                                        @endif
                                    </div>

                                    {{-- export by ITEM --}}
                                    <div class="modal fade" id="exportItemHistorymModal" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h3 class="modal-title" id="exampleModalLongTitle">
                                                        <strong>
                                                            EXPORT SEJARAH BARANG
                                                        </strong>
                                                    </h3>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>

                                                {{-- export by item name --}}
                                                <form method="post" action="/exportItemHistory">
                                                    @csrf
                                                    <div class="modal-body" style="padding:0">
                                                        <div class="card-body">
                                                            <div class="form-group">
                                                                <label for="itemHistoryExport" style="font-weight: bold">Barang</label>
                                                                <select class="form-control" data-width="100%"
                                                                    id="itemHistoryExport" name="itemHistoryExport"
                                                                    required>
                                                                    <option></option>
                                                                    @foreach ($item as $item)
                                                                        <option value="{{ $item->item_id }}">
                                                                            {{ $item->item_name }}</option>
                                                                    @endforeach
                                                                </select>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-primary mr-2">Export
                                                            Data</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- export by ALL --}}
                                    <div class="modal fade" id="exportHistoryByDateModal" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h3 class="modal-title" id="exampleModalLongTitle">
                                                        <strong>
                                                            EXPORT SEMUA BERDASARKAN TANGGAL
                                                        </strong>
                                                    </h3>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form method="post" action="/exportHistoryByDate">
                                                    @csrf
                                                    <div class="modal-body" style="padding:0">

                                                        <div class="card-body">
                                                            <div class="form-group">
                                                                <label for="startRange" style="font-weight: bold">Dari Tanggal</label>
                                                                <input type="date" class="form-control form-control-sm" style="border-color: #aaaaaa"
                                                                    id="startRange" required name="startRange">
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="endRange" style="font-weight: bold">Hingga Tanggal</label>
                                                                <input type="date" class="form-control form-control-sm" id="endRange" style="border-color: #aaaaaa"
                                                                    required name="endRange">
                                                            </div>

                                                            {{-- <div class="form-group">
                                                                <div class="card mt-5 ">
                                                                    <button id="" class="btn btn-primary">Export
                                                                        Data</button>
                                                                </div>
                                                                <div>
                                                                    <h5 style="text-align: center;">
                                                                        Export Berdasarkan Tanggal</h5>
                                                                </div>
                                                            </div> --}}
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-primary mr-2">Export
                                                            Data</button>
                                                    </div>
                                                </form>
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
                                                            FILTER SEJARAH BERDASARKAN TANGGAL
                                                        </strong>
                                                    </h3>

                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form method="post" action="/filterHistoryDate">
                                                    @csrf
                                                    <div class="modal-body" style="padding:0">
                                                        <div class="card-body">
                                                            <div class="form-group">
                                                                <label for="startRange" style="font-weight: bold">Dari Tanggal</label>
                                                                <input type="date" class="form-control form-control-sm"  style="border-color: #aaaaaa"
                                                                    id="startRange" required name="startRange">
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="endRange" style="font-weight: bold">Hingga Tanggal</label>
                                                                <input type="date" class="form-control form-control-sm" id="endRange"  style="border-color: #aaaaaa"
                                                                    required name="endRange">
                                                            </div>

                                                            {{-- <div class="form-group">
                                                                <div class="card mt-5 ">
                                                                    <button id=""
                                                                        class="btn btn-primary">Filter</button>
                                                                </div>
                                                                <div>
                                                                    <h5 style="text-align: center;">
                                                                        Filter Berdasarkan Tanggal</h5>
                                                                </div>
                                                            </div> --}}
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-primary mr-2">Filter</button>
                                                    </div>
                                                </form>
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
                                                {{-- <th>History ID</th> --}}
                                                <th>ID barang</th>
                                                <th>Nama Barang</th>
                                                <th>Tanggal</th>
                                                <th>Status</th>
                                                <th>Stok</th>
                                                <th>Supplier</th>
                                                <th>Oleh User</th>
                                                <th>Waktu (system)</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                {{--
                                                History ID : IDnya kyknya gini aja deh, TRSN1,  "TRSN" nya kode awal, angka belakangnya increment berdasarkan ID
                                                Item name // jelas kali ya darimana, figure it out
                                                Stock Before // jelas kali ya darimana, figure it out
                                                Stock Added // jelas kali ya darimana, figure it out
                                                Stock Taken // jelas kali ya darimana, figure it out
                                                Stock Now // jelas kali ya darimana, figure it out
                                                Updated At : ini tunjukin created at
                                                By User : ini pake auth --}}

                                                {{-- <th>History ID</th> --}}
                                                <th>ID barang</th>
                                                <th>Nama Barang</th>
                                                <th>Tanggal</th>
                                                <th>Status</th>
                                                <th>Stok</th>
                                                <th>Supplier</th>
                                                <th>Oleh User</th>
                                                <th>Waktu (system)</th>

                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            @foreach ($history as $history)
                                                <tr>
                                                    {{-- <td>{{ $history->id }}</td> --}}
                                                    <td>{{ $history->item_id }}</td>
                                                    <td>{{ $history->item_name }}</td>
                                                    <td>{{ date_format(date_create($history->user_action_date), 'd-m-Y') }}
                                                    </td>
                                                    @if ($history->status == 'BARANG KELUAR')
                                                        <td style="display: block; min-width:200px; text-align: center;">
                                                            <strong>
                                                                <p
                                                                    style="margin: auto; color: white; background-color: rgb(189, 66, 55);border-radius: 25px">
                                                                    {{ $history->status }}</p>
                                                            </strong>
                                                        </td>
                                                    @elseif ($history->status == 'BARANG DATANG')
                                                        <td style="display: block; text-align: center; min-width:200px;">
                                                            <strong>
                                                                <p
                                                                    style="margin: auto; color: white; background-color: rgb(55, 111, 189);border-radius: 25px">
                                                                    {{ $history->status }}</p>
                                                            </strong>
                                                        </td>
                                                    @endif
                                                    <td>{{ $history->value }}</td>
                                                    <td>{{ $history->supplier }}</td>
                                                    <td>{{ $history->user_who_did }}</td>
                                                    <td>{{ $history->created_at }}</td>
                                                    {{-- <td>{{ date_format(date_create($history->created_at), 'D, H:i:s, d-m-Y') }} --}}
                                                    </td>
                                                </tr>
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
