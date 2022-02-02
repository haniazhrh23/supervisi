@extends('layouts.sbadmin')
@section('title', 'Halaman Kurikulum')
@section('content')
<div class="container-fluid">
    @if (session('success_message'))
        <div class="alert alert-success">
            {{session('success_message')}}
        </div>
    @endif
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col">
                    <h5 class="m-0 pt-2 font-weight-bold text-primary">List RPP</h5>
                </div>
                <div class="col">
                    <a href="{{route('add-rpp')}}" class=" m-0 font-weight-bold text-white btn btn-primary btn-sm float-right">
                        <i class="fas fa-plus"></i>
                        Add Jadwal
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead class="text-center">
                        <tr>
                            <tr class="text-primary">
                                <th>NO</th>
                                <th>NIP</th>
                                <th>MATA PELAJARAN</th>
                                <th>RPP</th>
                                <th>LINK VIDIO</th>
                                <th>STATUS</th>
                                <th>ACTION</th>
                            </tr>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($document as $item)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$item->nip}}</td>
                            <td>{{$item->mapel}}</td>
                            <td>{{$item->rpp}}</td>
                            <td><a href="">{{$item->embed}}</a></td>
                            <td>{{$item->status}}</td>
                            <td>
                                <form action="#" method="post">
                                    @method('patch')
                                    @csrf
                                    <button type="submit" class="btn btn-warning float-right">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button type="submit" class="btn btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script>
    $(document).ready(function() {
        $('.table').DataTable();
    } );
</script>
@endsection
