@if($template == 'adminlte')
    <x-adminlte.dashboard-layout :title="$judul" :tagSubMenu="$tagSubMenu" :total-notif="null">
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Data Siswa : {{$namaKelas}}</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                                <li class="breadcrumb-item active">Siswa</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>
            <!-- Main content -->
            <section class="content">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Data Siswa</h3>
                    </div>
                    <div class="card-body">
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success alert-block">
                                <strong>{{ $message }}</strong>
                            </div>
                        @elseif($message = Session::get('hapus'))
                            <div class="alert alert-danger alert-block">
                                <strong>{{ $message }}</strong>
                            </div>
                        @else
                        @endif
                        <table class="table table-bordered table-striped mb-0 display nowrap" id="tabelsiswa"
                               style="width: 100%">
                            <thead>
                            <tr>
                                <th scope="col" class="text-center">#</th>
                                <th scope="col" class="text-center">NAMA</th>
                                <th scope="col" class="text-center">NIP</th>
                                <th scope="col" class="text-center">TELEPON</th>
                                <th scope="col" class="text-center">ALAMAT</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php $no=1 @endphp
                            @foreach($dataSiswa as $row)
                                <tr>
                                    <td class="text-center">{{$no++}}</td>
                                    <td class="text-center">{{$row->siswa->user->name}}</td>
                                    <td class="text-center">{{$row->siswa->nisn}}</td>
                                    <td class="text-center">{{$row->siswa->phone}}</td>
                                    <td class="text-center">{{$row->siswa->alamat}}</td>
                                    <td class="text-center"><button class="btn btn-sm btn-primary">TUGAS</button></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- START: MODAL HAPUS -->
                    <div class="modal fade" id="modalHapus" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog">
                            <form action="{{route('admin.deletemapel')}}" method="post">
                                @csrf
                                @method('delete')
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">HAPUS</h5>
                                    </div>
                                    <div class="modal-body">
                                        <input type="hidden" id="idhapus" name="id" value="">
                                        Apakah anda ingin menghapus data ini?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close
                                        </button>
                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- END: MODAL HAPUS -->
                    <!-- /.card-body -->
                    <div class="card-footer">
                        MyLearning
                    </div>
                    <!-- /.card-footer-->
                </div>
            </section>
            <x-adminlte.script-layout/>

        </div>
    </x-adminlte.dashboard-layout>
@endif
