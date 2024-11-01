<?php

/*
Plugin Name: Simple Indeed Jobroll Widget
Plugin URI: http://rezaur.net
Description: Simplae Indeed Jobroll Widget
Version: 1.0.0
Author: Rezaur
Author URI: http://www.rezaur.com
License: GPLv2
*/

/* 
Copyright (C) 2014 Rezaur

This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.
*/

class simple_indeed_jobrol_widget extends WP_Widget {
 
 
    /** constructor -- name this the same as the class above */
   function __construct() {
		parent::__construct(
			'simple_indeed_jobrol_widget', // Base ID
			__('Simple Indeed Jobroll Widget', ''), // Name
			array( 'description' => __( 'A Simple Widget that show the Indeed jobroll', '' ), ) // Args
		);
	}
 
    /** @see WP_Widget::widget -- do not rename this */
    public function widget($args, $instance) {	
        extract( $args );
        $indeed_publisher_id = $instance['indeed-publisher-id']?:'';
        $message 	= $instance['message'];
       
        ?>
              <?php echo $before_widget; ?>
                  <?php  if ($indeed_publisher_id != '' ){ ?>
<style type='text/css'>#indJobContent{padding-bottom: 5px;}#indJobContent .company_location{font-size: 11px;overflow: hidden;display:block;}#indJobContent.wide .job{display:block;float:left;margin-right: 5px;width: 135px;overflow: hidden}#indeed_widget_wrapper{position: relative;font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif;font-size: 13px;font-weight: normal;line-height: 18px;padding: 10px;height: auto;overflow: hidden;}#indeed_widget_header{font-size:18px; padding-bottom: 5px; }#indeed_search_wrapper{clear: both;font-size: 12px;margin-top: 0px;padding-top: 2px;}#indeed_search_wrapper label{font-size: 12px;line-height: inherit;text-align: left; margin-right: 5px;}#indeed_search_wrapper input[type='text']{width: 100px; font-size: 11px; }#indeed_search_wrapper #qc{float:left;}#indeed_search_wrapper #lc{float:right;}#indeed_search_wrapper.stacked #qc, #indeed_search_wrapper.stacked #lc{float: none; clear: both;}#indeed_search_wrapper.stacked input[type='text']{width: 150px;}#indeed_search_wrapper.stacked label{display: block;padding-bottom: 5px;}#indeed_search_footer{width:295px; padding-top: 5px; clear: both;}#indeed_link{position: absolute;bottom: 1px;right: 5px;clear: both;font-size: 11px;  }#indeed_link a{text-decoration: none;}#results .job{padding: 1px 0px;}#pagination { clear: both; }</style><style type='text/css'>
#indeed_widget_wrapper{ width: 300px; height: 250px; background: #ffffff;}
#indeed_widget_wrapper{ border: 1px solid #dddddd; }
#indeed_widget_wrapper, #indeed_link a{ color: #000000;}
#indJobContent, #indeed_search_wrapper{ border-top: 1px solid #dddddd; }
#indJobContent a { color: #0000cc; }
#indeed_widget_header{ color: #222222; }
</style>
<script type='text/javascript'>
var ind_pub = '<?php echo $indeed_publisher_id ?>';
var ind_el = 'indJobContent';
var ind_pf = '';
var ind_q = '';
var ind_l = '';
var ind_chnl = '';
var ind_n = 4;
var ind_d = 'http://www.indeed.com';
var ind_t = 40;
var ind_c = 30;
</script>
<script type='text/javascript' src='http://www.indeed.com/ads/jobroll-widget-v3.js'></script>
<div id='indeed_widget_wrapper' style=''>
    <div id='indeed_widget_header'>Jobs from Indeed</div>

    <div id='indJobContent' class=""></div>
    
        <div id='indeed_search_wrapper'>
            <script type='text/javascript'>
                function clearDefaults(){
                    var formInputs=document.getElementById('indeed_jobform').elements;
                    for(var i=0;i<formInputs.length;i++){
                        if(formInputs[i].value=='title, keywords' || formInputs[i].value=='city, state, or zip'){
                            formInputs[i].value='';
                        }
                    }
                }
            </script>
            <form onsubmit='clearDefaults();' method='get' action='http://www.indeed.com/jobs' id='indeed_jobform' target="_new">
                <div id="qc"><label>What:</label><input type='text' onfocus='this.value=""' value='title, keywords' name='q' id='q'></div>
                <div id="lc"><label>Where:</label><input type='text' onfocus='this.value=""' value='city, state, or zip' name='l' id='l'></div>
                <div id='indeed_search_footer'>
                    <div style='float:left'><input type='submit' value='Find Jobs' class='findjobs'></div>
                </div>
                <input type='hidden' name='indpubnum' id='indpubnum' value='<?php echo $indeed_publisher_id ?>'>
            </form>
        </div>
    
    <div id='indeed_link'>
        <a title="Job Search" href="http://www.indeed.com/" target="_new">jobs by <img alt=Indeed src='http://www.indeed.com/p/jobsearch.gif' style='border: 0;vertical-align: bottom;'>
        </a>
    </div>
</div>
        <?php }else{ ?>
             <p>Please add the Indeed Publisher ID.</p>
        <?php  }  echo $after_widget;  ?>
        <?php
    }
 
    /** @see WP_Widget::update -- do not rename this */
    public function update($new_instance, $old_instance) {		
		$instance = $old_instance;
		$instance['indeed-publisher-id'] = strip_tags($new_instance['indeed-publisher-id']);
		$instance['message'] = strip_tags($new_instance['message']);
        return $instance;
    }
 
    /** @see WP_Widget::form -- do not rename this
     * @todo validate the publisher id with xml call
    */
    public function form($instance) {	    
        if ( isset($instance['indeed-publisher-id'])){
                 $indeed_publisher_id = esc_attr($instance['indeed-publisher-id']);
        }else{
            $indeed_publisher_id = '';
        }
        ?>
         <p>
          <label for="<?php echo $this->get_field_id('indeed-publisher-id'); ?>"><?php _e('Indeed Publisher ID:'); ?></label> 
          <input class="widefat" id="<?php echo $this->get_field_id('indeed-publisher-id'); ?>" name="<?php echo $this->get_field_name('indeed-publisher-id'); ?>" placeholder="XXXXXXXXXXXXXXXX" type="text" value="<?php echo $indeed_publisher_id; ?>" />
        </p>
        <p>If you don't have your Indeed publisher ID, You can get it from <a href="https://ads.indeed.com/jobroll">here</a></p>
        <?php 
    }
 
 
} // end class simple_indeed_jobrol_widget
add_action('widgets_init', create_function('', 'return register_widget("simple_indeed_jobrol_widget");'));