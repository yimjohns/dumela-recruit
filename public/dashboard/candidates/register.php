<?php 

?>

<h3>New Candidate</h3>
    <form method="post" enctype="multipart/form-data">
        <input type="hidden" name="candidate_action" value="create">

        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="form-group">
                    <label>First Name</label>
                    <input type="text" name="first_name" class="form-control" required>
                </div>
            </div>
            <div class="col-md-6 col-sm-12">
                <div class="form-group">
                    <label>Middle Name</label>
                    <input type="text" name="middle_name" class="form-control">
                </div>
            </div>
        </div>
        
        
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="form-group">
                    <label>Last Name</label>
                    <input type="text" name="last_name" class="form-control" required>
                </div>
            </div>

            <div class="col-md-6 col-sm-12">
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
            </div>
        </div>
            

        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="form-group">
                    <label>Country</label>
                    <input type="text" name="country" class="form-control" required>
                </div>
            </div>

            <div class="col-md-6 col-sm-12">
                <div class="form-group">
                    <label>State</label>
                    <input type="text" name="state" class="form-control" required>
                </div>
            </div>
        </div>
                
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="form-group">
                    <label>City</label>
                    <input type="text" name="city" class="form-control" required>
                </div>
            </div>
            <div class="col-md-6 col-sm-12">
                <div class="form-group">
                    <label>Job Title</label>
                    <input type="text" name="job_title" class="form-control" required>
                </div>
            </div>
        </div>        
                
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="form-group">
                    <label>Level</label>
                    <select name="level" class="form-control" required>
                        <option value="Entry">Entry</option>
                        <option value="Junior">Junior</option>
                        <option value="Intermediate">Intermediate</option>
                        <option value="Senior">Senior</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6 col-sm-12">
                <div class="form-group">
                    <label>Resume</label>
                    <input type="file" name="resume" class="form-control" required>
                </div>
            </div>
        </div>        
        <br>
        <div class="row">
            <div class="col">
                <button type="submit" class="btn btn-info btn-block">Create Candidate</button>
            </div>
        </div>  
    </form>
