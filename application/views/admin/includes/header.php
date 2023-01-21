<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <link rel="shortcut icon" type="image/png" href="<?php echo base_url('images/phatsisa-logo-bg.png'); ?>">
        <title>Phatsisa | <?= $title ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <!-- Bootstrap core CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <!--Fontawesome core css-->
        <link href="<?php echo base_url('bootstrap/font-awesome/css/font-awesome.min.css'); ?>" rel="stylesheet" type="text/css"/>
        <!-- Your customable style sheet (optional) -->
        <link href="<?php echo base_url('bootstrap/css/styles.css'); ?>" rel="stylesheet" type="text/css"/>
        <!--Below is the toastr plugin link -->
        <link href="<?php echo base_url('bootstrap/toastr//toastr.min.css'); ?>" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url('bootstrap/toastr//toastr.css'); ?>" rel="stylesheet" type="text/css"/>
        <!-- Google fonts link -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
        <!-- DataTable Style -->
        <link href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    </head>
    <body style="font-family: 'Montserrat', sans-serif;">
        <nav class="navbar navbar-light sticky-top  bg-white navbar-expand-md border-bottom">
            <div class="container-fluid">
                <a class="navbar-brand" href="<?php echo base_url('dashboard');?>">
                    <img src="<?php echo base_url('images/phatsisa-logo-bg.png'); ?>" class="img-fluid" width="50vh" />
                    <b>Phatsisa Inc.</b>
                </a>
                <button data-toggle="collapse" data-target="#navcol-1" class="navbar-toggler">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse d-md-flex justify-content-md-end" id="navcol-1">
                    <ul class="nav navbar-nav">
                        <li role="presentation" class="nav-item"><a class="nav-link active" href="<?php echo base_url(); ?>dashboard">Dashboard</a></li>
                        <li role="presentation" class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>customer">Customer</a></li>
                        <li role="presentation" class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>driver">Driver</a></li>
                        <li role="presentation" class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>order">Order</a></li>
                        <li role="presentation" class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>report">Reports</a></li>
                        <li class="nav-item dropdown">
                            <a data-toggle="dropdown" aria-expanded="false" class="dropdown-toggle nav-link" href="#">
                                Good day <?php echo $_SESSION['is_session_on']['usr_fname']; ?> ?
                                <img src="<?php echo base_url('images/img-user-sm.png'); ?>" class="rounded-circle" width="30px" />
                            </a>
                            <div role="menu" class="dropdown-menu dropdown-menu-left">
                                <a role="presentation" class="dropdown-item" href="<?php echo base_url('profile'); ?>"><i class="fa fa-user-circle mr-2"></i>Profile</a>
                                <div class="dropdown-divider"></div>
                                <a role="presentation" class="dropdown-item" href="#"><i class="fa fa-cog mr-2"></i>Settings</a>
                                <div class="dropdown-divider"></div>
                                <a role="presentation" class="dropdown-item" href="<?php echo base_url('signout'); ?>"><i class="fa fa-sign-out mr-2"></i>Sign Out</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
