@if($template == 'adminlte')
<x-adminlte.dashboard-layout :title="$judul" :tagSubMenu="$tagSubMenu" :total-notif="null">
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Guru</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item active"><a href="{{route('admin.guru')}}">guru</a></li>
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
                            <h3 class="card-title">FORM {{($tag != 'edit')?"TAMBAH":"EDIT"}} GURU</h3>
                            @if ($message = Session::get('success'))
                                <div class="alert alert-success alert-block">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @endif
                        </div>
                        <div class="card-body">
                            @if($tag != 'edit')
                                <form action="{{route('admin.saveguru')}}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label for="user_id">Nama User</label>
                                        <select name="user_id" class="form-control @error('user_id') is-invalid @enderror" id="user_id">
                                            <option value="">Pilih</option>
                                            @foreach($datauser as $row)
                                                <option value="{{$row->id}}" {{($row->id != old('user_id'))?"":"SELECTED"}}>{{$row->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('user_id')
                                        <div class="text-danger text-sm">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!-- Start: NIP -->
                                    <div class="form-group">
                                        <label for="nip">NIP</label>
                                        <input type="text" class="form-control @error('nip') is-invalid @enderror"
                                               id="nip" name="nip" value="{{old('nip')}}">
                                        @error('nip')
                                        <div class="text-danger text-sm">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!-- END: NIP -->

                                    <!-- START: PHONE -->
                                    <div class="form-group">
                                        <label for="phone">PHONE</label>
                                        <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                               id="phone" name="phone" value="{{old('phone')}}">
                                        @error('phone')
                                        <div class="text-danger text-sm">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!-- END: PHONE -->

                                    <!-- START: ALAMAT -->
                                    <div class="form-group">
                                        <label for="alamat">ALAMAT</label>
                                        <input type="text" class="form-control @error('alamat') is-invalid @enderror"
                                               id="alamat" name="alamat" value="{{old('alamat')}}">
                                        @error('alamat')
                                        <div class="text-danger text-sm">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!-- END: ALAMAT -->
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                            @else
                                <form action="{{route('admin.updatemapel')}}" method="post">
                                    @csrf
                                    @method('patch')
                                    <div class="form-group">
                                        <label for="kelas_id">Nama Kelas</label>
                                        <select name="kelas_id" class="form-control  @error('kelas_id') is-invalid @enderror" id="kelas_id">
                                            <option value="">Pilih</option>
                                            @foreach($datakelas as $row)
                                                <option value="{{$row->id}}" {{($row->id != $mapel->kelas_id)?"":"SELECTED"}}>{{$row->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('kelas_id')
                                        <div class="text-danger text-sm">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Nama Kelas</label>
                                        <input type="hidden" name="id" value="{{$id}}">
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                               id="name" name="name" value="{{$mapel->name}}">
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
                            <a href="{{route('admin.guru')}}">
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
