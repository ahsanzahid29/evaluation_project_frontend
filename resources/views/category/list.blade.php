@include('template.admin_header')
<div class="container-fluid">
    <div class="row mt-3">
        @include('template.sidebar')
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 mt-3">
            @if(Session::has('message'))
                <div class="alert {{ Session::get('alert-class', 'alert-info') }}" role="alert">
                    {{ Session::get('message') }}
                </div>
            @endif
            <div class="row">
                <div class="col-md-8">
                    <h2>Category</h2>
                </div>
                <div class="col-md-4">
                    <a href="{{ route('category-add') }}" class="btn btn-outline-success">Add Category</a>
                </div>
            </div>
            <div class="table-responsive mt-3">
                <table class="table table-striped table-sm" id="category_table">
                    <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($categories as $category)
                    <tr>
                        <td>{{$category['name']}}</td>
                        <td><a href="{{route('category-edit',$category['id'])}}" class="btn btn-outline-info btn-sm">Edit</a>
                        <a href="{{route('category-delete',$category['id'])}}" type="button" class="btn btn-outline-danger btn-sm" >Delete</a>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready( function () {
        $('#category_table').DataTable();
    } );
</script>
@include('template.admin_footer')
</body>
</html>
