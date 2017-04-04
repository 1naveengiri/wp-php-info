<?php
namespace PhpSystemInfo;

/**
 * PhpSystemInfo\Php_Info Class
 *
 * The class used to show PHP system info in WordPress backend.
 */
class Php_Info {
	/**
	 * Single ton pattern instance reuse.
	 *
	 * @access  private
	 *
	 * @var Php_Info  $_instance class instance.
	 */
	private static $_instance;

	/**
	 * PhpSystemInfo\Php_Info Constructor
	 */
	function __construct() {
		add_action( 'admin_menu', array( $this, 'php_sysinfo_plugin_menu' ) );
	}

	/**
	 * GET Instance
	 *
	 * Function help to create class instance as per singleton pattern.
	 *
	 * @return PhpSystemInfo\Php_Info  $_instance
	 */
	public static function get_instance() {
	    if ( ! isset( self::$_instance ) ) {
	        self::$_instance = new self();
	    }
	    return self::$_instance;
	}

	/**
	 * Function to Add Setting submenu is Tool section in Admin panel.
	 */
	function php_sysinfo_plugin_menu() {
		add_submenu_page( 'tools.php', __( 'PHP System Info','php_sys_info' ), __( 'PHP System Info','php_sys_info' ), 'manage_options', 'php_sys_info', array( $this, 'show_php_info' ) );
	}

	/**
	 * Function to PHP info in Admin panel.
	 */
	function show_php_info() {
		// here i will show the phpinfo.
		?>
		<div class='wrap'>
			<table class="wp-list-table widefat fixed striped">
				<thead>
					<tr>
						<th>Parameter</th>
						<th>Suggestion</th>
						<th>Value</th>
						<th>Result</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>PHP Version</td>
						<td> <span> > 5.3.10</span></td>
						<td> <?php echo phpversion(); ?></td>
						<td>
						<?php 
						if (version_compare(phpversion(), '5.3.10', '<')) {
						    // php version isn't high enough
						    echo '<span>OK</span>';
						}else{
							echo '<span>Warning</span>';
						}
						?>
						 </td>
					</tr>
					<tr>
						<td> Max Execution time</td>
						<td> <span> >= 30 ( seconds )</span></td>
						<td> 
							<?php 
								$max_time = ini_get("max_execution_time");
								echo '<span>'.$max_time.'</span>';
							?>
						</td>
						<td> 
							<?php
							$max_time = ini_get("max_execution_time");
							if(isset($max_time) && !empty($max_time) && 30 <= $max_time){
								echo '<span>OK</span>';
							}else{
								echo '<span>Warning</span>';
							}
							?>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
		<?php
	}

}