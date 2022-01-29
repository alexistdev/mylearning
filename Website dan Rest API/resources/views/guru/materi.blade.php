@if($template == 'adminlte')
    <x-adminlte.dashboard-layout :title="$judul" :tagSubMenu="$tagSubMenu" :total-notif="null">
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Materi Pelajaran</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                                <li class="breadcrumb-item active">Kelas</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>
            <!-- Main content -->
            <section class="content">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Materi Mata Pelajaran Matematika</h3>
                        <button class="btn btn-sm btn-primary float-right">TAMBAH</button>
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
                        <table class="table table-bordered table-striped mb-0 display nowrap" id="tabelKelas"
                               style="width: 100%">
                            <thead>
                            <tr>
                                <th scope="col" class="text-center">#</th>
                                <th scope="col" class="text-center">NAMA</th>
                                <th scope="col" class="text-center">ACTION</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>1</td>
                                <td>Pertemuan 1 "Matematika Dasar" </td>
                                <td width="25%" class="text-center">
                                    <button class="btn btn-success btn-sm">EDIT</button>
                                    <button class="btn btn-primary btn-sm">TUGAS</button>
                                    <button class="btn btn-danger btn-sm">KUIS</button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- START: MODAL HAPUS -->
                    <div class="modal fade" id="modalHapus" tabindex="-1"  aria-hidden="true">
                        <div class="modal-dialog">
                            <form action="{{route('admin.deletekelas')}}" method="post">
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
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
