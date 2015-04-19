

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
@include('CMS.includes.head')
      <body>
      <div id="wrapper">
      @include('CMS.includes/header')
      @include('CMS.includes/menu')
        <!-- /. SIDEBAR MENU (navbar-side) -->
        <div id="page-wrapper" class="page-wrapper-cls">
            <div id="page-inner">
                <div class="row">
                	<div class="page" id="algemeen"></div>
	                    <div class="col-md-12">
	                        <h1 class="page-head-line">Admin panel</h1>
	                    </div>
                </div>

            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
        </div>
    <!-- /. WRAPPER  -->
   @include('CMS.includes/footer')
    <!-- /. FOOTER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="{{asset('/js/jquery.js')}}"></script>
    <!-- BOOTSTRAP SCRIPTS -->
    <script src="{{asset('/js/bootstrap.js')}}"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="{{asset('/js/jquery.metisMenu.js')}}"></script>
    <!-- CUSTOM SCRIPTS -->
    <script src="{{asset('/js/custom.js')}}"></script>


</body>
</html>
