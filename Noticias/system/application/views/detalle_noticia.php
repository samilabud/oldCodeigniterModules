
         <h1><a href="<?=site_url("noticias")?>" style="color:inherit; text-decoration:inherit">Noticias</a></h1>
		 <h2 class="news_title"><?=ucfirst($noticia->titulo)?></h2>
         <div class="paragraph news">
						   <?php
								  $thumbnail = "95x75";
								  $big_thumbnail = base_url()."images/noticias/originals/";
								  $images = getImageIds($noticia->id_noticia,"noticia");
								  $hide_the_rest = false;
							?>
							 <div class="images_news image_list">
							<? 
								foreach($images as $image):
								  $img_path = getImagePath($noticia->id_noticia,$image->id_noticia_images,$thumbnail,$directory="noticias");
								  $big_img_path = $big_thumbnail.$noticia->id_noticia."/".$image->id_noticia_images.".jpg";
								  
							?>		
								<a href="<?=$big_img_path?>" rel="lytebox[catalog]" style="<?=($hide_the_rest)?"display:none":""?>"><img src="<?=$big_img_path?>" width="150" align="left" style="margin-right:10px; margin-top:3px; padding:2px; margin-left:3px; border:#000000 solid 1px" /></a>
							
							<? 
							$hide_the_rest = true;
							endforeach; ?>
							 </div>	
             
						  <div class="details">
							<?=$noticia->contenido ?>
						  </div>
             		
          </div>
		  

