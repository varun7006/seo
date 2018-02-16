<div ng-if="isAjax == true"  id="loading-block"></div>
<section id="main" class="container-fluid">
    <div class="row">
        <section id="content-wrapper" class="form-elements">
            <div class="site-content-title">
                <h2 class="float-xs-left content-title-main">Sources Report</h2>
                <ol class="breadcrumb float-xs-right">
                    <li class="breadcrumb-item">
                        <span class="fs1" aria-hidden="true" data-icon=""></span>
                        <a href="#">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item"><a ui-sref=sources>Sources</a></li>
                    <li class="breadcrumb-item active">Sources Report</li>
                </ol>
            </div>
            <div class="contain-inner dashboard_v4-page">
                <div class="row">
                        <div class="contain-inner dashboard_v4-page">
                            <div class="row">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="content dashboard_v4_project_list">
                                        <div class="dashboard-content">
                                            <div class="dashboard-header">
                                                <h4 class="page-content-title float-xs-left">Source Report</h4>
                                            </div>
                                            <div class="dashboard-box">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="col-md-4">
                                                            <!--<label class="sr-only">Search</label>-->
                                                            
                                                            <!--<span style="margin:10% !important;"><input class="form-control" ng-model="searchfield" placeholder="Search" type="text"></span>-->
                                                        </div>
                                                        <div class="basic_table table-responsive">
                                                            <table class="table table-striped">
                                                                <thead>
                                                                    <tr>
                                                                        <th>#</th>
                                                                        <th>Source Name</th>
                                                                        <th>DA</th>
                                                                        <th>PA</th>
                                                                        <th>MR</th>
                                                                        <th>Date</th>
                                                                        <th>Comment</th>
                                                                        <th>Action</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr ng-repeat="data in sourceReport track by $index">
                                                                        <td>{{ $index + 1 }}</td>
                                                                        <td>{{ data.source_link }}</td>
                                                                        <td>{{ data.da }}</td>
                                                                        <td>{{ data.pa }}</td>
                                                                        <td>{{ data.moz_rank }}</td>
                                                                        <td>{{ data.date }}</td>
                                                                        <td title="{{data.comment}}">{{ data.comment }}</td>
                                                                        <td><button class="btn btn-mini btn-primary" ng-click="generateManualSourceReport(data,$index)">Generate</button></td>
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