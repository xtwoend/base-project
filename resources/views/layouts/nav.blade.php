<aside class="main-sidebar">
    <section class="sidebar">
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>
            <li class="active">
                <a href="{{ route('home') }}">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
            </li>

            @foreach(\App\Models\Navigation::tree() as $nav)
                <x-navigation :navigation="$nav"></x-navigation>
            @endforeach
            
            <li>
                <a href="#">
                    <i class="fa fa-info-circle"></i> <span>About</span>
                </a>
            </li>
        </ul>
    </section>
</aside>