
<section id="main" class="container-fluid">
    <div class="row">
        <section id="content-wrapper" class="form-elements">
            <div class="site-content-title">
                <h2 class="float-xs-left content-title-main">Bucket</h2>
                <ol class="breadcrumb float-xs-right">
                    <li class="breadcrumb-item">
                        <span class="fs1" aria-hidden="true" data-icon=""></span>
                        <a href="#">Home</a>
                    </li>
                    <li class="breadcrumb-item"><a href="#">Bucket</a></li>
                    <li class="breadcrumb-item active">Bucket List</li>
                </ol>
            </div>
            <div class="contain-inner dashboard_v4-page">
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="content dashboard_v4_project_list">
                            <div class="dashboard-content">
                                <div class="dashboard-header">
                                    <h4 class="page-content-title float-xs-left">Add New Task </h4>
                                </div>
                                <div class="dashboard-box">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <form name="signupForm">
                                                <div class="all-form-section">
                                                    <div class="row">
                                                        <div class="element-form">
                                                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 text-xs-right"><label>Task Name</label></div>
                                                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="exampleInputuname_3" ng-model="task.task_name" placeholder="Name" >
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="element-form">
                                                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 text-xs-right"><label>Date</label></div>
                                                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                                <div class="form-group">
                                                                    <datepicker date-format="{{'dd-MM-yyyy'}}" style="height: 300px !important; width: 300px !important;" >
                                                                        <input class="form-control" type="text" ng-model="task.date"  style="text-align: center;color:black;font-size:12px  "/>
                                                                    </datepicker>
                                                                </div>
                                                                <!--<span style="color:Red" ng-show="signupForm.email.$dirty && signupForm.email.$error.pattern">Please Enter Valid Date</span>-->

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="element-form">
                                                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 text-xs-right">
                                                                <button class="btn btn-info btn-success" ng-disabled="task.task_name == '' || task.date == ''" ng-click="saveType == 'SAVE' ? saveNewTask() : updateUserDetails()">{{ saveType}}</button>
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

