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
        <form action="/package/save" method="POST" enctype="multipart/form-data">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-8">
                            <h4 class="card-title">Create New Package</h4>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" name="createPck" class="btn btn-success btn-fill btn-block">Create
                                Package</button>
                            <input type="hidden" name="hotel" class="hotel" value="{{ old('hotel', 'false') }}">
                            <input type="hidden" name="trans" class="trans" value="{{ old('trans', 'false') }}">
                            <input type="hidden" name="meal" class="meal" value="{{ old('meal', 'false') }}">
                            <input type="hidden" name="sight" class="sight" value="{{ old('sight', 'false') }}">
                        </div>
                        <div class="col-md-2">
                            <a href="/home" class="btn btn-block btn-danger">Back</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @csrf
                    <div class="row">
                        <div class="col-2">
                            <div class="form-group">
                                <label>Code</label>
                                <input type="text" class="form-control" name="code" placeholder="Package Code"
                                    value="{{ old('code') }}" required>
                                @error('code')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" class="form-control" name="title" placeholder="Enter Title"
                                    value="{{ old('title') }}" required>
                                @error('title')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="form-group">
                                <label>Rate/pax</label>
                                <input type="number" class="form-control text-right" name="rate" step=".01"
                                    value="{{ old('rate', "0.00") }}" required>
                                @error('rate')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>
                        </div>
                        <div class="col-1">
                            <div class="form-group">
                                <label>Days</label>
                                <input type="number" class="form-control text-right" name="days"
                                    value="{{ old('days', 1) }}">
                            </div>
                        </div>
                        <div class="col-1">
                            <div class="form-group">
                                <label>Nights</label>
                                <input type="number" class="form-control text-right" name="nights"
                                    value="{{ old('nights', 1) }}">
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="form-group">
                                <label>Min PAX</label>
                                <input type="number" class="form-control text-right" name="minPax"
                                    value="{{ old('minPax', 1) }}" required>
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
                                    <option value="Popular">Popular</option>
                                    <option value="Hot">Hot</option>
                                    <option value="Trending">Trending</option>
                                    <option value="New">New</option>
                                </select>
                                @error('tag')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="form-group">
                                <label>Status</label>
                                <select name="status" class="form-control" required>
                                    <option value="">Select Status</option>
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                                @error('status')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label>Select Image</label>
                                <input type="file" name="image" class="form-control"
                                    accept="image/x-png,image/gif,image/jpeg" required>
                                @error('image')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-fill btn-primary" value="false"
                                    onclick="options(this, 'hotel');">
                                    <i class="fa fa-building" aria-hidden="true"></i> Hotel
                                </button>
                                <button type="button" class="btn btn-fill btn-primary" value="false"
                                    onclick="options(this, 'trans');">
                                    <i title="Transportation" class="fa fa-car" aria-hidden="true"></i> Transport
                                </button>
                                <button type="button" class="btn btn-fill btn-primary" value="false"
                                    onclick="options(this, 'meal');">
                                    <i class="fa fa-cutlery" aria-hidden="true"></i> Meal
                                </button>
                                <button type="button" class="btn btn-fill btn-primary" value="false"
                                    onclick="options(this, 'sight');">
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
                                    placeholder="Enter your description here">{{ old('description') }}</textarea>
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
    function options(elm, type){
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
