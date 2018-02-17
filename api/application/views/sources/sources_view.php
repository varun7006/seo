<style>
    .box{
        display: none;
        width: 100%;
    }

    a:hover + .box,.box:hover{
        display: block;
        position: relative;
        z-index: 100;
    }
</style>
<section id="main" class="container-fluid">
    <div class="row">
        <section id="content-wrapper" class="form-elements">
            <div class="site-content-title">
                <h2 class="float-xs-left content-title-main">Sources</h2>
                <ol class="breadcrumb float-xs-right">
                    <li class="breadcrumb-item">
                        <span class="fs1" aria-hidden="true" data-icon=""></span>
                        <a href="#">Home</a>
                    </li>
                    <li class="breadcrumb-item"><a href="#">Sources</a></li>
                    <li class="breadcrumb-item active">Sources List</li>
                </ol>
            </div>
            <div class="contain-inner dashboard_v4-page" ng-if="showNewSource == true">
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="content dashboard_v4_project_list">
                            <div class="dashboard-content">
                                <div class="dashboard-header">
                                    <h4 class="page-content-title float-xs-left">Add New Source</h4>
                                </div>
                                <div class="dashboard-box">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <form name="signupForm">
                                                <div class="all-form-section">
                                                    <div class="row">
                                                        <div class="element-form">
                                                            <div class="col-xl-2 col-lg-3 col-md-3 col-sm-12 col-xs-12 text-xs-right"><label>Source</label></div>
                                                            <div class="col-xl-9 col-lg-9 col-md-9 col-sm-12 col-xs-12">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="exampleInputuname_3" ng-model="source.source_link" placeholder="Enter Link Here" >
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="element-form">
                                                            <div class="col-xl-2 col-lg-3 col-md-3 col-sm-12 col-xs-12 text-xs-right"><label>Contact</label></div>
                                                            <div class="col-xl-9 col-lg-9 col-md-9 col-sm-12 col-xs-12">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="exampleInputuname_3" ng-model="source.name" placeholder="Enter Contact Here" >
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="element-form">
                                                            <div class="col-xl-2 col-lg-3 col-md-3 col-sm-12 col-xs-12 text-xs-right"><label>Email</label></div>
                                                            <div class="col-xl-9 col-lg-9 col-md-9 col-sm-12 col-xs-12">
                                                                <div class="form-group">
                                                                    <input type="email" class="form-control" id="exampleInputEmail_3" name="email" ng-model="source.email" placeholder="Enter email" ng-pattern = "/^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/">
                                                                </div>
                                                                <span style="color:Red" ng-show="signupForm.email.$dirty && signupForm.email.$error.pattern">Please Enter Valid Email</span>

                                                            </div>
                                                        </div>
                                                        <div class="element-form">
                                                            <div class="col-xl-2 col-lg-3 col-md-3 col-sm-12 col-xs-12 text-xs-right"><label>Phone</label></div>
                                                            <div class="col-xl-9 col-lg-9 col-md-9 col-sm-12 col-xs-12">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="exampleInputweb_31" ng-model="source.mobile_no" placeholder="Enter Phone Here"  >
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="element-form">
                                                            <div class="col-xl-2 col-lg-3 col-md-3 col-sm-12 col-xs-12 text-xs-right"><label>Topics</label></div>
                                                            <div class="col-xl-9 col-lg-9 col-md-9 col-sm-12 col-xs-12">
                                                                <div class="form-group">
                                                                    <ui-select class="form-control" ng-model="tag.selected">
                                                                        <ui-select-match placeholder="Select or search ">{{$select.selected}}</ui-select-match>
                                                                        <ui-select-choices repeat="hero in getTags($select.search) | filter: $select.search">
                                                                            <div ng-bind="hero"></div>
                                                                        </ui-select-choices>
                                                                    </ui-select>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="element-form">
                                                            <div class="col-xl-2 col-lg-3 col-md-3 col-sm-12 col-xs-12 text-xs-right"><label>Which Project?</label></div>
                                                            <div class="col-xl-9 col-lg-9 col-md-9 col-sm-12 col-xs-12">
                                                                <div class="form-group">
                                                                     <select class="form-control" data-placeholder="Choose Project" ng-model="source.project_id">
                                                                        <option value="">Select</option>
                                                                        <option ng-repeat="project in projectList track by $index" ng-selected="project.id == source.project_id" value="{{project.id}}">{{project.project_name}}</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="element-form">
                                                            <div class="col-xl-2 col-lg-3 col-md-3 col-sm-12 col-xs-12 text-xs-right"><label>Link Type</label></div>
                                                            <div class="col-xl-9 col-lg-9 col-md-9 col-sm-12 col-xs-12">
                                                                <div class="form-group">
                                                                    <select class="form-control" data-placeholder="Choose Link Type" ng-model="source.link_type">
                                                                        <option value="">Select</option>
                                                                        <option ng-repeat="links in linkTypes track by $index" ng-selected="links.id == source.link_type" value="{{links.id}}">{{ links.name }}</option>
                                                                     </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="element-form">
                                                            <div class="col-xl-2 col-lg-3 col-md-3 col-sm-12 col-xs-12 text-xs-right"><label>Status</label></div>
                                                            <div class="col-xl-9 col-lg-9 col-md-9 col-sm-12 col-xs-12">
                                                                <div class="form-group">
                                                                    <select class="form-control" data-placeholder="Choose Country" ng-model="source.link_status">
                                                                        <option value="">Select</option>
                                                                        <option value="open">Open</option>
                                                                        <option value="processing">Processing</option>
                                                                        <option value="completed">Completed</option>
                                                                        <option value="rejected">Rejected</option>

                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="element-form">
                                                            <div class="col-xl-2 col-lg-3 col-md-3 col-sm-12 col-xs-12 text-xs-right"><label>Comment</label></div>
                                                            <div class="col-xl-9 col-lg-9 col-md-9 col-sm-12 col-xs-12">
                                                                <div class="form-group">
                                                                    <textarea class="form-control" rows="2" ng-model="source.comment"></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="element-form">
                                                            <div class="col-xl-2 col-lg-3 col-md-3 col-sm-12 col-xs-12 text-xs-right">
                                                                <button class="btn btn-info btn-success" ng-click="saveType == 'SAVE' ? saveNewSourceDetails() : updateSourceDetails()">{{ saveType}}</button>
                                                            </div>
                                                            <div class="col-xl-9 col-lg-9 col-md-9 col-sm-12 col-xs-12">
                                                                <button class="btn btn-info btn-danger" ng-click="cancelSource()">Cancel</button>
                                                            </div>
                                                        </div
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

</div>
<div class="row">
    <section id="content-wrapper" class="form-elements">

        <div class="contain-inner dashboard_v4-page">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="content dashboard_v4_project_list">
                        <div class="dashboard-content">
                            <div class="dashboard-header">
                                <h4 class="page-content-title float-xs-left">Total {{ sourceCount}} Source </h4>
                                <span style="float:right"><button type="button" class="btn btn-primary" ng-click="addNewSource()">Add New</button></span>
                                <span style="float:right;margin-right: 2%;"><button type="button" class="btn btn-mini btn-success" data-toggle="modal" data-target="#defaultmodal">Upload Excel</button></span>
                                <span style="float:right;margin-right: 2%;"><button class="btn btn-warning" onclick="exportData('myDataTable', 'sources.xls')">Export to Excel</button></span>
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
                                                            <th ng-click="orderByField = 'source_link'; reverseSort = !reverseSort" style="cursor: pointer !important;">Source
                                                                <span ng-show="orderByField == 'source_link'"><span ng-show="!reverseSort"><i class="fa fa-arrow-up "></i></span><span ng-show="reverseSort"><i class="fa fa-arrow-down "></i></span></span></span>
                                                            </th>
                                                            <th ng-click="orderByField = 'email'; reverseSort = !reverseSort" style="cursor: pointer !important;">Email
                                                                <span ng-show="orderByField == 'email'"><span ng-show="!reverseSort"><i class="fa fa-arrow-up "></i></span><span ng-show="reverseSort"><i class="fa fa-arrow-down "></i></span></span></span>
                                                            </th>
                                                            <th ng-click="orderByField = 'name'; reverseSort = !reverseSort" style="cursor: pointer !important;">Name
                                                                <span ng-show="orderByField == 'name'"><span ng-show="!reverseSort"><i class="fa fa-arrow-up "></i></span><span ng-show="reverseSort"><i class="fa fa-arrow-down "></i></span></span></span>
                                                            </th>
                                                            <th ng-click="orderByField = 'topics'; reverseSort = !reverseSort" style="cursor: pointer !important;">Topics
                                                                <span ng-show="orderByField == 'topics'"><span ng-show="!reverseSort"><i class="fa fa-arrow-up "></i></span><span ng-show="reverseSort"><i class="fa fa-arrow-down "></i></span></span></span>
                                                            </th>
                                                            <th ng-click="orderByField = 'pa'; reverseSort = !reverseSort" style="cursor: pointer !important;">PA
                                                                <span ng-show="orderByField == 'pa'"><span ng-show="!reverseSort"><i class="fa fa-arrow-up "></i></span><span ng-show="reverseSort"><i class="fa fa-arrow-down "></i></span></span></span>
                                                            </th>
                                                            <th ng-click="orderByField = 'da'; reverseSort = !reverseSort" style="cursor: pointer !important;">DA
                                                                <span ng-show="orderByField == 'da'"><span ng-show="!reverseSort"><i class="fa fa-arrow-up "></i></span><span ng-show="reverseSort"><i class="fa fa-arrow-down "></i></span></span></span>
                                                            </th>
                                                            <th ng-click="orderByField = 'moz_rank'; reverseSort = !reverseSort" style="cursor: pointer !important;">Moz Rank
                                                                <span ng-show="orderByField == 'moz_rank'"><span ng-show="!reverseSort"><i class="fa fa-arrow-up "></i></span><span ng-show="reverseSort"><i class="fa fa-arrow-down "></i></span></span></span>
                                                            </th>
                                                            <th ng-click="orderByField = 'project_name'; reverseSort = !reverseSort" style="cursor: pointer !important;">Project
                                                                <span ng-show="orderByField == 'project_name'"><span ng-show="!reverseSort"><i class="fa fa-arrow-up "></i></span><span ng-show="reverseSort"><i class="fa fa-arrow-down "></i></span></span></span>
                                                            </th>
                                                            <th ng-click="orderByField = 'link_type'; reverseSort = !reverseSort" style="cursor: pointer !important;">Link Type
                                                                <span ng-show="orderByField == 'link_type'"><span ng-show="!reverseSort"><i class="fa fa-arrow-up "></i></span><span ng-show="reverseSort"><i class="fa fa-arrow-down "></i></span></span></span>
                                                            </th>
                                                            <th ng-click="orderByField = 'comment'; reverseSort = !reverseSort" style="cursor: pointer !important;">Comment
                                                                <span ng-show="orderByField == 'comment'"><span ng-show="!reverseSort"><i class="fa fa-arrow-up "></i></span><span ng-show="reverseSort"><i class="fa fa-arrow-down "></i></span></span></span>
                                                            </th>

                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr ng-repeat="sources in sourceList| orderBy:orderByField:reverseSort |  filter: searchfield track by $index">
                                                            <td>{{ $index + 1}}</td>
                                                            <td>
                                                                <span ng-hide="sources.editMode" ng-mouseover="getIframeSrc(sources.exact_link)"><a href="{{ sources.exact_link }}" target="_blank" >{{ sources.source_link}}</a><div class="box"><iframe src="{{ iframeLink }}" width = "200px" height = "200px"></iframe></div></span>
                                                                <input type="text" name="firstName" ng-show="sources.editMode" class="form-control" ng-model="sources.source_link" placeholder="Source Link" required="" />
                                                            </td>
                                                            <td>
                                                                <span ng-hide="sources.editMode"><a href="mailto:{{ sources.email}}">{{ sources.email}}</a></span>
                                                                <input type="text" name="firstName" ng-show="sources.editMode" class="form-control" ng-model="sources.email" placeholder="Email" required="" />
                                                            </td>
                                                            <td>
                                                                <span ng-hide="sources.editMode">{{ sources.name}}</span>
                                                                <input type="text" name="firstName" ng-show="sources.editMode" class="form-control" ng-model="sources.name" placeholder="Name" required="" />
                                                            </td>
                                                            <td>
                                                                <span ng-hide="sources.editMode">{{ sources.topics}}</span>
                                                                <input type="text" name="firstName" ng-show="sources.editMode" class="form-control" ng-model="sources.topics" placeholder="Topics" required="" />
                                                            </td>
                                                            <td>
                                                                <span ng-hide="sources.editMode">{{ sources.pa}}</span>
                                                            </td>
                                                            <td>
                                                                <span ng-hide="sources.editMode">{{ sources.da}}</span>
                                                            </td>
                                                            <td>
                                                                <span ng-hide="sources.editMode">{{ sources.moz_rank}}</span>
                                                            </td>
                                                            <td>
                                                                <span ng-hide="sources.editMode">{{ sources.project_name}}</span>
                                                                <select ng-show="sources.editMode" class="form-control" data-placeholder="Choose Project" ng-model="sources.project_id">
                                                                    <option value="">Select</option>
                                                                    <option ng-repeat="project in projectList track by $index" ng-selected="project.id == sources.project_id" value="{{project.id}}">{{project.project_name}}</option>
                                                                </select>
                                                            </td>
                                                            <td>
                                                                <span ng-hide="sources.editMode">{{ sources.link_type | lowercase }}</span>
                                                                <select ng-show="sources.editMode" class="form-control" data-placeholder="Choose Link Type" ng-model="sources.link_type">
                                                                        <option value="">Select</option>
                                                                        <option ng-repeat="links in linkTypes track by $index" ng-selected="links.id == sources.link_type" value="{{links.id}}">{{ links.name }}</option>
                                                                     </select>
                                                            </td>
                                                            <td>
                                                                 <span ng-hide="sources.editMode">{{ sources.comment}}</span>
                                                                <input type="text" name="firstName" ng-show="sources.editMode" class="form-control" ng-model="sources.comment" placeholder="First Name" required="" />
                                                            </td>

                                                            <td>
                                                                <button ng-hide="sources.editMode" class="btn btn-mini btn-primary" ng-click="editSource(sources, $index)" ><i class="fa fa-edit"></i></button>
                                                                <button ng-hide="sources.editMode" class="btn btn-mini btn-danger" ng-click="deleteSource(sources.id, $index)" id="sa-warning"><i class="fa fa-close"></i></button>
                                                                <button ng-show="sources.editMode" class="btn btn-xs btn-primary" ng-click="updateSourceDetails(sources)" >Update</button>
                                                                <button ng-show="sources.editMode" class="btn btn-xs btn-danger" ng-click="cancelSource(sources)" id="sa-warning">Cancel</button>
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