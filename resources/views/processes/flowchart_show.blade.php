
@extends('layouts.main', ['vue' => true])

@section('title', 'Dashboard')

@section('content')
    <div class="col-12 px-0">
        <div class="row">
            <nav class="col-12" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Systemen</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Kwaliteitssysteem van Doorn</a></li>
                    <li class="active breadcrumb-item" aria-current="page">Data</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-12">
                <button type="submit" class="btn btn-primary float-right mb-3"><a href="{{route('process_create_flowchart',['fase_id' =>$fase_id,'theme_id'=>$theme_id,'id'=>$id ])}}" style="color: white;">Create Flowchart</a></button>
            </div>

        </div>
    </div>

@endsection
