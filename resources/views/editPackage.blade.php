@extends('layouts.app')

@section('sidebar')
<div class="sidebar" data-image="{{ asset('assets/img/sidebar-5.jpg') }}" data-color="green">
    <div class="sidebar-wrapper">
        <div class="logo">
            <a href="{{ url('/') }}" class="simple-text">
                {{ config('app.name', 'Laravel') }}
            </a>
        </div>
        <ul class="nav">
            <li class="nav-item active">
                <a class="nav-link" href="/home">
                    <i class="nc-icon nc-chart-pie-35"></i>
                    <p>Packages</p>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/enquiries">
                    <i class="nc-icon nc-chart-pie-35"></i>
                    <p>Enquiries</p>
                </a>
            </li>
        </ul>
    </div>
</div>
@endsection

@section('navbar')
<nav class="navbar navbar-expand-lg " color-on-scroll="500">
    <div class="container-fluid">
        <a class="navbar-brand" href="/home">Packages</a>
        <button href="" class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
            aria-controls="navigation-index" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-bar burger-lines"></span>
            <span class="navbar-toggler-bar burger-lines"></span>
            <span class="navbar-toggler-bar burger-lines"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navigation">
            <ul class="nav navbar-nav mr-auto">
                <li class="nav-item">
                    <a href="#" class="nav-link" data-toggle="dropdown">
                        <i class="nc-icon nc-palette"></i>
                        <span class="d-lg-none">Dashboard</span>
                    </a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
                @if (Route::has('register'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                </li>
                @endif
                @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>{{ Auth::user()->name }}
                        <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <form action="/package/update/{{$package->id}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-8">
                            <h4 class="card-title">Package Details Editing</h4>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" name="createPck" class="btn btn-success btn-fill btn-block">Update
                                Package</button>
                            <input type="hidden" name="hotel" class="hotel" value="{{ old('hotel', $package->hotel) }}">
                            <input type="hidden" name="trans" class="trans" value="{{ old('trans', $package->trans) }}">
                            <input type="hidden" name="meal" class="meal" value="{{ old('meal', $package->meal) }}">
                            <input type="hidden" name="sight" class="sight" value="{{ old('sight', $package->sight) }}">
                            <input type="hidden" name="dbimage" value="{{ $package->image }}">
                        </div>
                        <div class="col-md-2">
                            <a href="/home" class="btn btn-block btn-danger">Back</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-2">
                            <div class="form-group">
                                <label>Code</label>
                                <input type="text" class="form-control" name="code" placeholder="Package Code"
                                    value="{{ old('code', $package->code) }}" required>
                                @error('code')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" class="form-control" name="title" placeholder="Enter Title"
                                    value="{{ old('title', $package->title) }}" required>
                                @error('title')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="form-group">
                                <label>Rate/pax</label>
                                <input type="number" class="form-control text-right" name="rate" step=".01"
                                    value="{{ old('rate', $package->rate) }}" required>
                                @error('rate')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>
                        </div>
                        <div class="col-1">
                            <div class="form-group">
                                <label>Days</label>
                                <input type="number" class="form-control text-right" name="days"
                                    value="{{ old('days', $package->days) }}">
                            </div>
                        </div>
                        <div class="col-1">
                            <div class="form-group">
                                <label>Nights</label>
                                <input type="number" class="form-control text-right" name="nights"
                                    value="{{ old('nights', $package->nights) }}">
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="form-group">
                                <label>Min PAX</label>
                                <input type="number" class="form-control text-right" name="minPax"
                                    value="{{ old('minPax', $package->minPax) }}" required>
                                @error('minPax')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-2">
                            <div class="form-group">
                                <label>Tag</label>
                                <select name="tag" class="form-control" required>
                                    <option value="">Select Tag</option>
                                    <option {{ $package->tag == "Popular" ? "selected" : '' }} value="Popular">Popular
                                    </option>
                                    <option {{ $package->tag == "Hot" ? "selected" : '' }} value="Hot">Hot</option>
                                    <option {{ $package->tag == "Trending" ? "selected" : '' }} value="Trending">
                                        Trending</option>
                                    <option {{ $package->tag == "New" ? "selected" : '' }} value="New">New</option>
                                </select>
                                @error('tag')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="form-group">
                                <label>Status</label>
                                <select name="status" class="form-control" required>
                                    <option value="">Select Status</option>
                                    <option {{ $package->status == "active" ? "selected" : '' }} value="active">Active
                                    </option>
                                    <option {{ $package->status == "inactive" ? "selected" : '' }} value="inactive">
                                        Inactive</option>
                                </select>
                                @error('status')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label>Select Image</label>
                                <small class="pull-right">Add new image or leave blank.</small>
                                <input type="file" name="image" class="form-control"
                                    accept="image/x-png,image/gif,image/jpeg">
                                @error('image')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="btn-group" role="group">
                                <button type="button"
                                    class="btn btn-fill {{ $package->hotel === 'true' ? 'btn-success' : 'btn-primary' }}"
                                    value="{{ $package->hotel }}" onclick="options(this, 'hotel');">
                                    <i class="fa fa-building" aria-hidden="true"></i> Hotel
                                </button>
                                <button type="button"
                                    class="btn btn-fill {{ $package->trans === 'true' ? 'btn-success' : 'btn-primary' }}"
                                    value="{{ $package->trans }}" onclick="options(this, 'trans');">
                                    <i title="Transportation" class="fa fa-car" aria-hidden="true"></i> Transport
                                </button>
                                <button type="button"
                                    class="btn btn-fill {{ $package->meal === 'true' ? 'btn-success' : 'btn-primary' }}"
                                    value="{{ $package->meal }}" onclick="options(this, 'meal');">
                                    <i class="fa fa-cutlery" aria-hidden="true"></i> Meal
                                </button>
                                <button type="button"
                                    class="btn btn-fill {{ $package->sight === 'true' ? 'btn-success' : 'btn-primary' }}"
                                    value="{{ $package->sight }}" onclick="options(this, 'sight');">
                                    <i class="fa fa-street-view" aria-hidden="true"></i> Sightseeing
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Description</label>
                                <textarea rows="4" cols="80" class="form-control" name="description"
                                    placeholder="Enter your description here">{{ old('description', $package->description) }}</textarea>
                                @error('description')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('pageScript')
<script>
    function options(elm, type)
    {
        let hotel = $('.hotel');
        let trans = $('.trans');
        let meal = $('.meal');
        let sight = $('.sight');
        let boolVal = (elm.value === 'true') ? "false" : "true";

        if (boolVal === 'true') {
            elm.classList.add("btn-success");
            elm.classList.remove("btn-primary");
        }else{
            elm.classList.add("btn-primary");
            elm.classList.remove("btn-success");
        }

        switch (type) {
            case "hotel":
            hotel.val(boolVal);
            break;
            case "trans":
            trans.val(boolVal)
            break;
            case "meal":
            meal.val(boolVal)
            break;
            case "sight":
            sight.val(boolVal)
            break;
        }
        elm.value = boolVal;
    }
</script>
@endsection
