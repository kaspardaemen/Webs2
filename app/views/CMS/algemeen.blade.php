

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
@include('CMS.includes.head.php')
      <body>
      <div id="wrapper">
      @include('CMS.includes/header.php')
      @include('CMS.includes/menu.php')
        <!-- /. SIDEBAR MENU (navbar-side) -->
        <div id="page-wrapper" class="page-wrapper-cls">
            <div id="page-inner">
                <div class="row">
                	<div class="page" id="algemeen"></div>
	                    <div class="col-md-12">
	                        <h1 class="page-head-line">ALGEMENE GEGEVENS EDITOR</h1>
	                    </div>
                </div>

            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
        </div>
    <!-- /. WRAPPER  -->
   @include('CMS.includes/footer.php')
    <!-- /. FOOTER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.11.1.js"></script>
    <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="assets/js/jquery.metisMenu.js"></script>
    <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>


</body>
</html>
