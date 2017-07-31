        <!-- BEGIN CONTENT -->
        <div class="page-content-wrapper">
            <!-- BEGIN CONTENT BODY -->
            
            <!-- BEGIN PAGE HEAD-->
            <!-- <div class="page-head">
                <div class="container"> -->
                    <!-- BEGIN PAGE TITLE -->
                    <!-- <div class="page-title">
                        <h1>Blank Page </h1>
                    </div> -->
                    <!-- END PAGE TITLE -->
                <!-- </div>
            </div> -->
            <!-- END PAGE HEAD-->

            <!-- BEGIN PAGE CONTENT BODY -->
            <div class="page-content">
                <div class="container">
                    
                    <!-- BEGIN PAGE BREADCRUMBS -->
                    <!-- <ul class="page-breadcrumb breadcrumb">
                        <li>
                            <a href="index.html">Home</a>
                            <i class="fa fa-circle"></i>
                        </li>
                        <li>
                            <span>Layouts</span>
                        </li>
                    </ul> -->
                    <!-- END PAGE BREADCRUMBS -->

                    <!-- BEGIN PAGE CONTENT INNER -->
                    <div class="page-content-inner">

                        <div class="portlet light ">
                            
                            <!-- <div class="portlet-title">
                                <div class="caption">
                                    <i class="icon-bubble font-green-sharp"></i>
                                    <span class="caption-subject font-green-sharp sbold">Extended Modals Example</span>
                                </div>
                            </div> -->

                            <div class="portlet-body">
                                
                                <div class="tiles">

                                    <?php
                                        if ($mainmenu) {
                                        //MAINMENU
                                            foreach ($mainmenu->result() as $row) {
                                                if ($row->menu_link != "#") {
                                                    $anchor = '<a href="'.base_url($row->menu_link).'">';
                                                } else {
                                                    $anchor = '<a>';
                                                }

                                                echo '
                                                '.$anchor.'
                                                <div class="tile '.$row->menu_color.'">
                                                    <div class="tile-body">
                                                        <i class="'.$row->menu_icon.'"></i>
                                                    </div>
                                                    <div class="tile-object">
                                                        <div class="custom-tile-name"> '.$row->menu_nama.' </div>
                                                    </div>
                                                </div>
                                                </a>
                                                ';
                                            }
                                        }
                                    ?>

                                </div>

                            </div>
                        </div>

                    </div>
                    <!-- END PAGE CONTENT INNER -->
                </div>
            </div>
            <!-- END PAGE CONTENT BODY -->
            <!-- END CONTENT BODY -->
        </div>
        <!-- END CONTENT -->

        <?php $this->load->view('layout/V_footer_dashboard');?>

        <script>
            $(document).ready(function()
            {
            })
        </script>

    </body>

</html>