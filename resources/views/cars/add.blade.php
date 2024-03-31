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
                    <h2>Add Car</h2>
                </div>
                <form method="POST" action="{{ route('car-save') }}">
                    @csrf
                    <div class="mb-3 row">
                        <label for="carnamefield" class="col-sm-2 col-form-label">Car Name</label>
                        <div class="col-sm-6">
                            <input type="text" name="name" class="form-control" placeholder="Car Name" id="carnamefield">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="carmodelfield" class="col-sm-2 col-form-label">Car Model</label>
                        <div class="col-sm-6">
                            <input type="text" name="model" class="form-control" placeholder="Car Model" id="carmodelfield">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="carcolorfield" class="col-sm-2 col-form-label">Car Color</label>
                        <div class="col-sm-6">
                            <input type="text" name="color" class="form-control" placeholder="Car Color" id="carcolorfield">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="category" class="col-sm-2 col-form-label">Category</label>
                        <div class="col-sm-6">
                            <select name="category_id" class="form-select">
                                <option value="0" selected>Select category</option>
                                @foreach($categories as $category)
                                    <option value="{{$category['id']}}">{{$category['name']}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <hr />
                    <button type="submit" name="addbtn" value="yes" class="btn btn-outline-primary">Save</button>
                    <a href="{{ route('cars-list') }}" class="btn btn-outline-secondary">Cancel</a>
                </form>

            </div>

        </main>
    </div>
</div>
@include('template.admin_footer')
</body>
</html>
