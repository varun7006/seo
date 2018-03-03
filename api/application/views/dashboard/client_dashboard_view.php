<section id="main" class="container-fluid">
    <div class="row">
        <section id="content-wrapper" class="form-elements">
            <div class="site-content-title">
                <h2 class="float-xs-left content-title-main">Dashboard</h2>
                <ol class="breadcrumb float-xs-right">
                    <li class="breadcrumb-item">
                        <span class="fs1" aria-hidden="true" data-icon=""></span>
                        <a href="#">Home</a>
                    </li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </div>
            <div class="contain-inner dashboard_v4-page">
                <div class="row">
                    <div class="dashboard_v4_box_block" >
                        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="content" ui-sref=sources>
                                <div class="dashboard_v4_box_icon float-xs-left warning_box">
                                    <i class="fa fa-envelope"></i>
                                </div>
                                <div class="dashboard_v4_box_title float-xs-right">
                                    <h4>{{ sourceCount}}</h4>
                                    <p>Total Sources</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="content" ui-sref=project>
                                <div class="dashboard_v4_box_icon float-xs-left success_box">
                                    <i class="fa fa-file-text"></i>
                                </div>
                                <div class="dashboard_v4_box_title float-xs-right">
                                    <h4>{{ projectCount }}</h4>
                                    <p>Total projects</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>
</section>


