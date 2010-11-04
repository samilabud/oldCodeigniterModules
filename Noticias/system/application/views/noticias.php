<div class="left-column">

<h1>Noticias</h1>
<? if($noticias['total'] > 0): ?>
	<? foreach($noticias['lista'] as $noticia): ?>
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
                            <a href="<?=$big_img_path?>" style="<?=($hide_the_rest)?"display:none":""?>"><img src="<?=$img_path?>" width="95" height="75" style="padding:1px; border:#000000 solid 1px;" /></a>
                        
                        <? 
                        $hide_the_rest = true;
                        endforeach; ?>
                         </div>	
        
     <div class="news_details">
      <h2><a href="<?=site_url("noticias")?>?id=<?=$noticia->id_noticia?>" style="text-decoration:inherit; color:inherit"><?=ucfirst($noticia->titulo)?></a></h2>
      
      <div class="news_intro">
        <?=miniDescription($noticia->introduccion,350)?>
      </div>
    </div>		
    </div>
	<? endforeach; ?>
	<div class="pagination_container">		<?=$this->pagination->create_links();?> </div>
 <? else: ?>
 <div class="info">No existen noticias publicadas.</div>
 <? endif?>
 </div>
