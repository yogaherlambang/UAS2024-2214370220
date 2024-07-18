

<div id="content-wrapper">

    <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="/users">User</a>
            </li>
            <li class="breadcrumb-item active">Update user</li>
          
        </ol>
        <div class="text-right my-2" id="msg"></div> 
        <div class="row">
            <div class="col-lg-12">
             
        
                <div class="card mb-3">
                    <div class="card-body">
                        <form id="formUserUpdate" enctype="multipart/form-data" method="POST" onsubmit="updateUser(event)">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="hidden" name="id" value="<?= $user->id ?>">
                                        <input type="text" id="name" name="name" class="form-control" placeholder="Enter name"
                                            value="<?php  echo isset($user) ? htmlspecialchars($user->name) : null ?> ">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label>UserName</label>
                                        <input type="text" id="username" name="username" class="form-control" placeholder="Enter username"
                                            value="<?php  echo isset($user) ? htmlspecialchars($user->username) : null ?> ">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label>Designation</label>
                                        <input type="text" id="designation" name="designation" class="form-control" placeholder="Enter designation"
                                            value="<?php  echo isset($user) ? htmlspecialchars($user->work) : null ?> ">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label>Avatar</label>
                                        <input type="text" id="avatar" name="avatar" class="form-control"
                                            placeholder="Enter avatar url" value="<?php  echo isset($user) ? $user->avatar   : null ?> ">

                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label>Facebook</label>
                                        <input type="text" id="facebook" name="facebook" class="form-control"
                                            placeholder="Enter your facebook url" value="<?php  echo isset($user) ? htmlspecialchars($user->facebook) : null ?> ">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label>Linkedin</label>
                                        <input type="text" id="linkedin" name="linkedin" class="form-control"
                                            placeholder="Enter your linkedin url" value="<?php  echo isset($user) ? htmlspecialchars($user->linkedin) : null ?> ">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label>Twitter</label>
                                        <input type="text" id="twitter" name="twitter" class="form-control"
                                            placeholder="Enter your twitter url" value="<?php  echo isset($user) ? htmlspecialchars($user->twitter) : null ?> ">

                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label>Github</label>
                                        <input type="text" id="github" name="github" class="form-control"
                                            placeholder="Enter your github url" value="<?php  echo isset($user) ? htmlspecialchars($user->github) : null ?> ">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label>Website</label>
                                        <input type="text" id="website" name="website" class="form-control"
                                            placeholder="Enter your website url" value="<?php  echo isset($user) ? htmlspecialchars($user->website) : null ?> ">
                                    </div>
                                </div>
                            </div>
                            <div class=" row">
                               

                                <div class="col-lg-8">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="text" id="email" name="email" class="form-control"
                                            placeholder="Enter password" value="<?php  echo isset($user) ? htmlspecialchars($user->email) : null ?> ">
                                    </div>
                                </div>

                            </div>


                            <div class="form-group">
                                <label>About</label>
                                <textarea class="form-control" id="about" name="about" id="editor"
                                    placeholder="Tell me about yourself....."><?php  echo isset($user) ? htmlspecialchars($user->about) : null ?> </textarea>

                            </div>


                            <button type="submit" class="btn btn-primary float-right mb-3">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
