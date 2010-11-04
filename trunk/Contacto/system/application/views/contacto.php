<h2>Contacto</h2>
<div id="contactWrapper">
  <div class="leftBox">
	 <? if($success): ?>
    <div class="success">
        Se ha enviado su nota de contacto. En breves momentos nos pondremos en contacto con usted.
    </div>
    <? else: ?>

    <h5>Comparte tus preguntas e inquietudes con nosotros.</h5>    
    <form id="form1" name="form1" method="post" action="">
    <fieldset>
      <label>Nombres:</label>
      <input name="names" type="text" value="<?=set_value("names")?>" />
      <?php echo form_error('names')?>
      <label>E-Mail:</label>
      <input name="email" type="text" value="<?=set_value("email")?>" />
      <?php echo form_error('email')?>      
      <label>Asunto:</label>
      <input name="subject" type="text"  value="<?=set_value("subject")?>" />
      <?php echo form_error('subject')?>
      <label>Mensaje:</label>
      <textarea class="textarea" name="message" cols="" rows=""><?=set_value("message")?></textarea>
      <?php echo form_error('message')?>
      <label>
      <input type="image" align="left" src="images/enviar-msj.gif" value="Enviar Mensaje"/>
      </label>
    </fieldset>
    </form>
    <? endif ?>
  </div>
  <!--Start: MAP CONTAINER-->
  <div class="rightBox">
    <h5>Visitanos, un grupo de profesionales está esperando por tí...</h5>
    <div id="map">
      <iframe width="324" height="240" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com/maps?f=d&amp;source=s_d&amp;saddr=Ave.+Lope+de+Vega+no.59&amp;daddr=&amp;geocode=FbrtGQEdy-7U-ykDsqwf6ImvjjF3D3oSYCddhw&amp;hl=en&amp;mra=ls&amp;sll=18.476923,-69.928794&amp;sspn=0.023933,0.052314&amp;ie=UTF8&amp;ll=18.476027,-69.929781&amp;spn=0.019538,0.027895&amp;z=14&amp;output=embed"></iframe><br />
    </div>
    <em style="float:left; padding-top:6px; width:324px; ">Ave. Lope de Vega no.59,  Plaza Lope de Vega, local B-15 Naco. Santo Domingo D.N. RD <small><a href="http://maps.google.com/maps?f=d&amp;source=embed&amp;saddr=Anthony's+Plaza+Central+%4018.463938,-69.935231&amp;daddr=&amp;hl=en&amp;geocode=&amp;mra=mift&amp;sll=18.465505,-69.930253&amp;sspn=0.010095,0.021136&amp;ie=UTF8&amp;ll=18.465505,-69.930253&amp;spn=0.010095,0.021136" target="_blank" style="color:#0000FF;text-align:left; padding-top:10px">Ver mapa completo</a></small></em>
  </div>
  <!--End: MAP CONTAINER-->
</div>
<!--End: contactWrapper-->