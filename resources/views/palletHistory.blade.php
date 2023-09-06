@extends('layout.layout')


@section('managepalletbutton', 'active') {{-- ini bagian folder nya --}}
@section('showmanagepallet', 'show') {{-- ini bagian folder nya yang buka tutup --}}
@section('managepallethistory', 'active') {{-- ini bagian button side panel yang di highlight nya --}}


@section('content')
    <div class="main-panel">
        <div class="content">
            <div class="page-inner">
                ini page buat liat sejarah palet
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="add-row" class="display table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th style="width: 30%">Nama Barang</th>
                                                <th>Stok</th>
                                                <th>BIN</th>
                                                <th>Status</th>
                                                <th>Waktu</th>
                                                <th>User</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>Nama Barang</th>
                                                <th>Stok</th>
                                                <th>BIN</th>
                                                <th>Status</th>
                                                <th>Waktu</th>
                                                <th>User</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>

                                            @foreach ($palletHistory as $pallet)
                                                <tr>
                                                    <td>{{ $pallet->item_name }}</td>
                                                    <td>{{ $pallet->stock }}</td>
                                                    <td>{{ $pallet->bin }}</td>
                                                    @if ($pallet->status == 'KELUAR')
                                                        <td style="text-align: center"><strong>
                                                                <p
                                                                    style="margin: auto; color: white; background-color: rgb(189, 66, 55);border-radius: 25px">
                                                                    {{ $pallet->status }}</p>
                                                            </strong>
                                                        </td>
                                                    @elseif ($pallet->status == 'DALAM INVENTORY')
                                                        <td style="text-align: center"><strong>
                                                                <p
                                                                    style="margin: auto; color: white; background-color: rgb(55, 111, 189);border-radius: 25px">
                                                                    {{ $pallet->status }}</p>
                                                            </strong>
                                                        </td>
                                                    @elseif ($pallet->status == 'KELUAR SEBAGIAN')
                                                        <td style="text-align: center"><strong>
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
                                                    <td>{{ $pallet->name }}</td>
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
