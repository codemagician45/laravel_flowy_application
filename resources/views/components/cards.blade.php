<div class="row">
    @foreach($datas as $phase)
        <div {{ $attributes }}>
            <a href="{{$phase->route}}" class="text-decoration-none text-body">
                <div class="main-card mb-4 card card-hover-shadow-2x">
                    <div class="row no-gutters overflow-hidden">
                        <div class="col-3 p-4 bg-sunny-morning d-flex align-items-center">
                            <span class="display-4" style="color: rgba(255,255,255,0.9)">{{ $phase->index }}.</span>
                            <div class="card-index__rondje"></div>
                        </div>
                        <div class="col-9 py-1">
                            <div class="card-body">
                                <h5 class="card-title">{{$phase->title}}</h5>
                                <p class="pt-max mb-0">{{$phase->description}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    @endforeach
</div>