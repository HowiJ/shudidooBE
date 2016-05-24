<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title></title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.6/css/materialize.min.css">
        <style media="screen">

        </style>
    </head>
    <body>
        <?php if ($this->session->userdata('currUser')): ?>
            <?php //Variable currUser is now set as currUser if currUser exists ?>
            <?php $currUser = $this->session->userdata('currUser'); ?>
        <?php endif; ?>



        <div class="container">



            <div class="row">
                <?php if ($this->session->userdata('currUser')): ?>
                    <div class="col s10">
                            <h3>Welcome back, <?php echo $this->session->userdata('currUser')['username']; ?></h3>
                    </div>
                    <div class="col s2" style="margin-top: 2rem">
                            <a href="logout">Log Out</a>
                    </div>
                <?php endif; ?>
            </div>

            <div class="row">
                <div class="col s6">
                    <!-- User Details -->
                    <?php if (!$this->session->userdata('currUser')): ?>
                        <h3>Login</h3>
                        <form action="/checkLogin" method="post">
                            <div class="row">
                                <!-- <div class="col s3">Username: </div> -->
                                <div class="input-field col s12">
                                    <input type="text" name="username" required>
                                    <label for="name">Username</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <input type="password" name="password" required>
                                    <label for="password">Password</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12">
                                    <button type="submit" class="btn waves-effect waves-light">
                                        Log In
                                        <i class="material-icons left"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    <?php endif; ?>
                </div>


                <div class="col s6 offset-s6">
                    <?php if ($this->session->userdata('currUser')): ?>
                        <h4>Register New User</h4>
                        <form action="/addUser" method="post">
                            <div class="row">
                                <div class="input-field col s12">
                                    <input class="validate" type="text" name="username" required>
                                    <label for="username">Username</label>
                                </div>
                            </div>


                            <div class="row">
                                <div class="input-field col s6">
                                    <input class="validate" type="password" name="password" required>
                                    <label for="password" data-error="Please enter a password">Password</label>
                                </div>
                                <div class="input-field col s6">
                                    <input class="validate" type="password" required>
                                    <label for="confirmPassword" data-error="Please confirm password">Confirm Password</label>
                                </div>
                            </div>


                            <div class="row">
                                <div class="input-field col s6">
                                    <input type="number" name="age" min="1" required>
                                    <label for="age" data-error="Please Enter an Age">Age</label>
                                </div>
                                <div class="input-field col s6">
                                    <button type="submit" class="btn waves-effect waves-light" style="float:right">
                                        Register
                                        <i class="material-icons left"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    <?php endif; ?>
                </div>

            </div><!-- End Row User -->






            <?php if ($this->session->userdata('currUser')): ?>
            <div class="row">

                <div class="col s6">
                    <h4>User - Tags</h4>
                    <!-- User Tags -->
                    <!-- Select all users as a select with value of the user_id -->
                    <!-- Select all tags as a select with value of the tag_id -->
                    <form action="/addUserTag" method="post">
                        <div class="row">
                            <div class="input-field col s6">
                                <select name="user" class="validate" required>
                                    <option value="" disabled selected>User</option>
                                    <?php foreach ($users as $key => $value): ?>
                                        <option value="<?= $value['id'] ?>"><?= $value['username'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="input-field col s6">
                                <select name="tag" class="validate" required>
                                    <option value="" disabled selected>Tag</option>
                                    <?php foreach($tags as $key => $value): ?>
                                        <option value="<?= $value['id'] ?>"><?= $value['tag'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s6" style="margin-top:1rem">
                                <input type="number" name="count" value="1" min="0" required>
                                <label for="count"></label>
                            </div>
                            <div class="col s6" style="margin-top:1rem">
                                <button type="submit" class="btn waves-effect waves-light" style="float:right">
                                    Add
                                    <i class="material-icons left"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                    <?php //var_dump($userTags); ?>
                </div> <!-- End User Tags -->




                <div class="col s6">
                    <h4>Activity - Tags</h4>
                    <!-- Activities Tags -->
                    <!-- Select all activities as a select with the value of the activity_id -->
                    <!-- Select all tags as a select with value of the tag_id -->
                    <form action="/addActivityTag" method="post">
                        <div class="row">
                            <div class="input-field col s6">
                                <select class="validate" name="activity" required>
                                    <option value="" disabled selected>Activity</option>
                                    <?php foreach($activities as $key=>$value): ?>
                                        <option value="<?= $value['id'] ?>"><?= $value['activity'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="input-field col s6">
                                <select class="validate" name="tag" required>
                                    <option value="" disabled selected>Tag</option>
                                    <?php foreach ($tags as $key => $value) : ?>
                                        <option value="<?= $value['id'] ?>"><?= $value['tag'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s6 offset-s6" style="margin-top:1rem">
                                <button type="submit" class="btn waves-effect waves-light" style="float:right">
                                    Add
                                    <i class="material-icons left"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                    <?php //var_dump($activityTags); ?>
                </div> <!-- End Activity Tags -->

            </div><!-- End Tags Row -->
            <?php endif; ?>







        </div><!-- End Container -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.3/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.6/js/materialize.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $('select').material_select();
            })
        </script>
    </body>
</html>
