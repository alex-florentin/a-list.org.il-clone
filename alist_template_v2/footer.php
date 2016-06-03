<footer>


  <div class="container">


      <div class="row">


        <div class="left-side col-xs-12 col-sm-7 col-md-6 col-lg-5">


          <div class="row logos-top">


            <a href="http://www.anu.org.il/" target="_blank" class="logo-anu col-xs-12 col-sm-6 col-md-6 col-lg-6">


                <img src="<?php echo get_template_directory_uri(); ?>/img/logo_anu_big.png" alt="anu logo" />


            </a>


            <a href="http://www.sikkuy.org.il/" target="_blank" class="logo-sikkuy col-xs-12 col-sm-6 col-md-6 col-lg-6">


               <img src="<?php echo get_template_directory_uri(); ?>/img/logo_sikkuy.png" alt="sikkuy logo" />


            </a>


          </div>


          <div class="row logos-bottom">


              <a href="http://consulting.alonbc.com/" target="_blank" class="logo-abc col-xs-12 col-sm-7 col-md-6 col-lg-6 ">


                 <img src="<?php echo get_template_directory_uri(); ?>/img/logo_abc.png" alt="abc logo" />


              </a>


          </div>


        </div>


        <div class="right-side col-xs-12 col-sm-5 col-md-6 col-lg-7">


          <div class="email info">


            <a href="mailto:Anu@anu.org.il?subject=feedback"><?php dynamic_sidebar( 'email-footer' ); ?></a>


          </div>


          <div class="phone info">


            <?php dynamic_sidebar( 'phone-footer' ); ?>


          </div>


          <div class="location info">


            <?php dynamic_sidebar( 'location-footer' ); ?>


          </div>


        </div>


      </div>


  </div>





	<!-- function to check the availability of pin -->





	<script>


		function GetProfile()
			{
				$('#main_container').css('opacity','0.3');
				$('.loader').addClass('active');
			var xmlHttp3;
			var email=document.getElementById("cat").value;
			if(email)
			{
			var url="<?= get_template_directory_uri() ?>/codes/get_profiles.php?id="+ email;
			xmlHttp3=getobject();
			xmlHttp3.onreadystatechange=function(){
			if(xmlHttp3.readyState==4 || xmlHttp3.readyState=="complete")
    			{
    			document.getElementById("content").innerHTML=xmlHttp3.responseText;
				var $container = $('#content');
      			$container.imagesLoaded(function(){
      				$container.masonry('reloadItems');
      				 $container.masonry({
					    columnWidth: '.image-wrapper',
					    itemSelector: '.image-wrapper'
					  });
      			});
      				$('#main_container').css('opacity','1');
					$('.loader').removeClass('active');
    			}
			}
			xmlHttp3.open("GET",url,true);
			xmlHttp3.send(null);	}
			}

		function getobject()


			{





			var xmlHttp=null;





				try	{	xmlHttp=new XMLHttpRequest;	}





				catch(e)





				{ try








					{	xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");		}





					catch(e)		{	xmlHttp=new ActiveXObject("Microsoft.XMLHTTP")	;		}





				}

















				return xmlHttp;

















			}

















	</script>



   <script src="<?php bloginfo('template_url') ?>/js/jquery.gray.min.js"></script>
	<script src="<?php bloginfo('template_url') ?>/js/imagesload.min.js"></script>
   <script src="<?php bloginfo('template_url') ?>/js/masonery.min.js"></script>
	<script src="<?php bloginfo('template_url') ?>/js/main.js"></script>

























	<?php wp_footer(); ?>

















</footer>
