<div class="col-md-4">
    <ul class="nav nav-pills nav-stacked">
        <li {{ active(['category.all*']) }}>
            <a href="{{ route('category.all') }}">List all</a>
        </li>
        <li {{ active(['category.new*']) }}>
            <a href="{{ route('category.new') }}">Add new category</a>
        </li>
    </ul>
</div>
