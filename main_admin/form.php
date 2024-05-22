 <?php include('header.php'); ?>
 
        <!-- BEGIN PAGE CONTENT -->
        <div class="page-content">
          <div class="header">
            <h2>Tables <strong>Dynamic</strong></h2>
            <div class="breadcrumb-wrapper">
              <ol class="breadcrumb">
                <li><a href="dashboard.html">Make</a>
                </li>
                <li><a href="tables.html">Tables</a>
                </li>
                <li class="active">Tables Dynamic</li>
              </ol>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12 portlets">
				<div class="panel panel-default no-bd">
                <div class="panel-header bg-dark">
                  <h2 class="panel-title"><strong>Sign Up</strong> to our website</h2>
                </div>
                <div class="panel-body bg-white">
                  <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <form role="form" class="form-validation">
                        <div class="row">
                          <div class="col-sm-6">
                            <div class="form-group">
                              <label class="control-label">Firstname</label>
                              <div class="append-icon">
                                <input type="text" name="firstname" class="form-control" minlength="3" placeholder="Minimum 3 characters..." required>
                                <i class="icon-user"></i>
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-6">
                            <div class="form-group">
                              <label class="control-label">Lastname</label>
                              <div class="append-icon">
                                <input type="text" name="lastname" class="form-control" minlength="4" placeholder="Minimum 4 characters..." required>
                                <i class="icon-user"></i>
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-6">
                            <div class="form-group">
                              <label class="control-label">Email Address</label>
                              <div class="append-icon">
                                <input type="email" name="email" class="form-control" placeholder="Enter your email..." required>
                                <i class="icon-envelope"></i>
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-6">
                            <div class="form-group">
                              <label class="control-label">Choose your language</label>
                              <div class="option-group">
                                <select id="language" name="language" class="language" required>
                                  <option value="">Select language...</option>
                                  <option value="EN">English</option>
                                  <option value="FR">French</option>
                                  <option value="SP">Spanish</option>
                                  <option value="CH">Chinese</option>
                                  <option value="JP">Japanese</option>
                                </select>
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-6">
                            <div class="form-group">
                              <label class="control-label">Phone Number</label>
                              <div class="append-icon">
                                <input type="text" name="mobile" class="form-control" placeholder="Mobile Number..." minlength="3" required>
                                <i class="icon-screen-smartphone"></i>
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-6">
                            <div class="form-group">
                              <label class="control-label">Upload your avatar</label>
                              <div class="file">
                                <div class="option-group">
                                  <span class="file-button btn-primary">Choose File</span>
                                  <input type="file" class="custom-file" name="avatar" id="avatar" onchange="document.getElementById('uploader').value = this.value;" required>
                                  <input type="text" class="form-control" id="uploader" placeholder="no file selected" readonly="">
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-6">
                            <div class="form-group">
                              <label class="control-label">Password</label>
                              <div class="append-icon">
                                <input type="password" name="password" id="password" class="form-control" placeholder="Between 4 and 16 characters" minlength="4" maxlength="16" required>
                                <i class="icon-lock"></i>
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-6">
                            <div class="form-group">
                              <label class="control-label">Repeat your password</label>
                              <div class="append-icon">
                                <input type="password" name="password2" id="password2" class="form-control" placeholder="Must be equal to your first password..." minlength="4" maxlength="16" required>
                                <i class="icon-lock"></i>
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-6">
                            <div class="form-group">
                              <label class="control-label">What's the result of 4 + 8 ?</label>
                              <input type="text" name="calcul" class="form-control" placeholder="Human verification!">
                            </div>
                          </div>
                          <div class="col-sm-6">
                            <div class="form-group">
                              <label class="control-label">Are you OK with our terms?</label>
                              <div class="option-group">
                                <label  for="terms" class="m-t-10">
                                <input type="checkbox" name="terms" id="terms" data-checkbox="icheckbox_square-blue" required/>
                                I agree with terms and conditions
                                </label>    
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="text-center  m-t-20">
                          <button type="submit" class="btn btn-embossed btn-primary">Sign Up</button>
                          <button type="reset" class="cancel btn btn-embossed btn-default m-b-10 m-r-0">Cancel</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          
		   <?php include('footer.php'); ?>