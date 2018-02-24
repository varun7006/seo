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
                <div class="float-default searchbox">
                    <div class="right-icon">
                        <a href="javascript:void(0)">
                            <i class="icon_search"></i>
                        </a>
                    </div>
                </div>

                <div class="user-dropdown">
                    <div class="btn-group">
                        <a  class="user-header dropdown-toggle" data-toggle="dropdown" data-animation="slideOutUp" aria-haspopup="true" aria-expanded="false">
                            <img src="assets/global/image/user.jpg" alt="Profile image" />
                        </a>
                        <div class="dropdown-menu drop-profile">
                            <div class="userProfile">
                                <img src="assets/global/image/user.jpg" alt="Profile image" />
                                <h5>Miler Hussey</h5>
                                <p>milerhussey@yahoo.com</p>
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
<div class="search-overlay " >
    <div class="float-default search">
        <div class="search_bg"></div>
        <div class="right-icon search_box">
            <div class="search-div">
                <input type="text" class="search_input">
                <label class="search-input-label">
                    <span class="input-label-title">Search</span>
                </label>
            </div>
            <div class="divider50"></div>
            <div class="search-result">
                <div class="search-item">
                    <div class="search-image float-xs-left">
                        <img src="assets/global/image/guitar.jpg" alt="search-image">
                    </div>
                    <div class="search-info float-xs-right">
                        <h3 class="title">Search here</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse faucibus diam quis arcu lobortis sagittis. Etiam eu ornare mi. Interdum et malesuada fames ac ante ipsum primis in faucibus.</p>
                    </div>
                </div>
                <div class="divider15"></div>
                <div class="search-item">
                    <div class="search-info search-full float-xs-right">
                        <h3 class="title">Admin templates</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse faucibus diam quis arcu lobortis sagittis. Etiam eu ornare mi. Interdum et malesuada fames ac ante ipsum primis in faucibus.</p>
                    </div>
                </div>
                <div class="divider15"></div>
                <div class="search-item">
                    <div class="search-image float-xs-left">
                        <img src="assets/global/image/book-flower.jpg" alt="search-image">
                    </div>
                    <div class="search-info float-xs-right">
                        <h3 class="title">Books</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse faucibus diam quis arcu lobortis sagittis. Etiam eu ornare mi. Interdum et malesuada fames ac ante ipsum primis in faucibus.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="search_close icon_close"></div>
    </div>
</div>
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
                        <i class="icon_tags_alt"></i>
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
                        <i class="icon_tags_alt"></i>
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
                    <a href="javascript:void(0)">
                        <i class="icon_tags_alt"></i>
                        <span>Contact</span>
                    </a>
                    <ul class="sub-menu">
                        <li class="menu-title"><span>Contact</span></li>
                        <li>
                            <a ui-sref=inbox>Contact List</a>
                        </li>
                    </ul>
                </li>
                <li class="sub-item">
                    <a href="javascript:void(0)">
                        <i class="icon_tags_alt"></i>
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
