@foreach($items as $item)
    @if($item instanceof RoachPHP\ItemPipeline\Item)
        <div>
            <h3>{{ $item->$data['title'] }}</h3>
            <p>{{ $item->data['subtitle'] }}</p>
        </div>
    @endif
@endforeach
