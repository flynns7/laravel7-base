<div class="row" style="display:none;" id="form-role-manage">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Atur Menu</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool close-form-role-manage">
                        <i class="fas fa-times"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div class="container-fluid" id="list-menu-content">
                    <div class="row">
                        @foreach ($dataMenu['listFirstParent'] as $parent)
                            <div class="col-lg-4">
                                <div class="card">
                                    <div class="card-header bg-secondary">
                                        <h5 class="font-weight-bold">{{ $parent['name'] }}</h5>
                                    </div>
                                    <div class="card-body">
                                        @foreach ($dataMenu['listChildren'] as $child)
                                            @if ($child['pid'] == $parent['id'])
                                                @if (!empty($child['link']))
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="menu"
                                                            id="{{ $child['id'] }}" value="{{$child['id']}}">
                                                        <label class="form-check-label font-weight-bold"
                                                            for="{{ $child['id'] }}">
                                                            {{ $child['name'] }}
                                                        </label>
                                                    </div>
                                                @else
                                                    <label class="form-check-label font-weight-bold"
                                                        for="{{ $child['id'] }}">
                                                        - {{ $child['name'] }}
                                                    </label>
                                                    <div>
                                                        @foreach ($dataMenu['listChildren'] as $lastchild)
                                                            @if ($lastchild['pid'] == $child['id'])
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        name="menu" id="{{ $lastchild['id'] }}"
                                                                        value="{{$lastchild['id']}}">
                                                                    <label class="form-check-label"
                                                                        for="{{ $lastchild['id'] }}">
                                                                        {{ $lastchild['name'] }}
                                                                    </label>
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                @endif
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
