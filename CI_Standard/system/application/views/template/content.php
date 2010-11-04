<!-- Example of content -->
	<div id="content">

			<div id="banner_inside">
				<img src="<?=base_url()?>images/banner_inside.jpg" />
				<div class="slogan_box_inside">Lo mejor a su disposición</div>
			</div>
			
			<div class="content_inside">
				
				<div class="content_inside_left">

					<? $this->load->view($viewToLoad) ?>
					
				</div>
				
				<? if(!isset($rightless)): ?>
					<div class="content_inside_right">
					  <? $this->load->view("template/sidebar_right"); ?>
					</div>
				<? endif ?>		

			</div>
			
			
	</div>
		
