
@extends('layouts.main',['vue' => true])

@section('title', 'Dashboard')

@section('content')
    <script src="{{ asset('js/flowy.min.js') }}"></script>
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

    <div class="col-12 px-0">
        <div class="row">
            <nav class="col-12" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('themes',['fase_id'=>$fase_id])}}">{{$parent_fase->sysnum.'-'.$parent_fase->name}}</a></li>
                    <li class="breadcrumb-item"><a href="{{route('processes',['fase_id'=>$fase_id,'theme_id'=>$theme_id])}}">{{$parent_fase->sysnum.'.'.$parent_theme->sysnum.'-'.$parent_theme->name}}</a></li>
                    <li class="breadcrumb-item"><a href="{{route('process_show_flowchart',['fase_id' =>$fase_id,'theme_id'=>$theme_id,'id'=>$id ])}}">{{$parent_fase->sysnum.'.'.$parent_theme->sysnum.'.'.$process->sysnum.'-'.$process->name}}</a></li>
                    <li class="active breadcrumb-item" aria-current="page">show</li>
                </ol>
            </nav>
        </div>

        <div class="row">
            <div class="col-12">
                <input type="hidden" name="status" id="status" value="show">
                <button type="click" class="btn btn-primary float-right mb-3 "><a href="{{route('process_edit_flowchart',['fase_id' =>$fase_id,'theme_id'=>$theme_id,'id'=>$id ])}}" class="top-right-btn">Edit Process</a></button>
                <button type="click" class="btn btn-success float-right mb-3 mr-2 "><a href="{{route('process_export_excel',['fase_id' =>$fase_id,'theme_id'=>$theme_id,'id'=>$id ])}}" class="top-right-btn">Export Process</a></button>
            </div>
        </div>

        <div class="row">
            <input type="hidden" id="flow_import" name="flow_import" value="">
            <div class="col-3">
                <div class="card-shadow-alternate card-border mb-3 card p-2">
                    <p class="header">Blocks</p>
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
                <div class="role-panel form-group">
                    <p class="process-role-block">Process Roles</p>
                    @foreach($role_arr as $role)
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input role-select" id="{{$role->role_name}}">
                            <input type="hidden" id="role-id" value="{{$role->id}}">
                            <input type="hidden" id="role-color" value="{{$role->color}}">
                            <label class="custom-control-label" for="{{$role->role_name}}">{{$role->role_name}}</label>
                        </div>
                    @endforeach
                </div>
                <div id="canvas" style="background: white;">

                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-12">
                <div class="card-shadow-alternate card-border mb-4 card p-4">
                    <p class="header">Process Editor</p>
                    <div id="editor">
                    </div>
                    <div class="log">
                        <ul>
                            <li><span style="font-weight: bold">User :</span> @if(isset($user_make_changed)){{$user_make_changed->name}}@endif</li>
                            <li><span style="font-weight: bold">Commit :</span> {{$process->commit}}</li>
                            <li><span style="font-weight: bold">Last Update :</span> {{$process->updated_at->format('d-m-Y H:i')}}</li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <script>
        var flowyData0,flowyData1, flowyData,delta0,delta1,delta;
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
        quill.enable(false);

        flowy(document.getElementById("canvas"));
        var flowyDataJson = $('#flow_import').val();
        if (flowyDataJson) {
            var flowyData = JSON.parse(flowyDataJson);

            flowy.import(flowyData);
        }
        $('#canvas').on('mousedown', function (e) {
            e.preventDefault();
            return false;
        })
        $('#blocklist').on('mousedown', function (e) {
            e.preventDefault();
            return false;
        })

        $('.blockelem').click(function () {
            let selectedUrl = this.children[1].children[0].children[3].value;
            let selectedProcess = this.children[1].children[0].children[4].value;
            if(selectedUrl){
                if(selectedUrl.includes('http'))
                    window.open(selectedUrl,'_blank');
                else
                    window.open('https://'+selectedUrl, '_blank');
            }

            if(selectedProcess){
                let currentUrl = window.location.href;
                window.open(currentUrl.substring(0,currentUrl.indexOf('/show')-1)+selectedProcess+'/show', '_blank');
            }

        })

        var roleId, roleColor,thisRole, thisColor;
        var blocks = $('#canvas').find('.blockelem');
        $('.role-select').change(function () {
            if($(this).prop('checked')) {
                roleId = this.parentNode.children[1].value;
                roleColor = this.parentNode.children[2].value;
                for(let i=0; i<blocks.length;i++){
                    thisRole = blocks[i].children[1].children[0].children[5].value;
                    if(thisRole == roleId)
                        blocks[i].style.background = roleColor
                }
            }
            else{
                roleId = this.parentNode.children[1].value;
                roleColor = this.parentNode.children[2].value;
                for(let i=0; i<blocks.length;i++){
                    thisRole = blocks[i].children[1].children[0].children[5].value;
                    if(thisRole == roleId)
                        blocks[i].style.background = ''
                }
            }
        })

        // $('.edit_link').click(function (e) {
        //     e.preventDefault();
        //     console.log("ddd")
        // })

    </script>
    @if ($message = Session::get('success'))
        <script>
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: '<?php echo $message;?>',
                showConfirmButton: false,
                timer: 1500
            })
        </script>
    @endif
@endsection