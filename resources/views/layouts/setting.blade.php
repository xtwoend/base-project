<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
        <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
        <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
        <!-- Home tab content -->
        <div class="tab-pane" id="control-sidebar-home-tab">
            
        </div>
        <!-- /.tab-pane -->

        <!-- Settings tab content -->
        <div class="tab-pane" id="control-sidebar-settings-tab">
            <ul class="sidebar-menu" data-widget="tree">
                <li>
                    <a href="{{ route('setting.design') }}">
                        <i class="fa fa-flask"></i> <span>Design</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('setting.navigation') }}">
                        <i class="fa fa-sitemap"></i> <span>Navigation</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('setting.users.index') }}">
                        <i class="fa fa-users"></i> <span>Users</span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- /.tab-pane -->
    </div>
</aside>
<!-- /.control-sidebar -->