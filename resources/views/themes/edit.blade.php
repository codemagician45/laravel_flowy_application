
@extends('layouts.main', ['vue' => true])
@section('content')
    <div class="col-12 px-0">

        <div class="row">
            <nav class="col-12" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('themes',['fase_id'=>$fase_id])}}">{{$parent_fase->sysnum.'-'.$parent_fase->name}}</a></li>
                    <li class="active breadcrumb-item" aria-current="page">Edit Theme</li>
                </ol>
            </nav>
        </div>

        <div class="row">
            <div class="col-9">
                <div class="card-shadow-alternate card-border mb-3 card p-4">
                    <h3>Edit Theme</h3>
                    <form action="{{route('update_theme',['fase_id'=>$theme->fase_id,'id' => $theme->id])}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{$theme->name}}" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea type="text" class="form-control" id="description" name="description" required>{{$theme->description}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="sysnum">SystemNumber</label>
                            <input type="number" class="form-control" id="sysnum" name="sysnum" value="{{$theme->sysnum}}" required>
                        </div>
                        <button type="submit" class="btn btn-primary float-right">Save</button>
                    </form>

                </div>
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
@endsection
