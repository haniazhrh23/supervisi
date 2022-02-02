@extends('layouts.sbadmin')
@section('title', 'Halaman Kurikulum')
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="row">
            <div class="col">
                <h5 class="m-0 pt-2 font-weight-bold text-primary"> Add RPP</h5>
            </div>
            <div class="col">
                <a href="{{route('jadwal')}}" class="btn btn-danger btn-sm float-right">
                    <i class="fas fa-angle-left"></i>
                    Back
                </a>
            </div>
        </div>
    </div>
    <form action="{{route('post-rpp')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
                @csrf
                <div class="form-group row">
                    <label for="mapel" class="col-sm-2 col-form-label">Mata Pelajaran</label>
                    <div class="col-sm-10">
                        <input type="text" name="mapel" class="form-control @error('mapel') is-invalid @enderror" value="{{old('mapel')}}" id="mapel" placeholder="Mata Pelajaran">
                        @error('mapel')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="rpp" class="col-sm-2 col-form-label">RPP</label>
                    <div class="col-sm-10">
                        <input type="file" name="rpp" class="form-control @error('rpp') is-invalid @enderror" value="{{old('rpp')}}" id="rpp" placeholder="RPP">
                        @error('rpp')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="embed" class="col-sm-2 col-form-label">Embed</label>
                    <div class="col-sm-10">
                        <input type="url" name="embed" class="form-control @error('embed') is-invalid @enderror" value="{{old('embed')}}" id="" placeholder="Link Vidio ">
                        @error('embed')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
        </div>
        <button type="submit" class="btn btn-primary btn-sm float-right">
            <i class="fas fa-check"></i>
            Sumbit
        </button>
    </form>
</div>
@endsection
