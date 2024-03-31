@include('template.admin_header')
<div class="container-fluid">
    <div class="row mt-3">
    @include('template.sidebar')
    <div class="row mt-3 ">
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 mt-2">
            <h2>Dashboard</h2>
            <div class="row mt-3">
                <div class="col md-3">
                    <div class="card text-white bg-primary mb-3" >
                        <div class="card-body">
                            <h5 class="card-title">{{ $carCount }}</h5>
                            <p class="card-text">Total Vehicles</p>
                        </div>
                    </div>
                </div>

            </div>
        </main>
    </div>
</div>
</div>
@include('template.admin_footer')
</body>
</html>
