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
            <h4>Recent Activated Processors</h4>
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
            <h4>Process Search</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <form class="form-inline md-form mr-auto mb-4" id="search_process">
                <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search" style="width: 90%;" id="search_text">
                <button class="btn btn-success btn-rounded btn-sm my-0" style="width: 8%" type="submit">Search</button>
            </form>
        </div>
        <div class="col-12" id="search-result">
            <h5>Result</h5>

        </div>
    </div>

</div>

<script>

    $('#search_process').submit(function(e){
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        $.ajax({
            type:'POST',
            url:'/search',
            data: {
                searchText:$('#search_text').val()
            },
            success:function (data) {
                console.log(data);
                console.log(Object.assign({}, data));

            }
        });
    })
</script>
@endsection
