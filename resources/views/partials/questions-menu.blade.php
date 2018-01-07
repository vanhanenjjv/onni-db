<div class="col-md-4">
    <ul class="nav nav-pills nav-stacked">
        <li {{ active(['question.all*']) }}>
            <a href="{{ route('question.all') }}">List all</a>
        </li>
        <li {{ active(['question.new*']) }}>
            <a href="{{ route('question.new') }}">Add new question</a>
        </li>
    </ul>
</div>
