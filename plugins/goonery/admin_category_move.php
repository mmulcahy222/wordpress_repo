<div class="wrap">
    <h2>Control What Shows Up In The Music Page</h2>
    <h4>Go to Settings->Reading to see what the value is!</h6>
        <ul class="ui-sortable" id="sortable_div">
            <?php 
            $categories = get_categories(array('exclude'=>'1,2,3') ); 
            foreach ($categories as $key => $category) 
            {
                $id = $category->term_id;
                $name = $category->name;
                echo '<li class="postbox" value="'.$id.'" style="padding: 10px; width: 500px"> <span>'.$id.'</span> &nbsp;&nbsp; <span>'.$name.'</span> <input type="checkbox" checked="true" style="float:right"></input></li>';
            }
            ?>  
        </ui><!-- .meta-box-sortables.ui-sortable-->
    </div><!-- .wrap -->
    <script>
        jQuery(document).ready(function(){
            
            //alter value at settings->plugin if dragging
            jQuery("#sortable_div").sortable({
                cursor:'move',
                update:function(){
                    jQuery.ajax({
                        type: "POST",
                        url:  "<?php bloginfo( 'wpurl' ); ?>" + "/wp-admin/admin-ajax.php",
                        data: "action=update_category_music_order&haha=22&order=" + JSON.stringify(get_ids())
                    });
                    
                }});
            
            //alter value if checked
            jQuery("#sortable_div input[type='checkbox']").click(function(){
                jQuery.ajax({
                        type: "POST",
                        url:  "<?php bloginfo( 'wpurl' ); ?>" + "/wp-admin/admin-ajax.php",
                        data: "action=update_category_music_order&haha=22&order=" + JSON.stringify(get_ids())
                    });
            });
            function get_ids()
            {
                order = jQuery('#sortable_div').sortable('toArray', {attribute: 'value'});
                jQuery("#sortable_div li").each(
                    function(index){
                        var is_checked = jQuery(this).find("input[type='checkbox']").attr('checked');
                        var value = jQuery(this).attr("value");
                        if(is_checked == null)
                        {
                            var index = order.indexOf(value);
                            if (index > -1) {
                                order.splice(index, 1);
                            }
                        }
                    }
                    );
                return order;
            }
});
</script> 