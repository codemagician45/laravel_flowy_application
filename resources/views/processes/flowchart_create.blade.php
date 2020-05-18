
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
        <div id="leftcard">
            <p id="header">Blocks</p>
            <div id="blocklist">
                <div class="blockelem create-flowy noselect">
                    <input type="hidden" name='blockelemtype' class="blockelemtype" value="1">
                    <div class="grabme">
                        <img src="assets/grabme.svg">
                    </div>
                    <div class="blockin">
                        <div class="blocktext">
                            <p class="blocktitle">Decision Block</p>
                            <p class="blockdesc">Triggers when somebody visits a specified page</p>
                        </div>
                    </div>
                </div>
                <div class="blockelem create-flowy noselect">
                    <input type="hidden" name='blockelemtype' class="blockelemtype" value="2">
                    <div class="grabme">
                        <img src="assets/grabme.svg">
                    </div>
                    <div class="blockin">
                        <div class="blocktext">
                            <p class="blocktitle">Other BLock</p>
                            <p class="blockdesc">Triggers when somebody performs a specified action</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection