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
                                    <h4 class="page-content-title float-xs-left">Total {{ brokenSourceCount}} Broken Source </h4>

                                    <span style="float:right;margin-right: 2%;"><button class="btn btn-warning" onclick="exportData('myDataTable', 'brokensources.xls')">Export to Excel</button></span>
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
                                                    <table class="table table-striped" style="width: 35% !important;padding: 0px !important;">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th ng-click="orderByField = 'source_link'; reverseSort = !reverseSort" style="cursor: pointer !important;">Source
                                                                    <span ng-show="orderByField == 'source_link'"><span ng-show="!reverseSort"><i class="fa fa-arrow-up "></i></span><span ng-show="reverseSort"><i class="fa fa-arrow-down "></i></span></span></span>
                                                                </th>

                                                                <th ng-click="orderByField = 'last_checked_date'; reverseSort = !reverseSort" style="cursor: pointer !important;">Last Checked Date
                                                                    <span ng-show="orderByField == 'last_checked_date'"><span ng-show="!reverseSort"><i class="fa fa-arrow-up "></i></span><span ng-show="reverseSort"><i class="fa fa-arrow-down "></i></span></span></span>
                                                                </th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr ng-repeat="sources in sourceList| orderBy:orderByField:reverseSort |  filter: searchfield track by $index">
                                                                <td>{{ $index + 1}}</td>
                                                                <td>{{ sources.source_link}}</td>
                                                                <td>{{ sources.last_checked_date}}</td>
                                                                <td><button style="padding:5px 5px !important;" ng-hide="sources.editMode" class="btn btn-mini btn-danger" ng-click="deleteSource(sources.source_id, $index)" id="sa-warning"><i class="fa fa-close"></i></button></td>
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

