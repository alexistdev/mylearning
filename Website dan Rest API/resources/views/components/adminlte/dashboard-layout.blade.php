<div>
    <!doctype html>
    <html lang="en">
    <head>
        <x-adminlte.header-layout :title="$title"/>
    </head>
    <body class="hold-transition sidebar-mini">
        <!-- START: Site wrapper -->
        <div class="wrapper">
            <!-- Navbar -->
                <x-adminlte.navbar-layout :total-notif="$totalNotif"/>
            <!-- /.navbar -->

            <!-- Start: Sidebar -->
            <x-adminlte.sidebar-layout :tagSubMenu="$tagSubMenu"/>
            <!-- End: Sidebar -->


            <!-- Start: Konten -->
            {{$slot}}
            <!-- End: Konten -->

            <!-- Start: Footer -->
            <x-adminlte.footer-layout/>
        </div>
        <!-- END: ./wrapper -->
    </body>
    </html>

</div>
