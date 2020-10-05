<?php require ("../../includes.php");  ?>


<?php  if($_POST['act'] == FUN_EMP){ ?>
    <!-- Basic Inputs Validation start -->
    <div class="card">
        <div class="card-header bg-c-lite-green">
            <h5>Add New Employee </h5>
                <span>Employee Details</span>
        </div>
        <!-- <div class="card-body">
            <form id="emp_form" method="post" action="javascript:void(0)" novalidate="">
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Simple Input</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="name" id="name" placeholder="Text  Input  Validation"> <span class="messages"></span>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2  col-form-label">Password</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password input"> <span class="messages"></span>
                    </div>
                </div>
                <div class="form-group  row">
                    <label class="col-sm-2 col-form-label">Repeat Password</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" id="repeat-password" name="repeat-password" placeholder="Repeat  Password"> <span class="messages"></span>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter valid e-mail address"> <span class="messages"></span>
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-2 col-form-label">Radio Buttons</label>
                    <div class="col-sm-10">
                        <div class="form-check  form-check-inline">
                            <label class="form-check-label">
                                <input class="form-check-input" type="radio" name="gender" id="gender-1" value="option1">Male</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <label class="form-check-label">
                                <input class="form-check-input" type="radio" name="gender" id="gender-2" value="option2">Female</label>
                        </div> <span class="messages"></span>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2"></label>
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary m-b-0">Submit</button>
                    </div>
                </div>
            </form>
        </div> -->
        <div class="card-block">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div id="wizard">
                                                                    <section>
                                                                        <form class="wizard-form" id="example-advanced-form" action="#">
                                                                            <h3> Registration </h3>
                                                                            <fieldset>
                                                                                <div class="form-group row">
                                                                                    <div class="col-md-4 col-lg-2">
                                                                                        <label for="userName-2" class="block">User name *</label>
                                                                                    </div>
                                                                                    <div class="col-md-8 col-lg-10">
                                                                                        <input id="userName-2" name="userName" type="text" class="required form-control">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group row">
                                                                                    <div class="col-md-4 col-lg-2">
                                                                                        <label for="email-2" class="block">Email *</label>
                                                                                    </div>
                                                                                    <div class="col-md-8 col-lg-10">
                                                                                        <input id="email-2" name="email" type="email" class="required form-control">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group row">
                                                                                    <div class="col-md-4 col-lg-2">
                                                                                        <label for="password-2" class="block">Password *</label>
                                                                                    </div>
                                                                                    <div class="col-md-8 col-lg-10">
                                                                                        <input id="password-2" name="password" type="password" class="form-control required">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group row">
                                                                                    <div class="col-md-4 col-lg-2">
                                                                                        <label for="confirm-2" class="block">Confirm Password *</label>
                                                                                    </div>
                                                                                    <div class="col-md-8 col-lg-10">
                                                                                        <input id="confirm-2" name="confirm" type="password" class="form-control required">
                                                                                    </div>
                                                                                </div>
                                                                            </fieldset>
                                                                            <h3> General information </h3>
                                                                            <fieldset>
                                                                                <div class="form-group row">
                                                                                    <div class="col-md-4 col-lg-2">
                                                                                        <label for="name-2" class="block">First name *</label>
                                                                                    </div>
                                                                                    <div class="col-md-8 col-lg-10">
                                                                                        <input id="name-2" name="name" type="text" class="form-control required">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group row">
                                                                                    <div class="col-md-4 col-lg-2">
                                                                                        <label for="surname-2" class="block">Last name *</label>
                                                                                    </div>
                                                                                    <div class="col-md-8 col-lg-10">
                                                                                        <input id="surname-2" name="surname" type="text" class="form-control required">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group row">
                                                                                    <div class="col-md-4 col-lg-2">
                                                                                        <label for="phone-2" class="block">Phone #</label>
                                                                                    </div>
                                                                                    <div class="col-md-8 col-lg-10">
                                                                                        <input id="phone-2" name="phone" type="number" class="form-control required phone">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group row">
                                                                                    <div class="col-md-4 col-lg-2">
                                                                                        <label for="date" class="block">Date Of Birth</label>
                                                                                    </div>
                                                                                    <div class="col-md-8 col-lg-10">
                                                                                        <input id="date" name="Date Of Birth" type="text" class="form-control required date-control">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group row">
                                                                                    <div class="col-md-4 col-lg-2">Select Country</div>
                                                                                    <div class="col-md-8 col-lg-10">
                                                                                        <select class="form-control required">
                                                                                            <option>Select State</option>
                                                                                            <option>Gujarat</option>
                                                                                            <option>Kerala</option>
                                                                                            <option>Manipur</option>
                                                                                            <option>Tripura</option>
                                                                                            <option>Sikkim</option>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                            </fieldset>
                                                                            <h3> Education </h3>
                                                                            <fieldset>
                                                                                <div class="form-group row">
                                                                                    <div class="col-md-4 col-lg-2">
                                                                                        <label for="University-2" class="block">University</label>
                                                                                    </div>
                                                                                    <div class="col-md-8 col-lg-10">
                                                                                        <input id="University-2" name="University" type="text" class="form-control required">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group row">
                                                                                    <div class="col-md-4 col-lg-2">
                                                                                        <label for="Country-2" class="block">Country</label>
                                                                                    </div>
                                                                                    <div class="col-md-8 col-lg-10">
                                                                                        <input id="Country-2" name="Country" type="text" class="form-control required">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group row">
                                                                                    <div class="col-md-4 col-lg-2">
                                                                                        <label for="Degreelevel-2" class="block">Degree level #</label>
                                                                                    </div>
                                                                                    <div class="col-md-8 col-lg-10">
                                                                                        <input id="Degreelevel-2" name="Degree level" type="text" class="form-control required phone">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group row">
                                                                                    <div class="col-md-4 col-lg-2">
                                                                                        <label for="datejoin" class="block">Date Join</label>
                                                                                    </div>
                                                                                    <div class="col-md-8 col-lg-10">
                                                                                        <input id="datejoin" name="Date Of Birth" type="text" class="form-control required">
                                                                                    </div>
                                                                                </div>
                                                                            </fieldset>
                                                                            <h3> Work experience </h3>
                                                                            <fieldset>
                                                                                <div class="form-group row">
                                                                                    <div class="col-md-4 col-lg-2">
                                                                                        <label for="Company-2" class="block">Company:</label>
                                                                                    </div>
                                                                                    <div class="col-md-8 col-lg-10">
                                                                                        <input id="Company-2" name="Company:" type="text" class="form-control required">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group row">
                                                                                    <div class="col-md-4 col-lg-2">
                                                                                        <label for="CountryW-2" class="block">Country</label>
                                                                                    </div>
                                                                                    <div class="col-md-8 col-lg-10">
                                                                                        <input id="CountryW-2" name="Country" type="text" class="form-control required">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group row">
                                                                                    <div class="col-md-4 col-lg-2">
                                                                                        <label for="Position-2" class="block">Position</label>
                                                                                    </div>
                                                                                    <div class="col-md-8 col-lg-10">
                                                                                        <input id="Position-2" name="Position" type="text" class="form-control required">
                                                                                    </div>
                                                                                </div>
                                                                            </fieldset>
                                                                        </form>
                                                                    </section>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
    </div>
    <!-- Basic Inputs Validation end -->
<?php } ?>
    
