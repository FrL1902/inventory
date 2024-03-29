@extends('layout.layout')


@section('managepalletbutton', 'active submenu') {{-- ini bagian folder nya --}}
@section('showmanagepallet', 'show') {{-- ini bagian folder nya yang buka tutup --}}
@section('managepallethistory', 'active') {{-- ini bagian button side panel yang di highlight nya --}}


@section('content')
    <div class="main-panel">
        <div class="content">
            <div class="page-inner">
                <div class="page-header">
                    <h4 class="page-title">History Stok by palet</h4>
                    <ul class="breadcrumbs">
                        <li class="nav-home">
                            <i class="flaticon-home"></i>
                        </li>
                        <li class="separator">
                            <i class="flaticon-right-arrow"></i>
                        </li>
                        <li class="separator">
                            <a>Kelola Palet</a>
                        </li>
                        <li class="separator">
                            <i class="flaticon-right-arrow"></i>
                        </li>
                        <li class="separator">
                            <a>History Stok by palet</a>
                        </li>
                    </ul>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex justify-content-between">
                                    <div class="d-flex flex-row">
                                        <h4 class="card-title mt-1 mr-3">
                                            <span class="align-middle">Sejarah Palet
                                            </span>
                                        </h4>
                                        <div class="ml-3 mr-2 mt-2">
                                            <span class="align-middle">
                                                Export Berdasarkan
                                            </span>
                                        </div>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-secondary"
                                                data-target="#exportPalletItemHistorymModal"
                                                data-toggle="modal"><strong>Barang</strong>
                                            </button>
                                            <button type="button" class="btn btn-secondary"
                                                data-target="#exportPalletHistoryByDateModal"
                                                data-toggle="modal"><strong>Tanggal</strong>
                                            </button>
                                        </div>
                                    </div>
                                    <div>
                                        <button type="button" class="btn btn-secondary"
                                            data-target="#sortByDatePalletModal" data-toggle="modal"><strong>Filter by
                                                Date</strong>
                                        </button>
                                        @if (session('deleteFilterButton'))
                                            <a type="button" class="btn btn-danger" style="cursor: pointer"
                                                href="/managePalletHistory">Remove Filter</a>
                                        @endif

                                    </div>

                                    {{-- export by ITEM --}}
                                    <div class="modal fade" id="exportPalletItemHistorymModal" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h3 class="modal-title" id="exampleModalLongTitle">
                                                        <strong>
                                                            EXPORT SEJARAH PALET BARANG
                                                        </strong>
                                                    </h3>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>

                                                {{-- export by item name --}}
                                                <form method="post" action="/exportPalletItemHistory">
                                                    @csrf
                                                    <div class="modal-body" style="padding:0">
                                                        <div class="card-body">
                                                            <div class="form-group">
                                                                <label for="itemPalletHistoryExport" style="font-weight: bold">Barang</label>
                                                                <select class="form-control" data-width="100%"
                                                                    id="itemPalletHistoryExport"
                                                                    name="itemPalletHistoryExport" required>
                                                                    <option></option>
                                                                    @foreach ($item as $item)
                                                                        <option value="{{ $item->item_id }}">
                                                                            {{ $item->item_name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            {{-- <div class="form-group">
                                                                <div class="card mt-5 ">
                                                                    <button id="" class="btn btn-primary">Export
                                                                        Data</button>
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

                                    {{-- export by ALL --}}
                                    <div class="modal fade" id="exportPalletHistoryByDateModal" tabindex="-1"
                                        role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                                                <form method="post" action="/exportPalletHistoryByDate">
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
                                    <div class="modal fade" id="sortByDatePalletModal" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h3 class="modal-title" id="exampleModalLongTitle">
                                                        <strong>
                                                            FILTER SEJARAH PALET BERDASARKAN TANGGAL
                                                        </strong>
                                                    </h3>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form method="post" action="/filterPalletHistoryDate">
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
                                                <th style="width: 30%">Nama Barang</th>
                                                <th>Tanggal</th>
                                                <th>Stok</th>
                                                <th>BIN</th>
                                                <th>Status</th>
                                                <th>Waktu (system)</th>
                                                <th>User</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>Nama Barang</th>
                                                <th>Tanggal</th>
                                                <th>Stok</th>
                                                <th>BIN</th>
                                                <th>Status</th>
                                                <th>Waktu (system)</th>
                                                <th>User</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>

                                            @foreach ($palletHistory as $pallet)
                                                <tr>
                                                    <td>{{ $pallet->item_name }}</td>
                                                    <td>{{ date_format(date_create($pallet->user_date), 'd-m-Y') }}</td>
                                                    <td>{{ $pallet->stock }}</td>
                                                    <td>{{ $pallet->bin }}</td>
                                                    @if ($pallet->status == 'KELUAR')
                                                        <td style="display: block; min-width:200px; text-align: center;">
                                                            <strong>
                                                                <p
                                                                    style="margin: auto; color: white; background-color: rgb(189, 66, 55);border-radius: 25px">
                                                                    {{ $pallet->status }}</p>
                                                            </strong>
                                                        </td>
                                                    @elseif ($pallet->status == 'DALAM INVENTORY')
                                                        <td style="display: block; text-align: center; min-width:200px;">
                                                            <strong>
                                                                <p
                                                                    style="margin: auto; color: white; background-color: rgb(55, 111, 189);border-radius: 25px">
                                                                    {{ $pallet->status }}</p>
                                                            </strong>
                                                        </td>
                                                    @elseif (str_contains($pallet->status, 'SEBAGIAN'))
                                                        <td style="display: block; text-align: center; min-width:200px;">
                                                            <strong>
                                                                <p
                                                                    style="margin: auto; color: white; background-color:rgb(189, 173, 55);border-radius: 25px">
                                                                    {{ $pallet->status }}</p>
                                                            </strong>
                                                        </td>
                                                        {{-- <td style="text-align: center"><strong>
                                                            <p
                                                                style="margin: auto; color: white; background-color: {{ $pallet->status == 'KELUAR' ? 'rgb(189, 66, 55)' : 'rgb(55, 111, 189)' }};border-radius: 25px">
                                                                {{ $pallet->status }}</p>
                                                        </strong> --}}
                                                    @endif
                                                    <td>{{ $pallet->created_at }}</td>
                                                    <td>{{ $pallet->user }}</td>
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
