<section id="main" class="container-fluid">
    <div class="row">
        <section id="content-wrapper" class="form-elements">
            <div class="site-content-title">
                <h2 class="float-xs-left content-title-main">Sources</h2>
                <ol class="breadcrumb float-xs-right">
                    <li class="breadcrumb-item">
                        <span class="fs1" aria-hidden="true" data-icon=""></span>
                        <a ui-sref="dashboard">Home</a>
                    </li>
                    <li class="breadcrumb-item"><a ui-sref="sources">Sources</a></li>
                    <li class="breadcrumb-item active">Add Source</li>
                </ol>
            </div>
            <div class="contain-inner dashboard_v4-page">
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
                                                            <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12 col-xs-12                text-xs-right"><label>Source</label></div>
                                                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="exampleInputuname_3" ng-model="source.source_link" placeholder="Link" >
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                        <div class="row">
                                                            <div class="element-form">
                                                                <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12 col-xs-12                text-xs-right"><label>Contact</label></div>
                                                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" id="exampleInputuname_3" ng-model="source.name" placeholder="Contact" >
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="element-form">
                                                                <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12 col-xs-12                text-xs-right"><label>Email</label></div>
                                                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                                    <div class="form-group">
                                                                        <input type="email" class="form-control" id="exampleInputEmail_3" name="email" ng-model="source.email" placeholder="Email" ng-pattern = "/^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/">
                                                                    </div>
                                                                    <span style="color:Red" ng-show="signupForm.email.$dirty && signupForm.email.$error.pattern">Please Enter Valid Email</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <!--                                                        <div class="element-form">
                                                                                                                        <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12 col-xs-12                text-xs-right"><label>Phone</label></div>
                                                                                                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                                                                                            <div class="form-group">
                                                                                                                                <input type="text" class="form-control" id="exampleInputweb_31" ng-model="source.mobile_no" placeholder="Enter Phone "  >
                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                    </div>-->
                                                            <div class="element-form">
                                                                <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12 col-xs-12                text-xs-right"><label>Topics</label></div>
                                                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                                    <div class="form-group">
                                                                        <!--<input type="text" class="form-control" id="exampleInputweb_31" ng-model="source.topics" placeholder="Enter Topics">-->
                                                                        <ui-select class="form-control" ng-model="tag.selected">
                                                                            <ui-select-match placeholder="Select or search ">{{$select.selected}}</ui-select-match>
                                                                            <ui-select-choices repeat="hero in getTags($select.search) | filter: $select.search">
                                                                                <div ng-bind="hero"></div>
                                                                            </ui-select-choices>
                                                                        </ui-select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="element-form">
                                                                <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12 col-xs-12                text-xs-right"><label>Which Project?</label></div>
                                                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                                    <div class="form-group">
                                                                        <select class="form-control" data-placeholder="Choose Project" ng-model="source.project_id">
                                                                            <option value="">Select</option>
                                                                            <option ng-repeat="project in projectList track by $index" ng-selected="project.id == source.project_id" value="{{project.id}}">{{project.project_name}}</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="element-form">
                                                                <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12 col-xs-12                text-xs-right"><label>Link Type</label></div>
                                                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                                    <div class="form-group">
                                                                        <select class="form-control" data-placeholder="Choose Country" ng-model="source.link_type">
                                                                            <option value="">Select</option>
                                                                            <option ng-repeat="links in linkTypes track by $index" ng-selected="links.id == source.link_type" value="{{links.id}}">{{ links.name}}</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="element-form">
                                                                <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12 col-xs-12                text-xs-right"><label>Status</label></div>
                                                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
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
                                                        </div>
                                                        <div class="row">
                                                            <div class="element-form">
                                                                <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12 col-xs-12                text-xs-right"><label>Comment</label></div>
                                                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                                    <div class="form-group">
                                                                        <textarea class="form-control" rows="2" ng-model="source.comment"></textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="element-form">
                                                                <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12 col-xs-12                text-xs-right">
                                                                    <button class="btn btn-info btn-success"  ng-click="saveType == 'SAVE' ? saveNewSourceDetails() : updateSourceDetails()">Add</button>
                                                                </div>
                                                            </div>
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
                            <input ng-model="excelFile" style="height:35px;width:350px;padding:0px;" type="file" class="form-control  btn btn-success fileinput-button"  onchange="angular.element(this).scope().uploadedFile(this)">
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