<style>
    .box{
        display: none;
        width: 100%;
    }

    /*    a:hover + .box,.box:hover{
            display: block;
            position: relative;
            z-index: 100;
        }*/
    .sticky {
        position: fixed;
        top: 0;
        width: 100%
    }

    /* Add some top padding to the page content to prevent sudden quick movement (as the header gets a new position at the top of the page (position:fixed and top:0) */
    .sticky + .content {
        padding-top: 102px;
    }

    #ex3::-webkit-scrollbar{
        width:16px;
        background-color:#cccccc;
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
                        <a ui-sref="dashboard">Home</a>
                    </li>
                    <li class="breadcrumb-item"><a ui-sref="sources">Sources</a></li>
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
                                                            <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12 col-xs-12 text-xs-right"><label>Source</label></div>
                                                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="exampleInputuname_3" ng-model="source.source_link" placeholder="URL " >
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="element-form">
                                                            <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12 col-xs-12 text-xs-right"><label>Contact</label></div>
                                                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="exampleInputuname_3" ng-model="source.name" placeholder="Contact " >
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="element-form">
                                                            <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12 col-xs-12 text-xs-right"><label>Email</label></div>
                                                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                                <div class="form-group">
                                                                    <input type="email" class="form-control" id="exampleInputEmail_3" name="email" ng-model="source.email" placeholder="Email" ng-pattern = "/^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/">
                                                                </div>
                                                                <span style="color:Red" ng-show="signupForm.email.$dirty && signupForm.email.$error.pattern">Please Enter Valid Email</span>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="element-form">
                                                            <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12 col-xs-12 text-xs-right"><label>Meta Description</label></div>
                                                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="exampleInputweb_31" ng-model="source.meta_description" placeholder="Meta Description"  >
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="element-form">
                                                            <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12 col-xs-12 text-xs-right"><label>Topics</label></div>
                                                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
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
                                                    </div>
                                                    <div class="row">
                                                        <div class="element-form">
                                                            <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12 col-xs-12 text-xs-right"><label>Link Type</label></div>
                                                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                                <div class="form-group">
                                                                    <select class="form-control" data-placeholder="Link Type" ng-model="source.link_type">
                                                                        <option value="">Select</option>
                                                                        <option ng-repeat="links in linkTypes track by $index" ng-selected="links.id == source.link_type" value="{{links.id}}">{{ links.name | lowercase }}</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="element-form">
                                                            <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12 col-xs-12 text-xs-right"><label>Comment</label></div>
                                                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                                <div class="form-group">
                                                                    <textarea class="form-control" rows="2" ng-model="source.comment"></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="element-form">
                                                            <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12 col-xs-12 text-xs-right">
                                                                <button class="btn btn-info btn-success" ng-click="saveType == 'SAVE' ? saveNewSourceDetails() : updateSourceDetails()">{{ saveType}}</button>
                                                            </div>
                                                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                                <button class="btn btn-info btn-danger" ng-click="cancelSource(source)">Cancel</button>
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

</div>
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
                                <h4 class="page-content-title float-xs-left">Total {{ sourceCount}} Source </h4>
                                <span style="float:right;"><a href="api/index.php/sources/generatesourceexcel" target="_blank"><button class="btn btn-warning" >Export to Excel</button></a></span>
                                <span style="float:right;margin-right: 2%;"><button type="button" class="btn btn-mini btn-success" data-toggle="modal" data-target="#defaultmodal">Import Excel</button></span>
                                <span style="float:right;margin-right: 2%;"><button type="button" class="btn btn-primary" ng-click="addNewSource()">Add New</button></span>
                            </div>
                            <div class="dashboard-box">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="col-md-4">
                                            <label class="sr-only">Search</label>
                                            <span style="margin:10% !important;"><input class="form-control" ng-model="searchfield" placeholder="Search" type="text"></span>
                                        </div>
                                        <div class="col-md-8">
                                            <span style="float: right;"><a href="<?php echo "api/application/files/sources.xlsx"; ?>" target="_blank">Download Sample Excel Format</a></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="" >
                                            <table  class="table table-striped">
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
                                                        <th ng-click="orderByField = 'comment'; reverseSort = !reverseSort" style="cursor: pointer !important;">Note
                                                            <span ng-show="orderByField == 'comment'"><span ng-show="!reverseSort"><i class="fa fa-arrow-up "></i></span><span ng-show="reverseSort"><i class="fa fa-arrow-down "></i></span></span></span>
                                                        </th>

                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr ng-repeat="sources in sourceList| orderBy:orderByField:reverseSort |  filter: searchfield track by $index">
                                                        <td>{{ sources.sn}}</td>
                                                        <td title="{{ sources.exact_link}}">
                                                            <span ng-hide="sources.editMode"  style="color:{{sources.live_status !='ONLINE' ? 'Red' : 'Black' }}"<a href="{{ sources.exact_link | lowercase }}" target="_blank" >{{ sources.source_link | limitTo: 15 }}</a></span>
                                                            <input type="text" name="firstName" ng-show="sources.editMode" class="form-control" ng-model="sources.exact_link" placeholder="Source Link" required="" />
                                                        </td>
                                                        <td title="{{ sources.email}}">
                                                            <span ng-hide="sources.editMode"><a href="mailto:{{ sources.email | lowercase  }}">{{ sources.email | limitTo: 15 }}</a></span>
                                                            <input  type="text" name="firstName" ng-show="sources.editMode" class="form-control" ng-model="sources.email" placeholder="Email" required="" />
                                                        </td>
                                                        <td ng-click="editSource(sources, $index)">
                                                            <span ng-hide="sources.editMode" title="{{ sources.name}}">{{ sources.name | lowercase | limitTo: 15 }}</span>
                                                            <input type="text" name="firstName" ng-show="sources.editMode" class="form-control" ng-model="sources.name" placeholder="Name" required="" />
                                                        </td>
                                                        <td ng-click="editSource(sources, $index)">
                                                            <span ng-hide="sources.editMode">{{ sources.topics | lowercase}}</span>
                                                <ui-select class="form-control" ng-show="sources.editMode" ng-model="tag.selected">
                                                    <ui-select-match placeholder="Select or search ">{{$select.selected}}</ui-select-match>
                                                    <ui-select-choices repeat="hero in getTags($select.search) | filter: $select.search">
                                                        <div ng-bind="hero"></div>
                                                    </ui-select-choices>
                                                </ui-select>
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
                                                <td ng-click="editSource(sources, $index)">
                                                    <span ng-hide="sources.editMode">{{ sources.project_list | lowercase}}</span>
                                                <ui-select ng-show="sources.editMode" multiple tagging tagging-label="false" ng-model="sources.project_id" theme="bootstrap" ng-disabled="disabled" style="width: 100px;" title="Project">
                                                    <ui-select-match style="width: 100px;" >{{$item.project_name}}</ui-select-match>
                                                    <ui-select-choices repeat="project in projectList | filter:$select.search">
                                                        {{project.project_name}}
                                                    </ui-select-choices>
                                                </ui-select>
                                                </td>
                                                <td ng-click="editSource(sources, $index)">
                                                    <span ng-hide="sources.editMode">{{ sources.link_type | lowercase }}</span>
                                                    <select ng-show="sources.editMode" class="form-control" data-placeholder="Link Type" ng-model="sources.link_type">
                                                        <option value="">Select</option>
                                                        <option ng-repeat="links in linkTypes track by $index" ng-selected="links.name == sources.link_type" value="{{links.id}}">{{ links.name | lowercase }}</option>
                                                    </select>
                                                </td>
                                                <td ng-click="editSource(sources, $index)">
                                                    <span ng-hide="sources.editMode" title="{{ sources.comment}}">{{ sources.comment | limitTo: 15 }}</span>
                                                    <input type="text" name="firstName" ng-show="sources.editMode" class="form-control" ng-model="sources.comment" placeholder="Note" required="" />
                                                </td>

                                                <td>
                                                    <button style="padding:5px 5px !important;" ng-hide="sources.editMode" class="btn btn-mini btn-primary" ng-click="editSource(sources, $index)" ><i class="fa fa-edit"></i></button>
                                                    <button style="padding:5px 5px !important;" ng-hide="sources.editMode" class="btn btn-mini btn-danger" ng-click="deleteSource(sources.id, $index)" id="sa-warning"><i class="fa fa-close"></i></button>
                                                    <button style="padding:5px 5px !important;" ng-show="sources.editMode" class="btn btn-xs btn-primary" ng-click="updateSourceDetails(sources)" >Update</button>
                                                    <button style="padding:5px 5px !important;" ng-show="sources.editMode" class="btn btn-xs btn-danger" ng-click="cancelSource(sources)" id="sa-warning">Cancel</button>
                                                </td>
                                                </tr>
                                                </tbody>
                                                <tfoot class="" ng-show="pageArr.length > 1 && sourceList.length > 0">
                                                    <tr class="footable-paging"><td colspan="12" class="__web-inspector-hide-shortcut__">
                                                            <ul class="pagination">
                                                                <li class="footable-page-nav disabled" ng-click="changeLimitWithButton('previous')"><a style="cursor: pointer;" class="footable-page-link">‹</a></li>
                                                                <li ng-repeat="page in pageArr track by $index" class="footable-page visible {{ selectedPage != $index ? '' : 'active' }}" ng-click="changeLimit(page, $index)"><a class="footable-page-link" style="cursor: pointer;">{{ $index + 1}}</a></li>
                                                                <li class="footable-page-nav" ng-click="changeLimitWithButton('next')"><a style="cursor: pointer;" class="footable-page-link">›</a></li>
                                                            </ul>
                                                        </td>
                                                    </tr>
                                                </tfoot>
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
</div>
</section>

</div>
</section>

<div myModal class="modal fade" id="defaultmodal"  tabindex="-1" role="dialog" aria-labelledby="defaultmodal" aria-hidden="true">
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
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="cancelmodal">Cancel</button>
                <button type="button" class="btn btn-primary"  ng-click="saveExcelData()">Import</button>
            </div>
        </div>
    </div>
</div>