<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title></title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.6/css/materialize.min.css">
        <style media="screen">
        h4 {
            cursor: default;
        }
        h4:hover {
            cursor: pointer;
        }
        .menuButton {
            text-align: center;
            height: 35px;
        }
        .menuButton :hover, .menuButton .selected:hover {
            cursor: pointer;
            background: rgba(77, 169, 156, 0.79);
                height: 100%;
                padding-top: 5px;
                color: white;
                box-shadow: 3px 3px 3px rgba(144, 144, 144, 0.5);
                border-radius: 2px;
        }
        .menuButton .selected{
            height: 100%;
            padding-top: 5px;
            background: rgba(27, 126, 115, 0.85);
            color: white;
            box-shadow: 3px 3px 3px rgba(144, 144, 144, 0.5);
            border-radius: 2px;
        }
        .menuButton li {
            height: 100%;
            padding-top: 5px;
            background: rgba(27, 126, 115, 0.35);
            color: white;
            box-shadow: 3px 3px 3px rgba(144, 144, 144, 0.5);
            border-radius: 2px;
        }
        .row {
            margin-bottom: 0;
        }
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
            <?php if ($this->session->userdata('currUser')): ?>
                <div class="row" style="margin-top: -1em; margin-bottom: 0">
                    <ul>
                        <div class="menuButton col s6">
                            <li class="selected">Add</li>
                        </div>
                        <div class="menuButton col s6">
                            <li>View</li>
                        </div>
                    </ul>
                </div>
            <?php endif; ?>

            <div class="row">
                <div class="col s6">
                    <!-- User Details -->
                    <?php if (!$this->session->userdata('currUser')): ?>
                        <h3>Login</h3>
                        <form action="/checkLogin" method="post" class="checkLogin">
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
                                    <button type="submit" class="btn waves-effect waves-light loginButton">
                                        Log In
                                        <i class="material-icons left"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    <?php endif; ?>
                </div>
            </div>


            <div class="view">
                <div class="row">
                    <div class="col s12">
                        <h4>User - Tags</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col s12">
                        <table class="centered bordered">
                            <tr>
                                <td>&nbsp;</td>
                                <?php $arr = array(); ?>
                                <?php foreach ($tags as $key => $value): ?>
                                    <td><?= $value['tag'] ?></td>

                                    <?php array_push($arr, $value['tag']); ?>
                                <?php endforeach; ?>
                            </tr>
                            <?php foreach ($users as $key => $value): ?>
                                <tr>
                                    <td><?= $value['username'] ?></td>
                                    <?php foreach ($tags as $k => $val): ?>
                                        <td>
                                            <?php foreach($userTags as $kk => $v): ?>
                                                <?php if ($v['tag'] == $val['tag'] && $v['username'] == $value['username']): ?>
                                                    <?= $v['count']; ?>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </td>
                                    <?php endforeach; ?>
                                </tr>
                            <?php endforeach; ?>
                            <?php //var_dump($userTags); ?>
                        </table>
                    </div>
                </div>
            </div>




            <div class="add">
                    <div class="row" style="padding: 10px">
                        <div class="col s6">
                            <div class="row">
                                <?php if ($this->session->userdata('currUser')): ?>
                                    <h4 id="addTag" class="addRowLabel">Add Tag/Activity</h4>
                                    <form class="registerRowForm addTagForm" action="/addTag" method="post">
                                        <div class="row">
                                            <div class="input-field col s6">
                                                <input class="validate" type="text" name="newTag">
                                                <label for="newTag">Tag Name</label>
                                            </div>
                                            <div class="col s5">
                                                <button type="submit" class="btn waves-effect waves-light" style="float:right">
                                                    Add Tag
                                                    <i class="material-icons left"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                <?php endif; ?>
                            </div>
                            <div class="row">
                                <?php if ($this->session->userdata('currUser')): ?>
                                    <form class="registerRowForm addActivityForm" action="/addActivity" method="post">
                                        <div class="row">
                                            <div class="input-field col s6">
                                                <input class="validate" type="text" name="newActivity" required>
                                                <label for="newActivity">Activity Name</label>
                                            </div>
                                            <div class="input-field col s6">
                                                <input class="validate" type="text" name="keywords" required>
                                                <label for="keywords">Keywords</label>
                                            </div>
                                            <div class="col s5 offset-s6">
                                                <button type="submit" class="btn waves-effect waves-light" style="float:right">
                                                    Add Activity
                                                    <i class="material-icons left"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col s6">
                            <?php if ($this->session->userdata('currUser')): ?>
                                <h4 id="register" class="addRowLabel">Register New User</h4>
                                <form class="registerRowForm addUserForm" action="/addUser" method="post">
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
                            <h4 class="addTagLabels" id="userTag">User - Tags</h4>
                            <!-- User Tags -->
                            <!-- Select all users as a select with value of the user_id -->
                            <!-- Select all tags as a select with value of the tag_id -->
                            <form class="addTagForms addUserTagForm" id="userTagForm" action="/addUserTag" method="post">
                                <div class="row">
                                    <div class="input-field col s6">
                                        <select name="user" class="validate User" required>
                                            <option value="" disabled selected>User</option>
                                            <?php foreach ($users as $key => $value): ?>
                                                <option value="<?= $value['id'] ?>"><?= $value['username'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="input-field col s6">
                                        <select name="tag" class="validate Tag" required>
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
                            <h4 class="addTagLabels" id="activityTag">Activity - Tags</h4>
                            <!-- Activities Tags -->
                            <!-- Select all activities as a select with the value of the activity_id -->
                            <!-- Select all tags as a select with value of the tag_id -->
                            <form class="addTagForms addActivityTagForm" id="activityTagForm" action="/addActivityTag" method="post">
                                <div class="row">
                                    <div class="input-field col s6">
                                        <select class="validate Activity" name="activity" required>
                                            <option value="" disabled selected>Activity</option>
                                            <?php foreach($activities as $key=>$value): ?>
                                                <option value="<?= $value['id'] ?>"><?= $value['activity'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="input-field col s6">
                                        <select class="validate Tag" name="tag" required>
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
            </div><!-- End Add Views -->







        </div><!-- End Container -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.3/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.6/js/materialize.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                var bool = true;

                $('select').material_select();
                $('.addTagForms').hide();
                $('.view').hide();

                // $('.checkLogin').submit(function() {
                //     event.preventDefault();
                //     console.log($(this).serialize() );
                //
                //     var dataSerialized = $(this).serialize();
                //
                //     $.post('/addTag', dataSerialized, function(res){
                //         console.log(res);
                //     });
                // })
                $('.addTagForm').submit(function() {
                    event.preventDefault();
                    console.log($(this).serialize() );

                    var dataSerialized = $(this).serialize();

                    $.post('/addTag', dataSerialized, function(res){
                        console.log(res);
                    });
                    $(this).trigger('reset');
                })
                $('.addActivityForm').submit(function() {
                    event.preventDefault();
                    console.log($(this).serialize() );

                    var dataSerialized = $(this).serialize();

                    $.post('/addActivity', dataSerialized, function(res){
                        console.log(res);
                    });
                })
                $('.addUserForm').submit(function() {
                    event.preventDefault();
                    console.log($(this).serialize() );

                    var dataSerialized = $(this).serialize();

                    $.post('/addUser', dataSerialized, function(res){
                        console.log(res);
                    });
                })
                $('.addUserTagForm').submit(function() {
                    event.preventDefault();
                    console.log($(this).serialize() );

                    var dataSerialized = $(this).serialize();

                    $.post('/addUseTag', dataSerialized, function(res){
                        console.log(res);
                    });
                })
                $('.addActivityTagForm').submit(function() {
                    event.preventDefault();
                    console.log($(this).serialize() );

                    var dataSerialized = $(this).serialize();

                    $.post('/addActivityTag', dataSerialized, function(res){
                        console.log(res);
                    });
                })

                $('.addRowLabel').click(function() {
                    //Toggle form under it
                    $('.registerRowForm').slideToggle();
                    $('.addTagForms').slideUp();
                })
                $('.addTagLabels').click(function() {
                    //Toggle form under it
                    $('.addTagForms').slideToggle();
                    $('.registerRowForm').slideUp();
                })

                $('.menuButton').click(function() {
                    var self = $(this);

                    if (self.children().attr('class') != 'selected') {

                        $('.selected').removeClass('selected');

                        $(this).children().addClass('selected');
                        if (!bool) {
                            $('.view').slideUp().delay(100).queue(function() {
                                $('.add').slideDown();

                                $(this).dequeue();
                            })

                            bool = true;
                        } else {
                            $('.add').slideUp().delay(100).queue(function() {
                                $('.view').slideDown();

                                $(this).dequeue();
                            })

                            bool = false;
                        }
                    }
                })
            })
        </script>
    </body>
</html>
