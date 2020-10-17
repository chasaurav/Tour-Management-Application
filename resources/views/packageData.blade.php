@foreach ($packages as $package)
<div class="card">
    @if ($package->tag)
    <span class="ribbon">{{ $package->tag }}</span>
    @endif
    <div class="cardLeft"
        style="background: url('./storage/{{ $package->image }}'); background-size: cover; background-position: center; background-repeat: no-repeat;">
    </div>
    <div class="cardRight">
        <h4>{{ $package->title }} ({{ $package->code }})</h4>
        <p>{{ $package->nights }} Nights → {{ $package->days }} Days</p>
        <p>{{ substr($package->description, 0, 250)."..." }}</p>
        <p>
            @if ($package->hotel === 'true')
            <i title="Hotel Stay" class="fa fa-building" aria-hidden="true"></i>
            @endif
            @if ($package->trans === 'true')
            <i title="Transportation" class="fa fa-car" aria-hidden="true"></i>
            @endif
            @if ($package->meal === 'true')
            <i title="Meals" class="fa fa-cutlery" aria-hidden="true"></i>
            @endif
            @if ($package->sight === 'true')
            <i title="Sightseening" class="fa fa-street-view" aria-hidden="true"></i>
            @endif
        </p>
        <p><strong>Starts With :</strong> <span
                style="color: #bf8a11; font-weight: 600; font-size: 1.8em; letter-spacing: 3px;">Rs.
                {{ number_format($package->rate, 2)}}/-</span> <br> Per Person* (Min
            {{ $package->minPax }} Pax)</p>
        <button type="button" name="getQuote" id="getQuote" class="getQuote" value="{{ $package->id }}">Get
            Quote</button>
    </div>
</div>
@endforeach
