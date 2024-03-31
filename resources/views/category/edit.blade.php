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
                <div class="col-md-8 mb-3">
                    <h2>Add Category</h2>
                </div>
                <form method="POST" action="{{ route('category-update') }}">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="category_id" value="{{$category['id']}}" />
                    <div class="mb-3 row">
                        <label for="categorynamefield" class="col-sm-2 col-form-label">Category Name</label>
                        <div class="col-sm-6">
                            <input type="text" name="name" class="form-control" placeholder="Category Name" value="{{$category['name']}}" id="categorynamefield">
                        </div>
                    </div>
                    <hr />
                    <button type="submit" name="addbtn" value="yes" class="btn btn-outline-warning">Update</button>
                    <a href="{{ route('category-list') }}" class="btn btn-outline-secondary">Cancel</a>
                </form>

            </div>

        </main>
    </div>
</div>
@include('template.admin_footer')
</body>
</html>
