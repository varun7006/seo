<header id="header"  ng-controller="headerCtrl">
    <div class="row">
        <div class="col-sm-4 col-xl-2 header-left">
            <div class="logo float-xs-left">
                <a class="left-menu-toggle float-xs-right" ><img src="assets/global/image/web-logo.png" alt="logo"></a>
            </div>
            <a id="navtoggle" class="animated-arrow" ng-click="addCustomClass();"><span></span></a>
        </div>
        <div class="col-sm-8 col-xl-10 header-right">
            <div class="header-inner-right">
                <div class="user-dropdown">
                    <div class="btn-group">
                        <a  class="user-header dropdown-toggle" data-toggle="dropdown" data-animation="slideOutUp" aria-haspopup="true" aria-expanded="false">
                            <img src="assets/global/image/User_Avatar.png" alt="Profile image" />
                        </a>
                        <div class="dropdown-menu drop-profile">
                            <div class="userProfile">
                                <img src="assets/global/image/User_Avatar.png" alt="Profile image" />
                                <h5>{{ loginName }}</h5>
                                <p>{{ loginEmail }}</p>
                            </div>
                            <div class="dropdown-divider"></div>

                            <a class="btn btn-primary float-xs-right right-spacing" ng-click="logout()" role="button">Logout</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<aside id="sidebar">
    <div class="sidebar-menu">
        <?php 
        if ($this->session->userdata("user_type") == 'ADMIN') {?>
            <ul class="nav site-menu" id="site-menu">
                <li class="sub-item">
                    <a ui-sref=dashboard>
                        <i class="icon_desktop"></i>
                        <span>Dashboard </span>
                    </a>
                </li>
                <li class="sub-item">
                    <a href="javascript:void(0)" ui-sref=users>
                        <i class="icon_id"></i>
                        <span>Client</span>
                    </a>
                    <ul class="sub-menu">
                        <li class="menu-title"><span>Client</span></li>
                        <li>
                            <a ui-sref=users>View Clients</a>
                        </li>
                        <li>
                            <a ui-sref=addusers>Add Clients</a>
                        </li>
                    </ul>
                </li>
                <li class="sub-item">
                    <a href="javascript:void(0)" ui-sref=sources>
                        <i class="icon_tags_alt"></i>
                        <span>Sources</span>
                    </a>
                    <ul class="sub-menu">
                        <li class="menu-title"><span>Sources</span></li>
                        <li>
                            <a ui-sref=sources>View Sources</a>
                        </li>
                        <li>
                            <a ui-sref=addsources>Add Sources</a>
                        </li>
                        <li>
                            <a ui-sref=brokensources>Broken Sources</a>
                        </li>
                    </ul>
                </li>
                <li class="sub-item">
                    <a href="javascript:void(0)" ui-sref=project>
                        <i class="icon_ribbon_alt"></i>
                        <span>Project</span>
                    </a>
                    <ul class="sub-menu">
                        <li class="menu-title"><span>Project</span></li>
                        <li>
                            <a ui-sref=project>View Project</a>
                        </li>
                        <li>
                            <a ui-sref=addprojectview>Add Project</a>
                        </li>
                    </ul>
                </li>
                <li class="sub-item">
                    <a href="javascript:void(0)" ui-sref=composemail>
                        <i class="icon_mail_alt"></i>
                        <span>Mail</span>
                    </a>
<!--                    <ul class="sub-menu">
                        <li class="menu-title"><span>Mail</span></li>
                        <li>
                            <a ui-sref=composemail>Compose</a>
                        </li>
                        <li>
                            <a ui-sref=inbox>Inbox</a>
                        </li>
                    </ul>-->
                </li>
                <li class="sub-item">
                    <a href="javascript:void(0)">
                        <i class="icon_wallet"></i>
                        <span>Settings</span>
                    </a>
                    <ul class="sub-menu">
                        <li class="menu-title"><span>Settings</span></li>
                        <li>
                            <a ui-sref=viewlinktype>View Link Types</a>
                        </li>
                        <li>
                            <a ui-sref=topics>Topics</a>
                        </li>
                    </ul>
                </li>
            </ul>
        <?php } else { ?>
            <ul class="nav site-menu" id="site-menu">
                <li class="sub-item">
                    <a ui-sref=dashboard>
                        <i class="icon_desktop"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
               
            </ul>
            <?php }
        ?>
    </div>
</aside>
