@extends('voyager::master')

@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop

@section('page_title', __('voyager::generic.add') . ' ' . $dataType->getTranslatedAttribute('display_name_singular'))

@section('page_header')
    <h1 class="page-title">
        <i class="{{ $dataType->icon }}"></i>
        {{ __('voyager::generic.add') . ' ' . $dataType->getTranslatedAttribute('display_name_singular') }}
    </h1>
    @include('voyager::multilingual.language-selector')
@stop

@section('content')
    <div class="page-content edit-add container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered">
                    <!-- form start -->
                    <form role="form" class="form-edit-add" action="{{ route('voyager.' . $dataType->slug . '.store') }}"
                        method="POST" enctype="multipart/form-data">
                        <!-- CSRF TOKEN -->
                        {{ csrf_field() }}

                        <div class="panel-body">

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif


                            <div class="form-group">
                                <label class="control-label" for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Name">
                            </div>


                            <div class="form-group">
                                <label class="control-label" for="details">Details</label>
                                <input type="text" class="form-control" id="details" name="details"
                                    placeholder="Details">
                            </div>


                            <div class="form-group">
                                <label class="control-label" for="description">Description</label>
                                <textarea class="form-control" id="description" name="description" placeholder="Description"></textarea>
                            </div>


                            <div class="form-group">
                                <label class="control-label" for="stock">Stock</label>
                                <input type="number" class="form-control" id="stock" name="stock"
                                    placeholder="Stock">
                            </div>


                            <div class="form-group">
                                <label class="control-label" for="price">Price</label>
                                <input type="number" step="0.01" class="form-control" id="price" name="price"
                                    placeholder="Price">
                            </div>


                            @foreach ($dataType->addRows as $row)
                                <div class="form-group">
                                    <label class="control-label"
                                        for="{{ $row->field }}">{{ $row->getTranslatedAttribute('display_name') }}</label>
                                    @if ($row->field === 'images')
                                        {{-- Handle images field --}}
                                        <input type="file" name="{{ $row->field }}[]" multiple accept="image/*">
                                    @elseif($row->type === 'text')
                                        <input type="text" class="form-control" id="{{ $row->field }}"
                                            name="{{ $row->field }}"
                                            placeholder="{{ $row->getTranslatedAttribute('display_name') }}">
                                    @elseif($row->type === 'textarea')
                                        <textarea class="form-control" id="{{ $row->field }}" name="{{ $row->field }}"
                                            placeholder="{{ $row->getTranslatedAttribute('display_name') }}"></textarea>
                                    @elseif($row->type === 'number')
                                        <input type="number" class="form-control" id="{{ $row->field }}"
                                            name="{{ $row->field }}"
                                            placeholder="{{ $row->getTranslatedAttribute('display_name') }}">
                                    @endif
                                </div>
                            @endforeach

                            <!-- Submit button -->
                            <button type="submit" class="btn btn-primary save">{{ __('voyager::generic.save') }}</button>
                        </div><!-- panel-body -->
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

@section('javascript')
    <script>
        $(document).ready(function() {

        });
    </script>
@stop
