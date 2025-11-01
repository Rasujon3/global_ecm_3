@if(count($intros) > 0)
<div class="widget widget-icon-box mb-6">
    @foreach($intros as $intro)
        <div class="icon-box icon-box-side">
            <span class="icon-box-icon text-dark">
                <i class="{{ $intro->icon ?? '' }}"></i>
            </span>
            <div class="icon-box-content">
                <h4 class="icon-box-title">{{ $intro->title ?? '' }}</h4>
                <p>{{ $intro->description ?? '' }}</p>
            </div>
        </div>
    @endforeach
</div>
@endif
