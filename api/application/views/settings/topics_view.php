<section id="main" class="container-fluid">
<!--    <section id="content-wrapper" class="form-elements">
        <div class="contain-inner dashboard_v4-page" ng-if="showNew == true">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="content dashboard_v4_project_list">
                        <div class="dashboard-content">
                            <div class="dashboard-header">
                                <h4 class="page-content-title float-xs-left">Add New Link Type</h4>
                            </div>
                            <div class="dashboard-box">
                                <div class="row">
                                    <div class="col-md-12">
                                        <form name="signupForm">
                                            <div class="all-form-section">
                                                <div class="row">
                                                    <div class="element-form">
                                                        <div class="col-xl-2 col-lg-3 col-md-3 col-sm-12 col-xs-12 text-xs-right"><label>Link Type</label></div>
                                                        <div class="col-xl-9 col-lg-9 col-md-9 col-sm-12 col-xs-12">
                                                            <div class="form-group">
                                                                <input type="text" class="form-control" id="exampleInputuname_3" ng-model="link.name" placeholder="Enter Link Here" >
                                                            </div>
                                                        </div>
                                                    </div>
                              
                                                    <div class="element-form">
                                                        <div class="col-xl-2 col-lg-3 col-md-3 col-sm-12 col-xs-12 text-xs-right">
                                                            <button class="btn btn-info btn-success" ng-click="saveType == 'SAVE' ? saveNewLinkType() : updateLinkType()">{{ saveType}}</button>
                                                        </div>
                                                        <div class="col-xl-9 col-lg-9 col-md-9 col-sm-12 col-xs-12">
                                                            <button class="btn btn-info btn-danger" ng-click="cancelLinkType({})">Cancel</button>
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
    </section>-->

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
                                <h4 class="page-content-title float-xs-left">Total {{ topicsCount}}  {{ topicsCount > 1 ? 'Topics' : 'Topic'}}</h4>
                                <!--<span style="float:right"><button type="button" class="btn btn-primary" ng-click="addNewLinkType()">Add New</button></span>-->
                                <!--<span style="float:right;margin-right: 2%;"><button class="btn btn-warning" onclick="exportData('myDataTable', 'topicslist.xls')">Export to Excel</button></span>-->
                            </div>
                            <div class="dashboard-box">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="col-md-4">
                                            <label class="sr-only">Search</label>
                                            <span style="margin:10% !important;"><input class="form-control" ng-model="searchfield" placeholder="Search" type="text"></span>
                                        </div>
                                        <div class="basic_table table-responsive">
                                            <table class="table table-striped" style="width: 25% !important;padding: 0px !important;">
                                                <thead>
                                                    <tr >
                                                        <th>#</th>
                                                        <th ng-click="orderByField = 'name'; reverseSort = !reverseSort" style="cursor: pointer !important;">Topics
                                                            <span ng-show="orderByField == 'name'"><span ng-show="!reverseSort"><i class="fa fa-arrow-up "></i></span><span ng-show="reverseSort"><i class="fa fa-arrow-down "></i></span></span></span>
                                                        </th>
                                                        <th>
                                                            
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr ng-repeat="topic in topicsList | orderBy:orderByField:reverseSort |  filter: searchfield track by $index">
                                                        <td>{{ $index + 1}}</td>
                                                        <td >{{ topic.tag}}</span>
                                                        </td>
                                                        <td>
                                                            <button style="padding:5px 5px !important;" class="btn btn-mini btn-danger" ng-click="deleteTopic(topic.id, $index)" id="sa-warning"><i class="fa fa-close"></i></button>
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
