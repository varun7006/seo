
<section id="main" class="container-fluid">
    <div class="row">
        <section id="content-wrapper" class="form-elements">
            <div class="site-content-title">
                <h2 class="float-xs-left content-title-main">Clients</h2>
                <ol class="breadcrumb float-xs-right">
                    <li class="breadcrumb-item">
                        <span class="fs1" aria-hidden="true" data-icon=""></span>
                        <a href="#">Home</a>
                    </li>
                    <li class="breadcrumb-item"><a href="#">Users</a></li>
                    <li class="breadcrumb-item active">User List</li>
                </ol>
            </div>
            <div class="contain-inner dashboard_v4-page">
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="content dashboard_v4_project_list">
                            <div class="dashboard-content">
                                <div class="dashboard-header">
                                    <h4 class="page-content-title float-xs-left">Add New Client </h4>
                                </div>
                                <div class="dashboard-box">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <form name="signupForm">
                                                <div class="all-form-section">
                                                    <div class="row">
                                                        <div class="element-form">
                                                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 text-xs-right"><label>Name</label></div>
                                                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="exampleInputuname_3" ng-model="user.name" placeholder="Name" ng-pattern="/^[A-Za-z ]*$/" >
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="element-form">
                                                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 text-xs-right"><label>Email</label></div>
                                                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                                <div class="form-group">
                                                                    <input type="email" class="form-control" id="exampleInputEmail_3" name="email" ng-model="user.email" placeholder="Enter email" ng-pattern = "/^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/">
                                                                </div>
                                                                <span style="color:Red" ng-show="signupForm.email.$dirty && signupForm.email.$error.pattern">Please Enter Valid Email</span>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="element-form">
                                                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 text-xs-right"><label>Phone No</label></div>
                                                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="exampleInputweb_31" ng-model="user.mobile_no" placeholder="Enter Mobile No"  >
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="element-form">
                                                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 text-xs-right"><label>Address</label></div>
                                                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="exampleInputweb_31" ng-model="user.address" placeholder="Enter Address">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="element-form">
                                                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 text-xs-right"><label>Website</label></div>
                                                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="exampleInputweb_31" ng-model="user.website" placeholder="Enter Website Name">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="element-form">
                                                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 text-xs-right"><label>Comment</label></div>
                                                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                                <div class="form-group">
                                                                    <textarea class="form-control" rows="2" ng-model="user.comment"></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="element-form">
                                                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 text-xs-right"><label>Password</label></div>
                                                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                                <div class="form-group">
                                                                    <input type="password" class="form-control" id="exampleInputpwd_32" ng-model="user.password" placeholder="Enter pwd">

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="element-form">
                                                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 text-xs-right"><label>Re-Password</label></div>
                                                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                                <div class="form-group">
                                                                    <input type="password" class="form-control" id="exampleInputpwd_4" ng-model="user.repassword" placeholder="Re Enter pwd">

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="element-form">
                                                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 text-xs-right">
                                                                <button class="btn btn-info btn-success" ng-disabled="user.name=='' || user.email=='' || user.website==''" ng-click="saveType == 'SAVE' ? saveNewUserDetails() : updateUserDetails()">{{ saveType}}</button>
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

