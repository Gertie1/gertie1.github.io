<html>
<head>
    <style>
        #color{
            color: #1e1e2a;
        }
    </style>
</head>
<nav class="navbar-default navbar-static-side" role="navigation" id="color">
    <!-- sidebar-collapse -->
    <div class="sidebar-collapse">
        <!-- side-menu -->
        <ul class="nav" id="side-menu">
            <li>
                <!-- user image section-->
                <div class="user-section">
                    <div class="user-section-inner">
                        <img src="../resources/assets/assets/img/user.jpg" alt="">
                    </div>
                    <!--<div class="user-info">
                        <div>Jonny <strong>Deen</strong></div>
                        <div class="user-text-online">
                            <span class="user-circle-online btn btn-success btn-circle "></span>&nbsp;Online
                        </div>
                    </div>-->
                </div>
                <!--end user image section-->
            </li>
            </br></br>
            <!-- search section-->
            <!--
            <li class="sidebar-search">

                <div class="input-group custom-search-form">
                    <input type="text" class="form-control" placeholder="Search...">
                    <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                </div>

            </li>-->
            <!--end search section-->
            <li class="">
                <a href="{!! URL::route('home') !!}"><i class="fa fa-dashboard fa-fw"></i>Dashboard</a>
            </li>

            {{--<li>
                <a href="{!! URL::route('users') !!}"><i class="fa fa-flask fa-fw"></i>Users</a>
            </li>--}}
            <li>
                <a href="{!! URL::route('drugs') !!}"><i class="fa fa-tablet fa-fw"></i>Drugs</a>
            </li>
           {{-- <li>
                <a href="{!! URL::route('diseases') !!}"><i class="fa fa-hospital-o fa-fw"></i>Diseases</a>
            </li>--}}
            {{--<li>
                <a href="{!! URL::route('form2') !!}"><i class="fa fa-flask fa-fw"></i>Mapping</a>
            </li>
            <li>
                <a href="{!! URL::route('display') !!}"><i class="fa fa-table fa-fw"></i>Display</a>
            </li>--}}

            <li>
                <a href="{!! URL::route('stock') !!}"><i class="fa fa-euro fa-fw"></i>Stock_In</a>
            </li>
            <li>
                <a href="{!! URL::route('sales') !!}"><i class="fa fa-euro fa-fw"></i>Stock_Out</a>
            </li>
            <li>
                <a href="{!! URL::route('blank') !!}"><i class="fa fa-barcode fa-fw"></i>Charts</a>
            </li>

            <li>
                <a href="{!! URL::route('track') !!}"><i class="fa fa-edit fa-fw"></i>Tracking</a>
            </li>
            <li>
                <a href="{!! URL::route('likely') !!}"><i class="fa fa-edit fa-fw"></i>Advice</a>
            </li>



        </ul>
        <!-- end side-menu -->
    </div>
    <!-- end sidebar-collapse -->
</nav>
</html>