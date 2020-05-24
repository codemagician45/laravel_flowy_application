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
                        {{--Fase--}}
                        @if($data->user_id && !$data->fase_id)
                        <a href="{{route('themes',['fase_id' => $data->id])}}" class="text-decoration-none text-body">
                            <div class="card-body">
                                <h5 class="card-title">{{$data->name}}</h5>
                                <p class="pt-max mb-0">{{$data->description}}</p>
                            </div>
                        </a>
                        @endif
                        {{--Theme--}}
                        @if($data->fase_id && !$data->theme_id)
                            <a href="{{route('processes',['fase_id' => $data->fase_id,'theme_id' => $data->id])}}" class="text-decoration-none text-body">
                                <div class="card-body">
                                    <h5 class="card-title">{{$data->name}}</h5>
                                    <p class="pt-max mb-0">{{$data->description}}</p>
                                </div>
                            </a>
                        @endif
                        {{--Process--}}
                        @if($data->theme_id && $data->fase_id)
                            <a href="{{route('process_show_flowchart',['fase_id' => $data->fase_id,'theme_id' => $data->theme_id,'id'=>$data->id])}}" class="text-decoration-none text-body">
                                <div class="card-body">
                                    <h5 class="card-title">{{$data->name}}</h5>
                                    <p class="pt-max mb-0">{{$data->description}}</p>
                                    <p class="pt-max mt-2 float-right">Last updated: {{$data->updated_at->format('d-m-Y H:i')}}</p>
                                </div>
                            </a>
                        @endif
                    </div>
                    {{--Fase Edit/Delete--}}
                    @if($data->user_id && !$data->fase_id)
                    <div class="col-1">
                        <a href="{{route('edit_phase',['id' => $data->id])}}">
                            <i class="metismenu-icon pe-7s-eyedropper pt-3 pl-1 font-size-xlg"></i>
                        </a>
                        <a href="{{route('delete_phase',['id' => $data->id])}}" onclick="return confirm('Are you sure you want to delete this Fase (and his children)?')">
                            <i class="metismenu-icon pe-7s-trash pt-3 pr-1  font-size-xlg"></i>
                        </a>
                    </div>
                    @endif
                    {{--Theme Edit/Delete--}}
                    @if($data->fase_id && !$data->theme_id)
                        <div class="col-1">
                            <a href="{{route('edit_theme',['fase_id'=>$data->fase_id, 'id' => $data->id])}}">
                                <i class="metismenu-icon pe-7s-eyedropper pt-3 pl-1 font-size-xlg"></i>
                            </a>
                            <a href="{{route('delete_theme',['fase_id'=>$data->fase_id,'id' => $data->id])}}" onclick="return confirm('Are you sure you want to delete this Theme (and his children)?')">
                                <i class="metismenu-icon pe-7s-trash pt-3 pr-1  font-size-xlg"></i>
                            </a>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    @endforeach
</div>
