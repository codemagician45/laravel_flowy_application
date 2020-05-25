@extends('layouts.main',['vue' => true])

@section('title', 'Dashboard')

@section('content')

<div class="col-12 px-0">
    <div class="row">
        <nav class="col-12" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="active breadcrumb-item" aria-current="page">Dashboard</li>
            </ol>
        </nav>
    </div>

    <div class="row">
        <div class="col-12">
            <p class="header">Recent Activated Processors</p>
        </div>
    </div>
    <div class="row">
        <div class="col-9">
            <x-cards :datas="$recent_processes" class="col-12"></x-cards>
        </div>

        <div class="col-3">
            <div class="card-shadow-alternate card-border mb-3 card p-1">
                <div class="dropdown-menu-header text-dark">
                    <div class="dropdown-menu-header-inner">
                        <div class="menu-header-content">


                            <img src="/images/helpcenter.png" class="sidebar-header-img" alt="">

                            <div>
                                <h5 class="menu-header-title text-center pb-2">Heb je hulp nodig?</h5>
                                <p class="menu-header-subtitle text-left">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">
                                        <div class="widget-content p-0">
                                            <div class="widget-content-wrapper" style="display: -webkit-box;">
                                                <div class="widget-content-left center-elem mr-2"><i class="pe-7s-right-arrow"></i></div>
                                                <div class="widget-content-left text-left">
                                                    <div class="widget-heading">Hoe bewerk ik mijn accountinformatie?</div>
                                                </div>

                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="widget-content p-0">
                                            <div class="widget-content-wrapper" style="display: -webkit-box;">
                                                <div class="widget-content-left center-elem mr-2"><i class="pe-7s-right-arrow"></i></div>
                                                <div class="widget-content-left text-left">
                                                    <div class="widget-heading">Wie kan de bedrijfsgegevens aanpassen?</div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="widget-content p-0">
                                            <div class="widget-content-wrapper" style="display: -webkit-box;">
                                                <div class="widget-content-left center-elem mr-2"><i class="pe-7s-right-arrow"></i></div>
                                                <div class="widget-content-left text-left">
                                                    <div class="widget-heading">Waar vind ik informatie over mijn account?</div>
                                                </div>

                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="widget-content p-0">
                                            <div class="widget-content-wrapper" style="display: -webkit-box;">
                                                <div class="widget-content-left center-elem mr-2"><i class="pe-7s-right-arrow"></i></div>
                                                <div class="widget-content-left text-left">
                                                    <div class="widget-heading">Ben ik verplicht een profielfoto in te stellen?</div>
                                                </div>

                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="widget-content p-0">
                                            <div class="widget-content-wrapper" style="display: -webkit-box;">
                                                <div class="widget-content-left center-elem mr-2"><i class="pe-7s-right-arrow"></i></div>
                                                <div class="widget-content-left text-left">
                                                    <div class="widget-heading">Waarom kan ik niet alle gegevens wijzigen?</div>
                                                </div>

                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="widget-content p-0">
                                            <div class="widget-content-wrapper" style="display: -webkit-box;">
                                                <div class="widget-content-left center-elem mr-2"><i class="pe-7s-right-arrow"></i></div>
                                                <div class="widget-content-left text-left">
                                                    <div class="widget-heading">Waar vind ik mijn versienummer?</div>
                                                </div>

                                            </div>
                                        </div>
                                    </li>
                                </ul>
                                </p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <p class="header">Process Search</p>
        </div>
    </div>
    <div class="row" id="search-result">
        <div class="col-12">
            <form class="form-inline md-form mr-auto mb-4" id="search_process" action="{{route('search-process')}}" method="post">
                @csrf
                <input class="form-control" type="text" placeholder="Search" aria-label="Search" style="width: 90%;margin:auto" name="search_text" id="search_text">
{{--                <button class="btn btn-success btn-rounded btn-sm my-0" style="width: 8%" type="submit">Search</button>--}}
            </form>
        </div>
    </div>

</div>

<script>
    $('#search_text').keyup(function () {

        var search_text = $(this).val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.ajax({
                type:'POST',
                url:'/search',
                data: {
                    search_text:search_text
                },
                success:function (data) {
                    document.querySelectorAll('.process-search').forEach(function(a){
                        a.remove()
                    })
                    if(data.length!=0){
                        for(let i = 0; i < 5; i++){
                            if(data[i])
                            {
                                let url = window.location.href+'fases/'+data[i].fase_id+'/themes/'+data[i].theme_id+'/processes/'+data[i].id+'/show';
                                let year = data[i].updated_at.slice(0,4);
                                let month = data[i].updated_at.slice(5,7);
                                let day = data[i].updated_at.slice(8,10);
                                let hour = data[i].updated_at.slice(11,13);
                                let min = data[i].updated_at.slice(14, 16);
                                let date = day+'-'+month+'-'+year+' '+hour+':'+min;
                                $('#search-result').append(
                                    '<div class="col-12 process-search"><div class="main-card mb-4 card card-hover-shadow-2x"><div class="row no-gutters overflow-hidden"><div class="col-3 p-4 bg-sunny-morning d-flex align-items-center"> <span class="display-4" style="color: rgba(255,255,255,0.9)">'+ data[i].sysnum +'.</span><div class="card-index__rondje"></div></div><div class="col-9 py-1"><a href="'+url+'" class="text-decoration-none text-body"><div class="card-body"><h5 class="card-title">'+data[i].name+'</h5><p class="pt-max mb-0">'+data[i].description+'</p><p class="pt-max mt-2 float-right">Last updated: '+date+'</p></div></div></div></div></div>'
                                )
                            }
                        }
                    }

                }
            });
    })
    $('#search_text').keypress(function (e) {
        var key = e.which;
        if(key == 13){
            return false;
        }
    })

</script>
@endsection
