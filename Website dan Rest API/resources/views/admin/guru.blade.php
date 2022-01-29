@if($template == 'adminlte')
    <x-adminlte.dashboard-layout :title="$judul" :tagSubMenu="$tagSubMenu" :total-notif="null">
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Data Guru</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                                <li class="breadcrumb-item active">Guru</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>
            <!-- Main content -->
            <section class="content">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Data Guru</h3>
                        <a href="{{route('admin.addguru')}}">
                            <button class="btn btn-primary btn-sm float-right">TAMBAH</button>
                        </a>
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
                        <table class="table table-bordered table-striped mb-0 display nowrap" id="tabelGuru"
                               style="width: 100%">
                            <thead>
                            <tr>
                                <th scope="col" class="text-center">#</th>
                                <th scope="col" class="text-center">NAMA</th>
                                <th scope="col" class="text-center">NIP</th>
                                <th scope="col" class="text-center">TELEPON</th>
                                <th scope="col" class="text-center">DIBUAT</th>
                                <th scope="col" class="text-center">ACTION</th>
                            </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                    <!-- START: MODAL HAPUS -->
                    <div class="modal fade" id="modalHapus" tabindex="-1"  aria-hidden="true">
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
            <script>
                $('#tabelGuru').DataTable({
                    responsive: true,
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('admin.guru') }}",
                    columns: [
                        {
                            data: 'index',
                            class: 'text-center',
                            defaultContent: '',
                            orderable: false,
                            searchable: false,
                            width: '5%',
                            render: function (data, type, row, meta) {
                                return meta.row + meta.settings._iDisplayStart + 1; //auto increment
                            }
                        },
                        {data: 'user.name', class: 'text-left'},
                        {data: 'nip', class: 'text-left'},
                        {data: 'phone', class: 'text-center'},
                        {data: 'created_at', class: 'text-center'},
                        {data: 'action', class: 'text-center'},
                    ],

                });
                $(document).on("click", ".hapus", function () {
                    var id = $(this).data('id');
                    $('#idhapus').val(id);

                });
            </script>
        </div>
    </x-adminlte.dashboard-layout>
@endif
