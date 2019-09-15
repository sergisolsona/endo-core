@if ($cfParams)
    @foreach($cfParams as $param)
        @if (!is_array($param) && class_exists($param))
            @php($parametre = new $param(isset($customField) ? $customField : null))
            @php($parametre->setName('fields[' . (isset($customField) ? $customField->id : $order) .'][params]['. $parametre->getId() .']'))

            <div class="row">
                {!! $parametre->getField() !!}
            </div>
        @endif
    @endforeach
@endif