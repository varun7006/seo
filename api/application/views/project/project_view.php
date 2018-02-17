
<section id="main" class="container-fluid">

    <div class="row">
        <section id="content-wrapper" class="form-elements">
            <div class="site-content-title">
                <h2 class="float-xs-left content-title-main">Projects</h2>
                <ol class="breadcrumb float-xs-right">
                    <li class="breadcrumb-item">
                        <span class="fs1" aria-hidden="true" data-icon=""></span>
                        <a href="#">Home</a>
                    </li>
                    <li class="breadcrumb-item"><a href="#">Projects</a></li>
                    <li class="breadcrumb-item active">Project List</li>
                </ol>
            </div>
            <div class="contain-inner dashboard_v4-page" ng-if="showNewProject == true">
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
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
                                                                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 text-xs-right"><label>Project Name</label></div>
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
                                                                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 text-xs-right"><label>Choose Client</label></div>
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
                                                                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 text-xs-right"><label>Comment</label></div>
                                                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                                            <div class="form-group">
                                                                                <textarea class="form-control" rows="2" ng-model="project.comment"></textarea>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="element-form">
                                                                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 text-xs-right">
                                                                            <button class="btn btn-info btn-success" ng-disabled="project.project_name == ''" ng-click="saveType == 'SAVE' ? saveNewProjectDetails() : updateProjectDetails()">{{ saveType}}</button>
                                                                        </div>
                                                                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 text-xs-right">
                                                                            <button class="btn btn-info btn-danger"  ng-click="cancelProject({})">Cancel</button>
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
            </div>
    </div>
</div>
</section>

</div>
<div class="row">
    <section id="content-wrapper" class="form-elements">

        <div class="contain-inner dashboard_v4-page">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="content dashboard_v4_project_list">
                        <div class="dashboard-content">
                            <div class="dashboard-header">
                                <h4 class="page-content-title float-xs-left">Total {{ projectCount}} Project</h4>
                                <span style="float:right"><button type="button" class="btn btn-primary" ng-click="addNewProject()">Add New</button></span>
                                <span style="float:right;margin-right: 2%;"><button class="btn btn-warning" onclick="exportData('myDataTable', 'project.xls')">Export to Excel</button></span>
                                <!--<span style="float:right;margin-right: 2%;"><button type="button" class="btn btn-mini btn-success" data-toggle="modal" data-target="#defaultmodal">Upload Excel</button></span>-->
                            </div>
                            <div class="dashboard-box">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="col-md-4">

                                            <label class="sr-only">Search</label>
                                            <span style="margin:10% !important;"><input class="form-control" ng-model="searchfield" placeholder="Search" type="text"></span>

                                        </div>

                                        <div class="basic_table table-responsive">
                                            <div id="myDataTable">
                                                <table class="table table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th ng-click="orderByField = 'project_name'; reverseSort = !reverseSort" style="cursor: pointer !important;">Project Name
                                                                <span ng-show="orderByField == 'project_name'"><span ng-show="!reverseSort"><i class="fa fa-arrow-up "></i></span><span ng-show="reverseSort"><i class="fa fa-arrow-down "></i></span></span></span>
                                                            </th>
                                                            <th ng-click="orderByField = 'client_name'; reverseSort = !reverseSort" style="cursor: pointer !important;">Client Name
                                                                <span ng-show="orderByField == 'client_name'"><span ng-show="!reverseSort"><i class="fa fa-arrow-up "></i></span><span ng-show="reverseSort"><i class="fa fa-arrow-down "></i></span></span></span>
                                                            </th>
                                                            <th>Comment</th>
                                                            <th>Completed Links</th>
                                                            <th>Broken Links</th>
                                                            <th>All Source List</th>                                                       
                                                            <th>Action</th>
                                                        </tr>

                                                    </thead>
                                                    <tbody>
                                                        <tr ng-repeat="project in projectList| orderBy:orderByField:reverseSort | filter: searchfield track by $index">
                                                            <td>{{ $index + 1}}</td>
                                                            <td ng-click="editProject(project, $index)">
                                                                <span ng-hide="project.editMode == true">{{project.project_name}}</span>
                                                                <input type="text" name="firstName" ng-show="project.editMode" class="form-control" ng-model="project.project_name" placeholder="Project" required="" />
                                                            </td>
                                                            <td ng-click="editProject(project, $index)">
                                                                <span ng-hide="project.editMode">{{project.client_name}}</span>
                                                                <select ng-show="project.editMode" class="form-control" data-placeholder="Choose Client" ng-model="project.client_id">
                                                                    <option value="">Select</option>
                                                                    <option ng-repeat="user in userList track by $index"  ng-selected="user.id == project.client_id" value="{{user.id}}">{{user.name}}</option>
                                                                </select>
                                                            </td>
                                                            <td ng-click="editProject(project, $index)">
                                                                <span ng-hide="project.editMode">{{project.comment}}</span>
                                                                <input ng-show="project.editMode" type="text" name="firstName" ng-show="project.editMode" class="form-control" ng-model="project.comment" placeholder="Project" required="" />
                                                            </td>
                                                            <td>
                                                                <span ng-hide="project.editMode">{{project.completed_links}}</span>
                                                            </td>
                                                            <td>
                                                                <span ng-hide="project.editMode">{{project.broken_links}}</span>
                                                            </td>
                                                            <td>
                                                                <table style="background: none;">
                                                                    <tr ng-repeat="source in project.sourcedetails.sourcelist track by $index">
                                                                        <td>{{ source.source_link}}</td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                            <td>
                                                                <button ng-hide="project.editMode" class="btn btn-mini btn-success" ng-click="viewLinkStatusReport(project)" ><i class="fa fa-eye"></i></button>
                                                                <button ng-hide="project.editMode" class="btn btn-mini btn-primary" ng-click="editProject(project, $index)" ><i class="fa fa-edit"></i></button>
                                                                <button ng-hide="project.editMode" class="btn btn-mini btn-danger" ng-click="deleteProject(project.id, $index)" id="sa-warning"><i class="fa fa-close"></i></button>
                                                                <button ng-show="project.editMode" class="btn btn-xs btn-primary" ng-click="updateProjectDetails(project)" >Update</button>
                                                                <button ng-show="project.editMode" class="btn btn-xs btn-danger" ng-click="cancelProject(project)" id="sa-warning">Cancel</button>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
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

</div>
</section>


<div myModal class="modal fade" id="defaultmodal" tabindex="-1" role="dialog" aria-labelledby="defaultmodal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Upload Excel</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6 col-xs-12">
                        <div class="form-group file-control-upload">
                            <input ng-model="excelFile" style="height:35px;width:230px;padding:0px;" type="file" class="form-control  btn btn-success fileinput-button"  onchange="angular.element(this).scope().uploadedFile(this)">
                        </div>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary"  ng-click="saveExcelData()">Save</button>
            </div>
        </div>
    </div>
</div>