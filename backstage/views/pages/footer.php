</div><!--/.main-container-->

		<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-small btn-inverse">
			<i class="icon-double-angle-up icon-only bigger-110"></i>
		</a>

		<!--inline scripts related to this page-->

		<script type="text/javascript">
			var current_route = "<?php $Ci =& get_instance(); echo $Ci->router->class;?>";
            var current_method = "<?php echo $Ci->router->fetch_method(); ?>";
			$(function(){
				$("ul#left-nav-list li").each(function(){
				    if($(this).attr('id') == current_route){
				    	$("ul#left-nav-list li").removeClass('active');
				    	$(this).addClass('active');
				    }
				});
                $("ul.submenu li").each(function(){
                    if($(this).attr('id') == current_method){
                        $("ul.submenu li").removeClass('active');
                        $(this).addClass('active');
                    }
                })
			});
		</script>
	</body>
</html>