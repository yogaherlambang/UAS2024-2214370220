<?php

namespace App\Library;

class WelcomeMailTemplate
{
    public static function create(string $email, string $password): string
    {
        
        $template = '
            <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">

            <body style="padding: 0; margin: 0; font-family: roboto;">
                <div class="container" style="display: flex;flex-direction: column; padding: 40px;">
                    <div class="logo text-center" style="margin-top: 20px;margin-bottom: 30px; text-align:center">
                        <img width="250px" src="https://drive.google.com/uc?export=view&id=1JtnwY1gKQ1S-mrZaIbGej0IsiOztW5ys"
                            alt="Logo">
                    </div>
            
                    <p style="font-size: 14px; color: #5B5959;">We welcome you to our <a
                            style="color: #9901FF; text-decoration: none" href="https://synchlab.dev">Synchlab.dev</a> blog</p>
                    <br>
                    <p style="font-size: 14px; color: #5B5959;">Your account has been created at blog.synchlab.dev, Please press the
                        button below
                        to login</p>
            
                    <strong><span style="font-size: 14px; color: #5B5959;">Your username and password:</span></strong>
                    <br>
                    <span style="font-size: 14px; color: #5B5959; text-decoration: none"><strong>Email:</strong>
                        '.$email.'</span><br>
                    <span style="font-size: 14px; color: #5B5959;"><strong>Password:</strong> '.$password.'</span>
            
                    <div class="btn-holder text-center" style="text-align: center; margin-top:30px; margin-bottom:30px;">
                        <a style="height: 40px;
                        color: #fff;
                        border: none;
                        font-weight: bold;
                        padding: 10px 10px 10px 10px;
                        width: 250px;
                        margin-top: 20px;
                        margin-bottom: 20px;
                        cursor: pointer;
                        background-color: #9901FF;" traget="_blank" href="https://admin.blog.synchlab.dev/" class="btn btn-call">Please login</a>
                    </div>
                    <p style="font-size: 14px; color: #5B5959;">If you are having trouble to clicking the login button, copy and
                        paste the url below into your browser </p>
                    <a style="font-size: 14px;
                    color: #0D66EC;
                    text-decoration: none;" traget="_blank" href="">https://admin.blog.synchlab.dev/</a>
                </div>
            
                <div class="footer" style="margin-top: 60px;
                width: 100%;
                height: 150px;
                background-color: #F1F1F1;
                text-align: center;">
                    <div style="padding-top: 7%">
                        <p style="font-size: 12px;color: #9E9E9E; ">1947-2019 © Synchlab.dev. All rights reserved
                        </p>
            
                        <span style="font-size: 12px;color: #9E9E9E;">Synchlab.dev</span> <br>
                        <span style="font-size: 12px;color: #9E9E9E;">Guwahati, Assam, India </span>
                    </div>
                </div>
            </body>
        ';

        return $template;
    }
}
