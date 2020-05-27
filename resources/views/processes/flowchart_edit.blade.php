@extends('layouts.main', ['vue' => true])

@section('title', 'Dashboard',['vue' => true])

@section('content')
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
                <form id="process_update" action="{{route('process_store_flowchart',['fase_id' =>$fase_id,'theme_id'=>$theme_id,'id'=>$id ])}}" method="post">
                    @csrf
                    <input type="hidden" name="flowchart_data" id="flowchart_data" value="">
                    <input type="hidden" name="long_des" id="long_des" value="">
                    <input type="hidden" name="block_data" id="block_data" value="">
                    <input type="hidden" name="role_data" id="role_data" value="">
                    <input type="hidden" name="change-commit" id="change-commit" value="">
{{--                    <button type="button" class="btn btn-danger float-right ml-2" id="clearblock">Clear</button>--}}
                    <button type="submit" class="btn btn-primary float-right mb-3">Save</button>
                </form>

            </div>

        </div>

        <div class="row">
            <div class="col-12" >
                <div class="card-shadow-alternate card-border mb-3 card  ">
                    <div id="canvas">
                    </div>
                </div>
            </div>

            <div id="propwrap">
                <div id="properties">
                    <div id="close">
                        <img src="{{asset('images/close.svg')}}">
                    </div>
                    <p id="header2">Properties</p>
                    <div id="divisionthing"></div>
{{--                        <div class="form-group mr-4 mt-4">--}}
{{--                            <label for="name">Name</label>--}}
{{--                            <input type="text" class="form-control" id="name" name="name">--}}
{{--                        </div>--}}
                        <div class="form-group mr-4 mt-4">
                            <label for="description">Description</label>
                            <textarea type="text" class="form-control" id="description" name="description"></textarea>
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
                        <div class="form-group mr-4">
                            <label for="role">Role</label>
                            <select class="form-control" id="role" name="role">
                                <option value="0">None</option>
                                @foreach($roles as $role)
                                    <option value="{{$role->id}}">{{$role->role_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <button id="flow_property_save" type="button" class="btn btn-success">Save</button>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card-shadow-alternate card-border mb-4 card p-4">
                    <p class="header">Process Edior</p>
                    <div id="editor">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="hover_bkgr_fricc">
        <span class="helper"></span>
        <div>
            <div class="popupCloseButton">&times;</div>
            <div class="form-group">
                <label for="change-commit-des">Change Commit</label>
                <textarea type="text" class="form-control" id="change-commit-des" name="change-commit-des"></textarea>
            </div>
            <button type="button" class="btn btn-success float-right" id="commit" name="commit">Commit</button>
        </div>
    </div>
    <!-- modeler distro -->
    <script src="https://unpkg.com/bpmn-js@6.5.1/dist/bpmn-modeler.development.js"></script>
    <script src="{{ asset('js/diagram-edit.js') }}"></script>
    <script>
        var flowyData0, flowyData,flowyInfo0,flowyInfo,delta0, delta1,delta;
        flowyData0 = '<?php echo json_encode($process->flowchart);?>';
        flowyData = flowyData0.slice(1, -1);
        if(flowyData0 != 'null')
            openDiagram(flowyData)

        flowyInfo0 = '<?php echo $process->block_data?>';
        $('#block_data').val(flowyInfo0)

        var quill = new Quill('#editor', {
            theme: 'snow'
        });

        delta0 = '<?php echo json_encode($process->long_des)?>';
        delta1 = delta0.slice(1,-1)
        if(delta0!='null'){
            delta = JSON.parse(delta1);
            quill.setContents(delta);
        }

        $('#process_update').submit(function (e) {
            e.preventDefault();
            exportDiagram();
            var delta = quill.getContents();
            $('#long_des').val(JSON.stringify(delta));

            var blocks = $('#canvas').find('.djs-visual');
            if(blockData.length != 0)
                for (let i = 0; i <  blocks.length; i++)
                {
                    let thisId = blocks[i].parentNode.getAttribute('data-element-id');
                    let thisName;
                    if(blocks[i].getElementsByTagName('tspan').length!=0)
                        thisName = blocks[i].getElementsByTagName('tspan')[0].textContent
                    let thisActiveBlock = blockData.filter(data => {
                        return data.id == thisId
                    })
                    if(thisActiveBlock.length == 1)
                        thisActiveBlock[0].name = thisName;
                    let thisExtraBlock = blockData.filter(data=> {
                        return data.id + '_label' == thisId
                    })
                    if(thisExtraBlock.length == 1)
                        thisExtraBlock[0].name = thisName
                }
            else
                for (let i = 0; i <  blocks.length; i++)
                {
                    let thisId = blocks[i].parentNode.getAttribute('data-element-id');
                    let thisName;
                    if(blocks[i].getElementsByTagName('tspan').length!=0)
                        thisName = blocks[i].getElementsByTagName('tspan')[0].textContent;
                    if(!thisName){
                        console.log("undefined")
                        continue;
                    }
                    else{
                        if(thisId.includes('_label')){
                            console.log('label')
                            blockData.push({
                                id:thisId.substring(0, thisId.lastIndexOf("_label")),
                                name:thisName,
                                des:""
                            })
                        }
                        else{
                            console.log('default')
                            blockData.push({
                                id:thisId,
                                name:thisName,
                                des:""
                            })
                        }
                    }
                }
            console.log(blockData)

            $('#block_data').val(JSON.stringify(blockData));
            var roleArr = [];
            for(let k=0; k<blockData.length;k++){

                if(blockData[k].role != 0 && blockData[k].role != '' && !roleArr.includes(blockData[k].role))
                    roleArr.push(blockData[k].role);
            }
            $('#role_data').val(JSON.stringify(roleArr));

            //commit
            $('.hover_bkgr_fricc').show();

            $('.popupCloseButton').click(function(){
                $('.hover_bkgr_fricc').hide();
            });
        });
        $('#commit').click(function () {
            $('#change-commit').val($('#change-commit-des').val());
            $("#process_update")[0].submit();
        })

    </script>

@endsection