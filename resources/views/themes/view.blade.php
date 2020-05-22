@extends('layouts.main', ['vue' => true])

@section('title', 'Dashboard')

@section('content')

    <div class="col-12 px-0">

        <div class="row">
            <nav class="col-12" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('themes',['fase_id'=>$fase_id])}}">{{$parent_fase->sysnum.'-'.$parent_fase->name}}</a></li>
                    <li class="active breadcrumb-item" aria-current="page">Themes Overview</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-12">
                <button type="submit" class="btn btn-primary float-right mb-3"><a href="{{route('create_theme',['fase_id' =>$fase_id ])}}" class="top-right-btn">Create New Theme</a></button>
            </div>

        </div>
        <div class="row">
            <div class="col-9">

                <x-cards :datas="$themes" class="col-12"></x-cards>

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
    </div>
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
