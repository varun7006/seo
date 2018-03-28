<section id="main" class="container-fluid">
    <div class="row">
        <section id="content-wrapper" class="form-elements">
            <div class="site-content-title">
                <h2 class="float-xs-left content-title-main">Project</h2>
                <ol class="breadcrumb float-xs-right">
                    <li class="breadcrumb-item">
                        <span class="fs1" aria-hidden="true" data-icon=""></span>
                        <a ui-sref="dashboard">Home</a>
                    </li>
                    <li class="breadcrumb-item"><a ui-sref="project">Projects</a></li>
                    <li class="breadcrumb-item active">Add Project</li>
                </ol>
            </div>
            <div class="contain-inner dashboard_v4-page">
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="content dashboard_v4_project_list">
                            <div class="dashboard-content">
                                <div class="dashboard-header">
                                    <h4 class="page-content-title float-xs-left">Add New Project </h4>
                                </div>
                                <div class="dashboard-box">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <form name="signupForm">
                                                <div class="all-form-section">
                                                    <div class="row">
                                                        <div class="element-form">
                                                            <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12 col-xs-12 text-xs-right"><label>Project Name</label></div>
                                                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="exampleInputuname_3" ng-model="project.project_name" placeholder="Name" >
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php if ($this->session->userdata("user_type") == 'ADMIN') { ?>
                                                        <div class="row">
                                                            <div class="element-form">
                                                                <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12 col-xs-12 text-xs-right"><label>Choose Client</label></div>
                                                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                                    <div class="form-group">
                                                                        <select class="form-control" data-placeholder="Choose Client" ng-model="project.client_id">
                                                                            <option value="">Select</option>
                                                                            <option ng-repeat="user in userList track by $index" ng-selected="project.client_id == source.user_id" value="{{user.id}}">{{user.name}}</option>
                                                                        </select>
                                                                    </div>
                                                                    <!--<span style="color:Red" ng-show="signupForm.email.$dirty && signupForm.email.$error.pattern">Please Enter Valid Date</span>-->

                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php } ?>
                                                    <div class="row">
                                                        <div class="element-form">
                                                            <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12 col-xs-12 text-xs-right"><label>Note</label></div>
                                                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                                <div class="form-group">
                                                                    <textarea class="form-control" rows="2" ng-model="project.comment"></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="element-form">
                                                            <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12 col-xs-12 text-xs-right">
                                                                <button class="btn btn-info btn-success" ng-disabled="project.project_name == ''" ng-click="saveType == 'SAVE' ? saveNewProjectDetails() : updateProjectDetails()">Add</button>
                                                            </div>

                                                        </div
                                                    </div>
                                                </div>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
</div>
</section>

