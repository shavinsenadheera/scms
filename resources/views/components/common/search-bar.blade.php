<form method="get" action="{{route($route)}}">
    <div class="input-group no-border">
        <input
            type="text"
            value="{{ $searchVal }}"
            name="query"
            class="form-control"
            placeholder="Search..."
        >
        <button type="submit" class="btn btn-primary">
            <i class="material-icons">Search</i>
            <div class="ripple-container"></div>
        </button>
    </div>
</form>
