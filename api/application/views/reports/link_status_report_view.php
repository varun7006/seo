<style>
    .table td, .table th {
        padding: 5px;
    }
</style>
<div ng-if="isAjax == true"  id="loading-block"></div>
<section id="main" class="container-fluid">
    <section id="content-wrapper" class="form-elements">
        <div class="site-content-title">
            <h2 class="float-xs-left content-title-main">Link Status Report</h2>
            <ol class="breadcrumb float-xs-right">
                <li class="breadcrumb-item">
                    <span class="fs1" aria-hidden="true" data-icon=""></span>
                    <a ui-sref=dashboard>Home</a>
                </li>
                <li class="breadcrumb-item" ui-sref=project style="cursor: pointer"><a>Project</a></li>
                <li class="breadcrumb-item"><a>Link Report</a></li>
            </ol>

        </div>
        <div class="contain-inner dashboard_v4-page" ng-if="showNew == true">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="content dashboard_v4_project_list">
                        <div class="dashboard-content">
                            <div class="dashboard-header">
                                <h4 class="page-content-title float-xs-left">Add New Backlink</h4>
                            </div>
                            <div class="dashboard-box">
                                <div class="row">
                                    <div class="col-md-12">
                                        <form name="signupForm">
                                            <div class="all-form-section">
                                                <div class="row">
                                                    <div class="element-form">
                                                        <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12 col-xs-12 text-xs-right"><label>BackLink</label></div>
                                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                            <div class="form-group">
                                                                <input type="text" class="form-control" id="exampleInputuname_3" ng-model="source.backlink" placeholder="Enter Link Here" >
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="element-form">
                                                        <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12 col-xs-12 text-xs-right"><label>Date</label></div>
                                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                            <div class="form-group">
                                                                <div class="datepicker" date-format="{{'dd-MM-yyyy'}}" style="height: 50px !important; width: 300px !important;" >
                                                                    <input class="form-control" type="text" ng-model="source.date"  style="text-align: center;color:black;font-size:12px  "/>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <br>
                                                <br>

                                                <div class="row">
                                                    <div class="element-form">
                                                        <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12 col-xs-12 text-xs-right"><label>Anchor</label></div>
                                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                            <div class="form-group">
                                                                <input type="text" class="form-control" id="exampleInputweb_31" ng-model="source.anchor" placeholder="Enter Anchor">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="element-form">
                                                        <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12 col-xs-12 text-xs-right"><label>Email</label></div>
                                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                            <div class="form-group">
                                                                <input type="email" class="form-control" id="exampleInputEmail_3" name="email" ng-model="source.email" placeholder="Enter email" ng-pattern = "/^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/">
                                                            </div>
                                                            <span style="color:Red" ng-show="signupForm.email.$dirty && signupForm.email.$error.pattern">Please Enter Valid Email</span>

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="element-form">
                                                        <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12 col-xs-12 text-xs-right"><label>Name</label></div>
                                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                            <div class="form-group">
                                                                <input type="text" class="form-control" id="exampleInputweb_31" ng-model="source.name" placeholder="Enter Name"  >
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="element-form">
                                                        <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12 col-xs-12 text-xs-right"><label>Target Page</label></div>
                                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                            <div class="form-group">
                                                                <input type="text" class="form-control" id="exampleInputweb_31" ng-model="source.target_page" placeholder="Enter Target Page"  >
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="element-form">
                                                        <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12 col-xs-12 text-xs-right"><label>Link Type</label></div>
                                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                            <div class="form-group">
                                                                <select class="form-control" data-placeholder="Choose Link Type" ng-model="source.link_type">
                                                                    <option value="">Select</option>
                                                                    <option ng-repeat="links in linkTypes track by $index" ng-selected="links.id == source.link_type" value="{{links.id}}">{{ links.name | lowercase }}</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="element-form">
                                                        <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12 col-xs-12 text-xs-right"><label>Status</label></div>
                                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                            <div class="form-group">
                                                                <select class="form-control" data-placeholder="Choose Country" ng-model="source.link_status">
                                                                    <option value="">Select</option>
                                                                    <option value="FIRST APPROACH">first approach</option>
                                                                    <option value="SECOND APPROACH">second approach</option>
                                                                    <option value="OPEN">open</option>
                                                                    <option value="PROCCESSING">processing</option>
                                                                    <option value="COMPLETED">completed</option>


                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="element-form">
                                                        <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12 col-xs-12 text-xs-right"><label>Note</label></div>
                                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                            <div class="form-group">
                                                                <textarea class="form-control" rows="2" ng-model="source.remarks"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="element-form">
                                                        <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12 col-xs-12 text-xs-right">
                                                            <button class="btn btn-info btn-success" ng-click="saveType == 'SAVE' ? saveNewLinkReportDetails() : updateLinkReportDetails()">{{ saveType == 'SAVE' ? 'Add' : saveType }}</button>
                                                        </div>
                                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                            <button class="btn btn-info btn-danger" ng-click="cancelLinkReport({})">Cancel</button>
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

    <section id="content-wrapper" class="form-elements">
        <div class="row" ng-show="showAlert == true">
            <div class="col-xs-2"></div>
            <div class="col-xs-8">
                <div class="alert-dark-background">
                    <div class="alert {{ alertClass}} alert-dismissible fade in" role="alert">
                        <button type="button" class="close" ng-click="hideAlert()">
                            <span >×</span>
                        </button>
                        <i class="fa {{ alertIcon}}"></i><strong></strong>{{ alertText}}
                    </div>
                </div>
            </div>
            <div class="col-xs-2"></div>
        </div>
        <div class="contain-inner dashboard_v4-page">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="content dashboard_v4_project_list">
                        <div class="dashboard-content">
                            <div class="dashboard-header">
                                <h4 class="page-content-title float-xs-left">{{ mainProject}}</h4>
                                <span style="float:right"><button type="button" class="btn btn-primary" ng-click="addNewSource()">Add New</button></span>
                                <span style="float:right;margin-right: 2%;"><a href="api/index.php/reports/getlinkstatusexcel/{{ project_id}}" target="_blank"><button class="btn btn-warning">Export to Excel</button></a></span>
                            </div>
                            <div class="dashboard-box">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="col-md-4">
                                            <label class="sr-only">Search</label>
                                            <span style="margin:10% !important;"><input class="form-control" ng-model="searchfield" placeholder="Search" type="text"></span>
                                        </div>

                                        <div class="col-md-4 col-sm-12 col-xs-12">
                                            <div class="element-form">
                                                <div class="form-group">
                                                    <ui-select tagging tagging-label="('new')" ng-model="selectedProject" ng-change="changeProject(selectedProject)" theme="bootstrap" style="width: 200px;border:1px solid rgba(0, 0, 0, 0.15) !important; margin-top: 6%;" title="Change Project">
                                                        <ui-select-match placeholder="Change Project">{{$select.selected.project_name}}</ui-select-match>
                                                        <ui-select-choices repeat="project in projectList | filter:$select.search">
                                                            {{project.project_name}}
                                                            <!--<div ng-bind-html="project | highlight: $select.search"></div>-->
                                                        </ui-select-choices>
                                                    </ui-select>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="myDataTable" class="basic_table table-responsive">
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr >
                                                        <th>#</th>
                                                        <th ng-click="orderByField = 'date'; reverseSort = !reverseSort" style="cursor: pointer !important; width: 150px  !important;">Date
                                                            <span ng-show="orderByField == 'date'"><span ng-show="!reverseSort"><i class="fa fa-arrow-up "></i></span><span ng-show="reverseSort"><i class="fa fa-arrow-down "></i></span></span></span>
                                                        </th>
                                                        <th ng-click="orderByField = 'completed_date'; reverseSort = !reverseSort" style="cursor: pointer !important;width: 150px  !important;">Completed Date
                                                            <span ng-show="orderByField == 'completed_date'"><span ng-show="!reverseSort"><i class="fa fa-arrow-up "></i></span><span ng-show="reverseSort"><i class="fa fa-arrow-down "></i></span></span></span>
                                                        </th>
                                                        <th ng-click="orderByField = 'link_status'; reverseSort = !reverseSort" style="cursor: pointer !important;width: 150px  !important;">Link Status
                                                            <span ng-show="orderByField == 'link_status'"><span ng-show="!reverseSort"><i class="fa fa-arrow-up "></i></span><span ng-show="reverseSort"><i class="fa fa-arrow-down "></i></span></span></span>
                                                        </th>
                                                        <th ng-click="orderByField = 'backlink'; reverseSort = !reverseSort" style="cursor: pointer !important;width: 150px  !important;">BackLink
                                                            <span ng-show="orderByField == 'backlink'"><span ng-show="!reverseSort"><i class="fa fa-arrow-up "></i></span><span ng-show="reverseSort"><i class="fa fa-arrow-down "></i></span></span></span>
                                                        </th>
                                                        <th ng-click="orderByField = 'anchor'; reverseSort = !reverseSort" style="cursor: pointer !important;width: 150px  !important;">Anchor
                                                            <span ng-show="orderByField == 'anchor'"><span ng-show="!reverseSort"><i class="fa fa-arrow-up "></i></span><span ng-show="reverseSort"><i class="fa fa-arrow-down "></i></span></span></span>
                                                        </th>
                                                        <th ng-click="orderByField = 'target_page'; reverseSort = !reverseSort" style="cursor: pointer !important;width: 150px  !important;">Target Page
                                                            <span ng-show="orderByField == 'target_page'"><span ng-show="!reverseSort"><i class="fa fa-arrow-up "></i></span><span ng-show="reverseSort"><i class="fa fa-arrow-down "></i></span></span></span>
                                                        </th>
                                                        <th ng-click="orderByField = 'name'; reverseSort = !reverseSort" style="cursor: pointer !important;width: 150px  !important;">Name
                                                            <span ng-show="orderByField == 'name'"><span ng-show="!reverseSort"><i class="fa fa-arrow-up "></i></span><span ng-show="reverseSort"><i class="fa fa-arrow-down "></i></span></span></span>
                                                        </th>
                                                        <th ng-click="orderByField = 'email'; reverseSort = !reverseSort" style="cursor: pointer !important;width: 150px  !important;">Email
                                                            <span ng-show="orderByField == 'email'"><span ng-show="!reverseSort"><i class="fa fa-arrow-up "></i></span><span ng-show="reverseSort"><i class="fa fa-arrow-down "></i></span></span></span>
                                                        </th>
                                                        <th ng-click="orderByField = 'link_type_name'; reverseSort = !reverseSort" style="cursor: pointer !important;width: 150px  !important;">Link Type
                                                            <span ng-show="orderByField == 'link_type_name'"><span ng-show="!reverseSort"><i class="fa fa-arrow-up "></i></span><span ng-show="reverseSort"><i class="fa fa-arrow-down "></i></span></span></span>
                                                        </th>
                                                        <th ng-click="orderByField = 'remarks'; reverseSort = !reverseSort" style="cursor: pointer !important;width: 150px  !important;">Note
                                                            <span ng-show="orderByField == 'remarks'"><span ng-show="!reverseSort"><i class="fa fa-arrow-up "></i></span><span ng-show="reverseSort"><i class="fa fa-arrow-down "></i></span></span></span>
                                                        </th>
                                                        <th>
                                                            Action
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr ng-repeat="sources in sourceReport| orderBy:orderByField:reverseSort |  filter: searchfield track by $index">
                                                        <td>{{ $index + 1}}</td>
                                                        <td ng-click="editSource(sources, $index)" style="width: 150px  !important;"><span ng-hide="sources.editMode">{{ sources.date | date : 'dd-MM-yyyy'}}</span>
                                                            <div ng-show="sources.editMode" class="datepicker" date-format="{{'dd-MM-yyyy'}}" style="height: 50px !important; width: 100px !important;" >
                                                                <input class="form-control" type="text" ng-model="sources.date"  style="text-align: center;color:black;font-size:12px  "/>
                                                            </div>
                                                        </td>
                                                        <td style="width: 150px  !important;" ng-click="editSource(sources, $index)"><span ng-hide="sources.editMode">{{ sources.completed_date | date : 'dd-MM-yyyy'}}</span>
                                                            <div ng-show="sources.editMode" class="datepicker" date-format="{{'dd-MM-yyyy'}}" style="height: 50px !important; width: 100px !important;" >
                                                                <input class="form-control" type="text" ng-model="sources.completed_date"  style="text-align: center;color:black;font-size:12px  "/>
                                                            </div>
                                                        </td>
                                                        <td style="width: 150px  !important;" ng-click="editSource(sources, $index)"><span ng-hide="sources.editMode">{{ sources.link_status | lowercase }}</span>
                                                            <select class="form-control" data-placeholder="Choose Country" ng-show="sources.editMode" ng-model="sources.link_status">
                                                                <option value="">Select</option>
                                                                <option ng-selected="sources.link_status == 'FIRST APPROACH'" value="FIRST APPROACH">first approach</option>
                                                                <option ng-selected="sources.link_status == 'SECOND APPROACH'" value="SECOND APPROACH">second approach</option>
                                                                <option ng-selected="sources.link_status == 'OPEN'" value="OPEN">open</option>
                                                                <option ng-selected="sources.link_status == 'PROCCESSING'" value="PROCCESSING">processing</option>
                                                                <option ng-selected="sources.link_status == 'COMPLETED'" value="COMPLETED">completed</option>
                                                            </select>
                                                        </td>
                                                        <td style="width: 150px  !important;" ng-click="editSource(sources, $index)" title="{{ sources.backlink}}"><span ng-hide="sources.editMode"><span style="color:{{sources.live_status !='ONLINE' ? 'Red' : 'Black' }}">{{ sources.backlink | limitTo: 20 }}{{sources.backlink > 40 ? '...' : ''}}</span></span>
                                                            <input type="text" ng-show="sources.editMode" class="form-control" id="exampleInputuname_3" ng-model="sources.backlink" >
                                                        </td>
                                                        <td style="width: 150px  !important;" ng-click="editSource(sources, $index)"><span ng-hide="sources.editMode">{{ sources.anchor}}</span>
                                                            <input type="text" ng-show="sources.editMode" class="form-control" id="exampleInputuname_3" ng-model="sources.anchor"  >
                                                        </td>
                                                        <td style="width: 150px  !important;" ng-click="editSource(sources, $index)"><span ng-hide="sources.editMode">{{ sources.target_page}}</span>
                                                            <input type="text" ng-show="sources.editMode" class="form-control" id="exampleInputuname_3" ng-model="sources.target_page" >
                                                        </td>
                                                        <td style="width: 150px  !important;" ng-click="editSource(sources, $index)"><span ng-hide="sources.editMode">{{ sources.name}}</span>
                                                            <input type="text" ng-show="sources.editMode" class="form-control" id="exampleInputuname_3" ng-model="sources.name" >
                                                        </td>
                                                        <td style="width: 150px  !important;" ng-click="editSource(sources, $index)"><span ng-hide="sources.editMode" title="{{  sources.email}}">{{ sources.email | limitTo: 20 }}</span>
                                                            <input type="text" ng-show="sources.editMode" class="form-control" id="exampleInputuname_3" ng-model="sources.email" >
                                                        </td>
                                                        <td style="width: 150px  !important;" ng-click="editSource(sources, $index)"><span ng-hide="sources.editMode">{{ sources.link_type_name | lowercase }}</span>
                                                            <select class="form-control" data-placeholder="Choose Country" ng-show="sources.editMode" ng-model="sources.link_type">
                                                                <option value="">Select</option>
                                                                <option ng-repeat="linkType in linkTypes track by $index" value="{{ linkType.id }}"  ng-selected="sources.link_type == linkType.id">{{ linkType.name }}</option>
                                                              
                                                            </select>
                                                        </td>
                                                        <td style="width: 150px  !important;" ng-click="editSource(sources, $index)" title="{{ sources.remarks}}"><span ng-hide="sources.editMode">{{ sources.remarks | limitTo: 20 }}</span>
                                                            <input type="text" ng-show="sources.editMode" class="form-control" id="exampleInputuname_3" ng-model="sources.remarks" >
                                                        </td>
                                                        <td>
                                                            <button style="padding:5px 5px !important;" ng-hide="sources.editMode" class="btn btn-mini btn-primary" ng-click="editSource(sources, $index)" ><i class="fa fa-edit"></i></button>
                                                            <button style="padding:5px 5px !important;" ng-hide="sources.editMode" class="btn btn-mini btn-danger" ng-click="deleteSourceBacklink(sources.id, $index)" id="sa-warning"><i class="fa fa-close"></i></button>
                                                            <button style="padding:5px 5px !important;" ng-show="sources.editMode" class="btn btn-xs btn-primary" ng-click="updateSourceDetails(sources)" >Update</button>
                                                            <button style="padding:5px 5px !important;" ng-show="sources.editMode" class="btn btn-xs btn-danger" ng-click="cancelLinkReport(sources)" id="sa-warning">Cancel</button>
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
    </section>

</section>
