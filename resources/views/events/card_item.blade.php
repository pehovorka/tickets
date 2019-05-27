<div class="col-lg-4 d-flex align-items-stretch mb-3">
    <a href="/events/{{$event->id}}" style="text-decoration: none !important">
        <div class="card">
            <img src="/storage/cover_images/{{$event->img}}" class="card-img-top" alt="{{$event->name}}">
            <div class="card-img-overlay">
                @foreach ($event->event_category as $category)
                <span class="badge badge-secondary">{{$category->name}}</span> @endforeach
            </div>
            <div class="card-body">
                <h5 class="card-title text-black">{{$event->name}}</h5>
                <p class="card-text mb-0"><small class="text-muted">
                    @if($event->date_from == $event->date_to)
                        {{\Carbon\Carbon::parse($event->date_from)->format('d. m. Y')}}
                    @else
                        {{\Carbon\Carbon::parse($event->date_from)->format('d. m. Y')}} – {{\Carbon\Carbon::parse($event->date_to)->format('d. m. Y')}}
                    @endif    
                </small>
                </p>
                @if (isset($event->venue))
                    <p class="card-text text-muted">{{$event->venue->name}}</p>
                @endif
                <span class="btn btn-primary w-100">Více informací</span>
            </div>
        </div>
    </a>
</div>