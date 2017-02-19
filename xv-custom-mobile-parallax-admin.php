<?php
class XV_Custom_Mobile_Parallax_Settings
{
    /**
     * Holds the values to be used in the fields callbacks
     */
    private $options;

    /**
     * Start up
     */
    public function __construct()
    {
        add_action( 'admin_menu', array( $this, 'add_plugin_page' ) );
        add_action( 'admin_init', array( $this, 'page_init' ) );
    }

    /**
     * Add options page
     */
    public function add_plugin_page()
    {
        // This page will be under "Settings"
        add_options_page(
            'XV Custom Mobile Parallax Settings', 
            'XV Custom Parallax', 
            'manage_options', 
            'xv-custom-parallax-admin', 
            array( $this, 'create_admin_page' )
        );
    }

    /**
     * Options page callback
     */
    public function create_admin_page()
    {
        // Set class property
        $this->options = get_option( 'xv_custom_parallax' );
        
        ?>
        <div class="wrap">
            <h1>XV Custom Mobile Parallax Settings</h1>
            <form method="post" action="options.php">
            <?php
                // This prints out all hidden setting fields
                settings_fields( 'xv_custom_parallax' );
                do_settings_sections( 'xv-custom-parallax-admin' );
                submit_button();
            ?>
            </form>
        </div>
        <?php
    }

    /**
     * Register and add settings
     */
    public function page_init()
    {        
        register_setting(
            'xv_custom_parallax', // Option group
            'xv_custom_parallax', // Option name
            array( $this, 'sanitize' ) // Sanitize
        );

        add_settings_section(
            'xv_custom_parallax_main', // ID
            'My Custom Settings', // Title
            array( $this, 'print_section_info' ), // Callback
            'xv-custom-parallax-admin' // Page
        );  

        add_settings_field(
            'custom_parallax_data', // ID
            'Custom Parallax Data', // Title 
            array( $this, 'data_callback' ), // Callback
            'xv-custom-parallax-admin', // Page
            'xv_custom_parallax_main' // Section           
        );      
    }

    /**
     * Sanitize each setting field as needed
     *
     * @param array $input Contains all settings fields as array keys
     */
    public function sanitize( $input )
    {
        $new_input = array();

        if( isset( $input['custom_parallax_data'] ) )
            $new_input['custom_parallax_data'] = sanitize_text_field( $input['custom_parallax_data'] );

        return $new_input;
    }

    /** 
     * Print the Section text
     */
    public function print_section_info()
    {
        print 'Add you custom Parallax settings:';
    }

    /** 
     * Get the settings option array and print one of its values
     */
    public function data_callback()
    {
        printf(
            '<textarea id="xv_custom_parallax[custom_parallax_data]" name="xv_custom_parallax[custom_parallax_data]">%s</textarea>',
            isset( $this->options['custom_parallax_data'] ) ? esc_attr( $this->options['custom_parallax_data']) : ''
        );
    }
}
