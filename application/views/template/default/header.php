<!DOCTYPE html>
<html lang="en">
<head>
    <title>
    	<?php
            if(!empty($this->page_title)){

                echo $this->page_title;

            }
            else{

                echo DEFAULT_PAGE_TITLE;
                
            }
        ?>
    </title>

    <meta name="description" content="Hay Group HR Maturity Survey System">

    <meta name="keywords" content="Survey, Hay Group, HR Maturity, HR Maturity Survey System">

    <meta name="author" content="Hay Group HR Maturity Survey System">

    <meta charset="UTF-8">
    <!-- Main Styles -->

    <link href="<?php echo base_url('assets/avocadopanel/assets/css/chosen.css')?>" rel="stylesheet" type="text/css">

    <link href="<?php echo base_url('assets/avocadopanel/assets/css/bootstrap.min.css')?>" rel="stylesheet" type="text/css">

    <link href="<?php echo base_url('assets/avocadopanel/assets/css/theme/avocado.css')?>" rel="stylesheet" type="text/css" id="theme-style">

    <link href="<?php echo base_url('assets/avocadopanel/assets/css/prism.css')?>" rel="stylesheet/less" type="text/css">

    <link href="<?php echo base_url('assets/avocadopanel/assets/css/fullcalendar.css')?>" rel="stylesheet" type="text/css">

    <link href="<?php echo base_url('assets/avocadopanel/assets/js/uniform/css/uniform.default.css')?>" rel="stylesheet" type="text/css">

    <link href="<?php echo base_url('assets/slicknav/css/slicknav.css')?>" rel="stylesheet" type="text/css">

    <link href="<?php echo base_url('assets/avocadopanel/assets/font/google-fonts.css')?>" rel="stylesheet" type="text/css">

    <link href="<?php echo base_url('assets/avocadopanel/assets/css/bootstrap-responsive.css')?>" rel="stylesheet" type="text/css">
    
    <link rel="stylesheet" href="<?php echo base_url('themes/default/css/common.css')?>" type="text/css">

    <!-- Page style -->
    <?php echo $content_css; ?>
    <!-- End page style -->

   <!-- End Main Styles -->

   <!-- Main Script -->

    <script src="<?php echo base_url('assets/jquery/jquery.js');?>" type="text/javascript"></script>

    <script src="<?php echo base_url('themes/default/js/modernizr-2.6.2.min.js');?>" type="text/javascript"></script>
    
    <!-- End Main Script -->
    
    <!--[if lte IE 9]>
     <script src="/Scripts/html5.js"></script>
     <script src="<?php echo base_url('themes/default/js/css3-mediaqueries.js');?>"></script>
        <script type="text/javascript">
            placeholder = function () {
                $('input, textarea').each(function () {
                    var holder = $(this).attr('placeholder');
                    if (typeof (holder) !== 'undefined') {
                        $(this).val(holder);
                        $(this).bind('click', function () {
                            if ($(this).val() == holder)
                                $(this).val('');
                        }).blur(function () {
                            if ($(this).val() == holder || $(this).val() == '')
                                $(this).val(holder);
                        });
                    }
                });
            };
            $(document).ready(placeholder);
        </script>
    <![endif]-->
</head>

<body>
    
	<div class="overlay" id="overlay"></div>
