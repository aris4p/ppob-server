<select name="dropdown_name" class="form-control">
    
    
    @foreach ($filteredResults as $results)
    @if ($results->brand === "AXIS")
        
    <option value="{{ $results->code }}">{{ $results->name }} - {{ $results->price->basic }}</option>
    @endif
    @endforeach
    
</select>

<select name="dropdown_name" class="form-control">
    
    
    @foreach ($filteredResults as $results)
    @if ($results->brand === "TRI")
        
    <option value="{{ $results->code }}">{{ $results->name }}</option>
    @endif
    @endforeach
    
</select>

<select name="dropdown_name" class="form-control">
    
    
    @foreach ($filteredResults as $results)
    @if ($results->brand === "BY.U")
        
    <option value="{{ $results->code }}">{{ $results->name }}</option>
    @endif
    @endforeach
    
</select>