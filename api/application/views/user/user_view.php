
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
            <div class="contain-inner dashboard_v4-page" ng-if="showNewUser == true">
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
                                                                    <input type="text" class="form-control" id="exampleInputweb_31" ng-model="user.mobile_no" placeholder="Enter Phone No"  >
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
                                                                <button class="btn btn-info btn-success" ng-click="saveType == 'SAVE' ? saveNewUserDetails() : updateUserDetails()">{{ saveType}}</button>
                                                            </div>
                                                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                                <button class="btn btn-info btn-danger" ng-click="cancelUser()">Cancel</button>
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

</div>
<div class="row">
    <section id="content-wrapper" class="form-elements">

        <div class="contain-inner dashboard_v4-page">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="content dashboard_v4_project_list">
                        <div class="dashboard-content">
                            <div class="dashboard-header">
                                <h4 class="page-content-title float-xs-left">Total {{ userCount }} Clients</h4>
                                <span style="float:right"><button type="button" class="btn btn-primary" ng-click="addNewUser()">Add New</button></span>
                                <span style="float:right;margin-right: 2%;"><button class="btn btn-warning" onclick="exportData('myDataTable', 'user.xls')">Export to Excel</button></span>
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
                                                        <th ng-click="orderByField = 'name'; reverseSort = !reverseSort" style="cursor: pointer !important;">Name
                                                            <span ng-show="orderByField == 'name'"><span ng-show="!reverseSort"><i class="fa fa-arrow-up "></i></span><span ng-show="reverseSort"><i class="fa fa-arrow-down "></i></span></span></span>
                                                        </th>
                                                        <th ng-click="orderByField = 'email'; reverseSort = !reverseSort" style="cursor: pointer !important;">Email
                                                            <span ng-show="orderByField == 'email'"><span ng-show="!reverseSort"><i class="fa fa-arrow-up "></i></span><span ng-show="reverseSort"><i class="fa fa-arrow-down "></i></span></span></span>
                                                        </th>
                                                        <th ng-click="orderByField = 'website'; reverseSort = !reverseSort" style="cursor: pointer !important;">Website
                                                            <span ng-show="orderByField == 'website'"><span ng-show="!reverseSort"><i class="fa fa-arrow-up "></i></span><span ng-show="reverseSort"><i class="fa fa-arrow-down "></i></span></span></span>
                                                        </th>
                                                        <th ng-click="orderByField = 'mobile_no'; reverseSort = !reverseSort" style="cursor: pointer !important;">Phone No
                                                            <span ng-show="orderByField == 'mobile_no'"><span ng-show="!reverseSort"><i class="fa fa-arrow-up "></i></span><span ng-show="reverseSort"><i class="fa fa-arrow-down "></i></span></span></span>
                                                        </th>
                                                        <th ng-click="orderByField = 'address'; reverseSort = !reverseSort" style="cursor: pointer !important;">Address
                                                            <span ng-show="orderByField == 'address'"><span ng-show="!reverseSort"><i class="fa fa-arrow-up "></i></span><span ng-show="reverseSort"><i class="fa fa-arrow-down "></i></span></span></span>
                                                        </th>
                                                        <th>Comment<span ng-show="orderByField == 'comment'"><span ng-show="!reverseSort"><i class="fa fa-arrow-up "></i></span><span ng-show="reverseSort"><i class="fa fa-arrow-down "></i></span></span></span>
                                                        </th>                                                       
                                                        <th>Action</th>
                                                    </tr>

                                                </thead>
                                                <tbody>
                                                    <tr ng-repeat="user in userList| orderBy:orderByField:reverseSort | filter: searchfield track by $index">
                                                        <td>{{ $index + 1}}</td>
                                                        <td ng-click="editUser(user, $index)">
                                                            <span ng-hide="user.editMode == true">{{user.name}}</span>
                                                            <input type="text" name="firstName" ng-show="user.editMode" class="form-control" ng-model="user.name" placeholder="First Name" required="" />
                                                        </td>
                                                        <td ng-click="editUser(user, $index)">
                                                            <span ng-hide="user.editMode">{{user.email}}</span>
                                                            <input type="text" ng-show="user.editMode" name="lastName" class="form-control" ng-model="user.email" placeholder="Email" required="" />
                                                        </td>
                                                        <td ng-click="editUser(user, $index)">
                                                            <span ng-hide="user.editMode">{{user.website}}</span>
                                                            <input type="text" ng-show="user.editMode" name="website" class="form-control" ng-model="user.website" placeholder="Website" required="" />
                                                        </td>
                                                        <td ng-click="editUser(user, $index)">
                                                            <span ng-hide="user.editMode">{{user.mobile_no}}</span>
                                                            <input type="text" ng-show="user.editMode" name="mobile_no" class="form-control" ng-model="user.mobile_no" placeholder="Phone No" required="" />
                                                            </td>
                                                        <td ng-click="editUser(user, $index)">
                                                            <span ng-hide="user.editMode">{{user.address}}</span>
                                                            <input type="text" ng-show="user.editMode" name="address" class="form-control" ng-model="user.address" placeholder="Address" required="" />
                                                            </td>
                                                        <td ng-click="editUser(user, $index)">
                                                            <span ng-hide="user.editMode">{{user.comment}}</span>
                                                            <input type="text" ng-show="user.editMode" name="comment" class="form-control" ng-model="user.comment" placeholder="Comment" required="" />
                                                        </td>
                                                        <td>
                                                            <button ng-hide="user.editMode" class="btn btn-mini btn-primary" ng-click="editUser(user, $index)" ><i class="fa fa-edit"></i></button>
                                                            <button ng-hide="user.editMode" class="btn btn-mini btn-danger" ng-click="deleteUser(user.id, $index)" id="sa-warning"><i class="fa fa-close"></i></button>
                                                            <button ng-show="user.editMode" class="btn btn-xs btn-primary" ng-click="updateUserDetails(user)" >Update</button>
                                                            <button ng-show="user.editMode" class="btn btn-xs btn-danger" ng-click="cancelUser(user)" id="sa-warning">Cancel</button>
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