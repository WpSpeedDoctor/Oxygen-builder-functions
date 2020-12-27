<?php

defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'module_mame_display' )){
	function module_mame_display( $module_filename ) {
	
		return ucfirst(str_replace('-',' ', basename($module_filename,'.php') ) );
	
	}
}

if ( ! function_exists( 'get_module_description' )){
	function get_module_description( $module_filename ) {
	
		$module_data = file_get_contents( oxyplugindir.'/modules/'.$module_filename );
		
		$pattern = '/(?:\/\*.*\s|\S).*.Description:.(\s|\S.*)/';

		preg_match_all($pattern, $module_data, $matches);

		return ( isset($matches[1][0]) == true ? $matches[1][0] : '' );

	}
}




if ( ! function_exists( 'oxy_functions_admin_page' )){
	function oxy_functions_admin_page() {
		
		?>
		<style type="text/css">
			.form-table td {
			    padding-top: 0;
			}
		</style>

		<h2>Oxygen builder functions</h1>
		<h4>Select what modules to execute, where and add an attribute if necessary</h2>

		<?php
		
		$list_of_modules = get_plugin_modueles();
		
		if ( empty($list_of_modules) ) {

			echo 'No modueles detected.';
			
			return;
		}

		$dropdown_options = array('off','back','front','on');

        $dropdown_options_text = array('off'=>'Off','back'=>'Back-end only','front'=>'Front-end only','on'=>'On');

		foreach ($list_of_modules as $key => $module) {

            $option_value[$module] = get_option( module_setting_name($module) );

            $option_attribute_value[$module] = get_option( module_setting_name($module).'_attribute' );

        }

			
		?>
			
        <form method="post" action="options.php">

        <?php

        settings_fields( 'oxy-functions-settings' ); 

        do_settings_sections( 'oxy-functions-settings' ); 
		
		?>

		<table class="form-table"><tr valign="top">
            <colgroup>
            	<col style="width:250px">
            	<col style="width:100px">
            	<col style="width:150px">
            </colgroup>
            <tbody>
            	<tr>
					<td><p ><b>Available module</b></p>
	                <td><p><b>Active</b></p>
					<td><p><b>Attribute</b></p></td>
					<td><p><b>Description</b></p></td>
				</tr>
            
            	<?php foreach ($list_of_modules as $key2 => $module) { ?>
                
                <tr>
                	<td><?php echo module_mame_display($module) ?></td>
                    <td>
                        <select id="field<?php echo $key2; ?>" name="<?php echo module_setting_name($module); ?>" >

                        <?php

                        foreach ($dropdown_options as $key => $value) {
                           
                    		$option_status = ($option_value[$module] == $value ? 'selected': '');
                        	
                        	?>
                        	
                        	<option value="<?php echo $value; ?>" <?php echo $option_status; ?> >

                        		<?php echo $dropdown_options_text[$value]; ?>

                    		</option>
                           
                           <?php
                        }
                        
                        ?>

                      </select>                    
                    </td>
                    <td>
                        <input type="text" name="<?php echo module_setting_name($module); ?>_attribute" value="<?php echo $option_attribute_value[$module]; ?>"/>
                    </td>
                    <td>
                    	<?php echo get_module_description($module); ?>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
            </table>

            <?php submit_button(); ?>

        </form>
		<?php
	}
}




if ( ! function_exists( 'oxy_functions_admin_page2' )){
	function oxy_functions_admin_page2() {
		return;
		$list_of_modules = get_plugin_modueles();

		?>
		<form method="GET" action="options-general.php" _lpchecked="1" autocomplete="off"  >
		<input type="hidden" name="page" value="<?php echo wppage; ?>">
		<!-- <input type="hidden" name="save"> -->
			<table class="wc-order-table">
			<col style="width:250px">
			<tbody>
			<tr>
				<td><p class="p-cell bold t-cell">Available module</p>
                <td><p class="p-cell bold">Active</p>
				<td><p class="p-cell bold">Attribute</p></td>
			</tr>
				<?php
				
				foreach ($list_of_modules as $key => $filename) {

					$setting_name = basename($filename,'.php');

					?>
					<tr>
						<td><?php echo $filename; ?></td>
						<td><input type="checkbox" placeholder="" autocomplete="off" name="mod-<?php echo $setting_name ?>"  value="" checked ></td>
						<td>
							<input type="text" placeholder="" autocomplete="off" name="att-<?php echo $setting_name ?>" >
						</td>
					</tr>

					
					
				<?php } ?>

			</tbody>
			</table>
		<br>
		<button class="button button-primary" type="submit" id="submit">Save settings</button>
	</form>
	<?php
	}
}
