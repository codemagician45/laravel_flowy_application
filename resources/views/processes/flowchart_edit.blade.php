@extends('layouts.main', ['vue' => true])

@section('title', 'Dashboard',['vue' => true])

@section('content')
    <script src="{{ asset('js/flowy.min.js') }}"></script>
    <script src="{{ asset('js/flowchart.js') }}"></script>
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

    <div class="col-12 px-0">
        <div class="row">
            <nav class="col-12" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('themes',['fase_id'=>$fase_id])}}">{{$parent_fase->sysnum.'-'.$parent_fase->name}}</a></li>
                    <li class="breadcrumb-item"><a href="{{route('processes',['fase_id'=>$fase_id,'theme_id'=>$theme_id])}}">{{$parent_fase->sysnum.'.'.$parent_theme->sysnum.'-'.$parent_theme->name}}</a></li>
                    <li class="breadcrumb-item"><a href="{{route('process_show_flowchart',['fase_id' =>$fase_id,'theme_id'=>$theme_id,'id'=>$id ])}}">{{$parent_fase->sysnum.'.'.$parent_theme->sysnum.'.'.$process->sysnum.'-'.$process->name}}</a></li>
                    <li class="active breadcrumb-item" aria-current="page">edit</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-12">
                <form id="flowchart_save" action="{{route('process_store_flowchart',['fase_id' =>$fase_id,'theme_id'=>$theme_id,'id'=>$id ])}}" method="post">
                    @csrf
                    <input type="hidden" name="flowchart_data" id="flowchart_data" value="">
                    <input type="hidden" name="long_des" id="long_des" value="">
                    <button type="submit" class="btn btn-primary float-right mb-3">Save</button>
                </form>

            </div>

        </div>

        <div class="row">
            <input type="hidden" id="flow_import" name="flow_import" value="">
            <div class="col-3">
                <div class="card-shadow-alternate card-border mb-3 card p-2">
                    <p id="header">Blocks</p>
                    <div id="blocklist">
                        <div class="blockelem create-flowy noselect">
                            <input type="hidden" name="blockelemtype" class="blockelemtype" value="1">
                            <div class="blockin">
                                <div class="blocktext">
                                    <p class="blocktitle">New visitor</p>
                                    <p class="blockdesc">Triggers when somebody visits a specified page</p>
                                    <input type="hidden" class="assigned_user" value="">
                                    <input type="hidden" class="url" value="">
                                    <input type="hidden" class="process" value="">
                                </div>
                            </div>
                        </div>
                        <div class="blockelem create-flowy noselect">
                            <input type="hidden" name="blockelemtype" class="blockelemtype" value="1">
                            <div class="blockin">
                                <div class="blocktext">
                                    <p class="blocktitle">New visitor</p>
                                    <p class="blockdesc">Triggers when somebody visits a specified page</p>
                                    <input type="hidden" class="assigned_user" value="">
                                    <input type="hidden" class="url" value="">
                                    <input type="hidden" class="process" value="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-9" >
                <div id="canvas" style="background: white;">
                </div>
            </div>

            <div id="propwrap">
                <div id="properties">
                    <div id="close">
                        <img src="{{asset('images/close.svg')}}">
                    </div>
                    <p id="header2">Properties</p>
                    <div id="divisionthing"></div>

                        <div class="form-group mr-4 mt-4">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name">
                        </div>
                        <div class="form-group mr-4">
                            <label for="assigned_user">Assigned User</label>
                            <select class="form-control" id="assigned_user" name="assigned_user">
                                <option value="0">None</option>
                                @foreach($users as $user)
                                    <option value="{{$user->id}}">{{$user->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mr-4">
                            <label for="description">Description</label>
                            <textarea type="text" class="form-control" id="description" name="description"></textarea>
                        </div>
                        <div class="form-group mr-4">
                            <label for="url">Url</label>
                            <input type="text" class="form-control" id="url" name="url">
                        </div>
                        <div class="form-group mr-4">
                            <label for="process">Other Process</label>
                            <select class="form-control" id="process" name="process">
                                <option value="0">None</option>
                                @foreach($processes as $pro)
                                    <option value="{{$pro->id}}">{{$pro->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <button id="flow_property_save" type="button" class="btn btn-success">Save</button>
{{--                        <button id="flow_property_delete" type="button" class="btn btn-danger">Delete</button>--}}
{{--                    <div id="removeblock">Delete blocks</div>--}}
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card-shadow-alternate card-border mb-4 card p-4">
                    <div id="editor">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        var flowyData0,flowyData1, flowyData;
        flowyData0 = '<?php echo json_encode($process->flowchart);?>';
        flowyData1 = flowyData0.slice(1, -1);
        if(flowyData1)
            flowyData = JSON.parse(flowyData1);
        $('#flow_import').val(flowyData1);

        var quill = new Quill('#editor', {
            theme: 'snow'
        });
        delta0 = '<?php echo json_encode($process->long_des)?>';
        delta1 = delta0.slice(1,-1)
        if(delta1){
            delta = JSON.parse(delta1);
            quill.setContents(delta);
        }

        $('#flowchart_save').submit(function (e) {
            $('#flowchart_data').val(JSON.stringify(flowy.output()))
            var delta = quill.getContents();
            $('#long_des').val(JSON.stringify(delta));
        });


    </script>

@endsection