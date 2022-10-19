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
                                <form action="{{route('admin.guru.save')}}" method="post">
                                    @csrf
                                    <!-- Start: NAMA -->
                                    <div class="form-group">
                                        <label for="nama">NAMA USER</label>
                                        <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                               id="nama" name="nama" value="{{old('nama')}}">
                                        @error('nama')
                                        <div class="text-danger text-sm">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!-- End: NAMA -->

                                    <!-- Start: EMAIL -->
                                    <div class="form-group">
                                        <label for="email">EMAIL</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                                               id="email" name="email" value="{{old('email')}}">
                                        @error('email')
                                        <div class="text-danger text-sm">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!-- End: EMAIL -->

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
                                <form action="{{route('admin.guru.save')}}" method="post">
                                    @csrf
                                    @method('patch')

                                    <div class="form-group">
                                        <input type="text" name="user_id" value="{{$datauser->id}}">
                                    </div>
                                    <!-- Start: NAMA -->
                                    <div class="form-group">
                                        <label for="nama">NAMA USER </label>
                                        <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                               id="nama" name="nama" value="{{old('nama',$datauser->name)}}">
                                        @error('nama')
                                        <div class="text-danger text-sm">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!-- End: NAMA -->

                                    <!-- Start: EMAIL -->
                                    <div class="form-group">
                                        <label for="email">EMAIL </label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                                               id="email" name="email" value="{{old('email',$datauser->email)}}">
                                        @error('email')
                                        <div class="text-danger text-sm">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!-- End: EMAIL -->

                                    <!-- Start: NIP -->
                                    <div class="form-group">
                                        <label for="nip">NIP</label>
                                        <input type="text" class="form-control @error('nip') is-invalid @enderror"
                                               id="nip" name="nip" value="{{old('nip',$datauser->guru->nip)}}">
                                        @error('nip')
                                        <div class="text-danger text-sm">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!-- END: NIP -->

                                    <!-- START: PHONE -->
                                    <div class="form-group">
                                        <label for="phone">PHONE</label>
                                        <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                               id="phone" name="phone" value="{{old('phone',$datauser->guru->phone)}}">
                                        @error('phone')
                                        <div class="text-danger text-sm">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!-- END: PHONE -->

                                    <!-- START: ALAMAT -->
                                    <div class="form-group">
                                        <label for="alamat">ALAMAT</label>
                                        <input type="text" class="form-control @error('alamat') is-invalid @enderror"
                                               id="alamat" name="alamat" value="{{old('alamat',$datauser->guru->alamat)}}">
                                        @error('alamat')
                                        <div class="text-danger text-sm">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!-- END: ALAMAT -->
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                            @endif
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <p class="text-danger text-sm">* Password default = 1234</p>
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
