<div id="footer-sec"> 
        Developed By : <a href="https://web.facebook.com/anupamhayatbd" target="_blank">Md. Anupam Hayat</a>
    </div>
    <!-- /. WRAPPER  -->
    
    
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
<!-- Bootstrap tooltips -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
<!-- MDB core JavaScript -->
<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script src="js/all.js" ></script>
<script src="js/datatable.js" ></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js" ></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/moment.js/2.0.0/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.js" integrity="sha256-JIBDRWRB0n67sjMusTy4xZ9L09V8BINF0nd/UUUOi48=" crossorigin="anonymous"></script>



<script>
  $(document).ready(function(){
  $('#passwordCheck').hide();
  
});
$(document).on('click', '.panel-heading span.clickable', function (e) {
  ('#passwordCheck').hide();
  var $this = $(this);
  if (!$this.hasClass('panel-collapsed')) {
      $this.parents('.panel').find('.panel-body').slideUp();
      $this.addClass('panel-collapsed');
      $this.find('i').removeClass('glyphicon-minus').addClass('glyphicon-plus');
  } else {
      $this.parents('.panel').find('.panel-body').slideDown();
      $this.removeClass('panel-collapsed');
      $this.find('i').removeClass('glyphicon-plus').addClass('glyphicon-minus');
  }
});
$(document).on('click', '.panel div.clickable', function (e) {
  var $this = $(this);
  if (!$this.hasClass('panel-collapsed')) {
      $this.parents('.panel').find('.panel-body').slideUp();
      $this.addClass('panel-collapsed');
      $this.find('i').removeClass('glyphicon-minus').addClass('glyphicon-plus');
  } else {
      $this.parents('.panel').find('.panel-body').slideDown();
      $this.removeClass('panel-collapsed');
      $this.find('i').removeClass('glyphicon-plus').addClass('glyphicon-minus');
  }
});
$(document).ready(function () {
  $('.panel-heading span.clickable').click();
  $('.panel div.clickable').click();
});
</script>



<?php

// $files = glob("./*");
// foreach ($files as $file) {
// 	$file = basename($file);
//     if ($file and $file[0] == "_") {
//         continue;
//     }
// 	printf("<a href='%s'>%s</a><br>", $file, $file);
// }


?>


</body>
</html>