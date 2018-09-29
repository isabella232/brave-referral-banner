<?php
/**
 * Class: WP_Brave_Referral_Banner
 *
 * @author Ryan Lanese (Brave Software)
 * https://github.com/brave-intl-brave-referral-banner
 */

class WP_Brave_Referral_Banner {
  // Identifiers
  private $settings_group = 'brb-settings-group';
  private $settings_slug = 'brave-referral-banner';
  private $text_domain = 'brb-text-domain';

  // Options
  private $options = array(
    'referral_position' => array(
      'red'     => 'Red',
      'yellow'  => 'Yellow',
      'black'   => 'Black',
      'branded' => 'Branded'
    ),
    'referral_style' => array(
      'top'    => 'Top of the Page',
      'bottom' => 'Bottom of the Page'
    )
  );

  public function __construct () {
    add_action( 'admin_menu', array( $this, 'add_plugin_settings' ) );
    add_action( 'admin_init', array( $this, 'register_plugin_settings' ) );
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

  public function do_checkbox ( $option_name ) {
?>
    <input
      value="1"
      type="checkbox"
      name="<?php echo $option_name; ?>"
      <?php checked( 1, get_option( $option_name )); ?>
    />
<?php
  }

  public function do_text_input ( $option_name ) {
?>
    <input
      type="text"
      name="<?php echo $option_name ;?>"
      value="<?php echo $this->get_option_value( $option_name ); ?>"
    />
<?php
  }

  public function do_select ( $option_name ) {
?>
    <select name="<?php echo $option_name; ?>">
      <?php
        foreach ( $this->options[$option_name] as $value => $name ):
          $selected = $this->get_option_value( $option_name ) === $value
            ? "selected='selected'"
            : "";
      ?>
        <option
          value="<?php echo $value; ?>"
          <?php echo $selected; ?>
        >
          <?php echo $name; ?>
        </option>
      <?php endforeach; ?>
    </select>
<?php
  }

  public function plugin_settings_template () {
?>
    <h1>
      <?php echo __( 'Brave Referral Banner Settings', $this->text_domain ); ?>
    </h1>
    <form method="post" action="options.php">
      <?php settings_fields( $this->settings_group ); ?>
      <?php do_settings_sections( $this->settings_slug ); ?>
      <label for="referral_enabled">
        <?php echo __( 'Banner Enabled:', $this->text_domain ); ?>
      </label>
      <?php $this->do_checkbox( 'referral_enabled' ); ?>
      <label for="referral_style">
        <?php echo __( 'Banner Style:', $this->text_domain ); ?>
      </label>
      <?php $this->do_select( 'referral_style' ); ?>
      <label for="referral_position">
        <?php echo __( 'Banner Position:', $this->text_domain ); ?>
      </label>
      <?php $this->do_select( 'referral_position' ); ?>
      <label for="referral_link">
        <?php echo __( 'Brave Referral Link:', $this->text_domain ); ?>
      </label>
      <?php $this->do_text_input( 'referral_link' ); ?>
      <?php submit_button(); ?>
    </form>
<?php
  }
}

