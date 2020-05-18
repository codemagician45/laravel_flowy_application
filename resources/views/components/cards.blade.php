<div class="row">
    @foreach($datas as $data)
        <div {{ $attributes }}>
            <div class="main-card mb-4 card card-hover-shadow-2x">
                <div class="row no-gutters overflow-hidden">
                    <div class="col-3 p-4 bg-sunny-morning d-flex align-items-center">
                        <span class="display-4" style="color: rgba(255,255,255,0.9)">{{ $data->sysnum }}.</span>
                        <div class="card-index__rondje"></div>
                    </div>
                    <div class="col-8 py-1">
                        @if($data->user_id)
                        <a href="{{route('themes',['fase_id' => $data->id])}}" class="text-decoration-none text-body">
                            <div class="card-body">
                                <h5 class="card-title">{{$data->name}}</h5>
                                <p class="pt-max mb-0">{{$data->description}}</p>
                            </div>
                        </a>
                        @endif
                        @if($data->fase_id)
                            <a href="{{route('processes',['fase_id' => $data->fase_id,'theme_id' => $data->id])}}" class="text-decoration-none text-body">
                                <div class="card-body">
                                    <h5 class="card-title">{{$data->name}}</h5>
                                    <p class="pt-max mb-0">{{$data->description}}</p>
                                </div>
                            </a>
                        @endif
                    </div>
                    @if($data->user_id)
                    <div class="col-1">
                        <a href="{{route('edit_phase',['id' => $data->id])}}">
                            <i class="metismenu-icon pe-7s-eyedropper pt-3 pl-1 font-size-xlg"></i>
                        </a>
                        <a href="{{route('delete_phase',['id' => $data->id])}}">
                            <i class="metismenu-icon pe-7s-trash pt-3 pr-1  font-size-xlg"></i>
                        </a>
                    </div>
                    @endif
                    @if($data->fase_id)
                        <div class="col-1">
                            <a href="{{route('edit_theme',['fase_id'=>$data->fase_id, 'id' => $data->id])}}">
                                <i class="metismenu-icon pe-7s-eyedropper pt-3 pl-1 font-size-xlg"></i>
                            </a>
                            <a href="{{route('delete_theme',['fase_id'=>$data->fase_id,'id' => $data->id])}}">
                                <i class="metismenu-icon pe-7s-trash pt-3 pr-1  font-size-xlg"></i>
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @endforeach
</div>