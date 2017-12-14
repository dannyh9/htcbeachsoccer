<?php 
include 'header.php';
include 'databaseconnection.php';
?>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = 'https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.11&appId=556845947780553';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

  <div class="container">

      <div class="row content row-offcanvas row-offcanvas-right">
        <div class="col-12 col-md-9">
          <p class="float-right hidden-md-up">
            <button type="button" class="btn btn-primary btn-sm" data-toggle="offcanvas">Toggle nav</button>
          </p>
          <div class="row">
          	<div class="fb-page" data-href="https://www.facebook.com/HTCZwolleBeachSoccer/" data-tabs="timeline" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="false"><blockquote cite="https://www.facebook.com/HTCZwolleBeachSoccer/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/HTCZwolleBeachSoccer/">HTC Zwolle Beach Soccer</a></blockquote></div>
          </div><!--/row-->
        </div><!--/span-->

<?php 
include 'right-menu.php';
include 'footer.php';
?>
 