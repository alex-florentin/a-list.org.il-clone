<footer>    <div class="container">        <div class="row">          <div class="left-side col-xs-12 col-sm-6 col-md-6 col-lg-5">            <div class="row">              <a href="http://www.anu.org.il/" target="_blank" class="logo-anu-container">                 <div class="logo-anu col-xs-12 col-sm-12 col-md-9 col-lg-9">                    <img src="<?php echo get_template_directory_uri(); ?>/img/logo_anu_big.png" alt="anu logo" />                 </div>              </a>            </div>            <div class="row">               <div class="mini-logos-container">                  <a href="http://consulting.alonbc.com/" target="_blank" class="logo-abc col-xs-7 col-sm-7 col-md-7 col-lg-7 ">                     <img src="<?php echo get_template_directory_uri(); ?>/img/logo_abc.png" alt="abc logo" />                  </a>                  <a href="http://www.sikkuy.org.il/" target="_blank" class="logo-sikkuy col-xs-5 col-sm-5 col-md-5 col-lg-5">                     <img src="<?php echo get_template_directory_uri(); ?>/img/logo_sikkuy.png" alt="sikkuy logo" />                  </a>               </div>            </div>          </div>          <div class="right-side col-xs-12 col-sm-6 col-md-6 col-lg-6">            <div class="email info">              <?php if ( dynamic_sidebar('email-footer') ) : else : endif; ?>            </div>            <div class="phone info">              <?php if ( dynamic_sidebar('phone-footer') ) : else : endif; ?>            </div>            <div class="location info">              <?php if ( dynamic_sidebar('location-footer') ) : else : endif; ?>            </div>          </div>        </div>    </div>	<!-- function to check the availability of pin -->	<script>		function GetProfile()			{			var xmlHttp3;			var email=document.getElementById("cat").value;			if(email)			{			var url="<?= get_template_directory_uri() ?>/codes/get_profiles.php?id="+ email;			xmlHttp3=getobject();			xmlHttp3.onreadystatechange=function(){			if(xmlHttp3.readyState==4 || xmlHttp3.readyState=="complete")    			{    			document.getElementById("content").innerHTML=xmlHttp3.responseText;    			var $container = $('#content');      			$container.imagesLoaded(function(){      				$container.masonry('reloadItems');      				 $container.masonry({					    columnWidth: '.image-wrapper',					    itemSelector: '.image-wrapper'					  });      			});    			}			}
			xmlHttp3.open("GET",url,true);			xmlHttp3.send(null);	}			}		function getobject()
			{			var xmlHttp=null;				try	{	xmlHttp=new XMLHttpRequest;	}				catch(e)				{ try
					{	xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");		}					catch(e)		{	xmlHttp=new ActiveXObject("Microsoft.XMLHTTP")	;		}				}

				return xmlHttp;

			}

	</script>
   <script src="<?php bloginfo('template_url') ?>/js/jquery.gray.min.js"></script>
	<script src="<?php bloginfo('template_url') ?>/js/imagesload.min.js"></script>   <script src="<?php bloginfo('template_url') ?>/js/masonery.min.js"></script>
	<script src="<?php bloginfo('template_url') ?>/js/main.js"></script>


	<?php wp_footer(); ?>

</footer>