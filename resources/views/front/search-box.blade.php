<form action="{{route('search_by_data')}}">
@csrf()
<!-- mid row 1 -->
<div class="mid-row-1">
    <div class="input-group d-flex align-items-center my-2">
        <span class="input-group-text">Search Car</span>
        <input name="sdata" type="text" id="item_search" class="form-control ui-autocomplete-input"/>
        <button type="submit" class="input-group-text"><i class="bi bi-search"></i></button>
    </div>
</div>
</form>