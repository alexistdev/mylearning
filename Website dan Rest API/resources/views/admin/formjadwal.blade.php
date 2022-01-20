@if($template == 'adminlte')
<x-adminlte.dashboard-layout :title="$judul" :tagSubMenu="$tagSubMenu" :total-notif="null">
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Jadwal Mata Pelajaran</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item active"><a href="{{route('admin.jadwal')}}">jadwal</a></li>
                            <li class="breadcrumb-item active">{{($tag != 'edit')?"tambah":"edit"}} </li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-8">

                    <!-- Default box -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">FORM INPUT {{($tag != 'edit')?"TAMBAH":"EDIT"}} JADWAL</h3>
                            @if ($message = Session::get('success'))
                                <div class="alert alert-success alert-block">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @endif
                        </div>
                        <div class="card-body">
                            @if($tag != 'edit')
                                <form action="{{route('admin.savejadwal')}}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label for="mapel_id">Nama Mata Pelajaran</label>
                                        <select name="mapel_id" class="form-control @error('mapel_id') is-invalid @enderror" id="mapel_id">
                                            <option value="">Pilih</option>
                                            @foreach($datamapel as $row)
                                                <option value="{{$row->id}}" {{($row->id != old('mapel_id'))?"":"SELECTED"}}>{{$row->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('mapel_id')
                                        <div class="text-danger text-sm">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="name">KETERANGAN WAKTU</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                               id="name" name="name" value="{{old('name')}}">
                                        @error('name')
                                        <div class="text-danger text-sm">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                            @else
                                <form action="{{route('admin.updatejadwal')}}" method="post">
                                    @csrf
                                    @method('patch')
                                    <input type="hidden" name="id" value="{{$id}}">
                                    <div class="form-group">
                                        <label for="mapel_id">Nama Mata Pelajaran</label>
                                        <select name="mapel_id" class="form-control @error('mapel_id') is-invalid @enderror" id="mapel_id">
                                            <option value="">Pilih</option>
                                            @foreach($datamapel as $row)
                                                <option value="{{$row->id}}" {{($row->id != $datajadwal->mapel_id)?"":"SELECTED"}}>{{$row->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('mapel_id')
                                        <div class="text-danger text-sm">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="name">KETERANGAN WAKTU</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                               id="name" name="name" value="{{$datajadwal->name}}">
                                        @error('name')
                                        <div class="text-danger text-sm">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                            @endif
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <a href="{{route('admin.jadwal')}}">
                                <button class="btn btn-danger btn-sm float-right">KEMBALI</button>
                            </a>
                        </div>
                        <!-- /.card-footer-->
                    </div>
                    <!-- /.card -->
                </div>
            </div>


        </section>
        <!-- /.content -->



    </div>
    <!-- START: Script -->
    <x-adminlte.script-layout />
    <!-- END: Script -->
</x-adminlte.dashboard-layout>
@endif
