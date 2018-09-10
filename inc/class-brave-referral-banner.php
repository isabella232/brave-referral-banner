<?php
/**
 * Class: WP_Brave_Referral_Banner
 *
 * @author Ryan Lanese (Brave Software)
 * https://github.com/brave-intl-brave-referral-banner
 */

class WP_Brave_Referral_Banner {
  private $settings_group = 'brb-settings-group';
  private $settings_slug = 'brave-referral-banner';

  public function __construct () {
    add_action( 'admin_menu', array( $this, 'add_plugin_settings' ) );
    add_action( 'admin_init', 'register_plugin_settings' );
  }

  public function add_plugin_settings () {
    add_plugins_page(
      'Admin Settings',
      'Brave Referral Banner',
      'administrator',
      $this->settings_slug,
      array( $this, 'plugin_settings_template' )
    );
  }

  public function register_plugin_settings () {
    register_setting( $this->settings_group, 'referral_enabled' );
    register_setting( $this->settings_group, 'referral_style' );
    register_setting( $this->settings_group, 'referral_position' );
    register_setting( 
      $this->settings_group, 
      'referral_link', 
      array( $this, 'sanitize_option_value' )
    );
  }

  public function get_option_value ( $option_name ) {
    return esc_attr( get_option( $option_name ) );
  }

  public function sanitize_option_value ( $value ) {
    return trim( sanitize_text_field( $value ) );
  }

  public function plugin_settings_template () {
?>
    <form method="post" action="options.php">
      <?php settings_fields( $this->settings_group ); ?>
      <?php do_settings_sections( $this->settings_slug ); ?>
      <input 
        type="text" 
        name="referral_link" 
        value="<?php echo $this->get_option_value( 'referral_link' ) ?>" 
      />
      <?php submit_button(); ?>
    </form>
<?php
  }
}

