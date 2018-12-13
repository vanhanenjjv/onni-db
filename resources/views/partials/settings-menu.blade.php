<div class="col-md-4">
    <ul class="nav nav-pills nav-stacked">
        <li {{ active(['settings.profile*']) }}>
            <a href="{{ route('settings.profile') }}">Profile</a>
        </li>
        <li {{ active(['settings.password*']) }}>
            <a href="{{ route('settings.password') }}">Change password</a>
        </li>
    </ul>
</div>
