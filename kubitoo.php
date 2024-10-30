<?php

/*
Plugin Name: Kubitoo
Plugin URI: http://www.kubitoo.com
Description: Attivazione widget per il live support di kubitoo. Per ottenere un token valido collegati su https://www.kubitoo.com e acquista il credito necessario per permettere ai tuoi clienti di chiamarti con un semplice click.
Version: 1.0
Author: Kubitoo
Author URI: https://www.kubitoo.com
License: GPLv2
*/

define( 'KUBITOO__PLUGIN_URL', plugin_dir_url( __FILE__ ) );

if (!defined('ABSPATH')) die("Accesso diretto al file non permesso");

class Kubitoo_Widget extends WP_Widget {
 
    // Create widget
    public function __construct() {
        parent::__construct(
            'Kubitoo_widget', // Base ID
            'Kubitoo Widget', // Name
            array( 'description' => 'Grazie a questo widget è possibile telefonare al call center direttamente dal proprio browser, gratuitamente e senza alcun software aggiuntivo.') // Arguments
        );
    }
 
    // Front-End Display of the Widget
    public function widget( $args, $instance ) {
        // Saved widget options
        $title      = $instance['title'];
        $token      = $instance['token'];
        $textbutton = $instance['textbutton'];
        $htmlbutton = $instance['htmlbutton'];
        $language   = $instance['language'];

        if(empty($language))
            $language = "en_US";
        
        // Display information
        echo '<div class="my-widget block">';
            if ( !empty( $title ) ) {
                echo '<h3>' . $title . '</h3>';
            }
            if ( !empty( $token ) && !empty( $htmlbutton ) && !empty( $textbutton )) {
                echo '<a href="javascript:window.open(\'https://client.kubitoo.com/index.php?tokenid='.$token.'&lang='.$language.'\',\'LiveSupport\',\'width=450, height=450, directories=no,titlebar=no,toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=no\');void(0);" class="btn_kubitoo btn_kubitoo_'.$htmlbutton.'">
                        <img src="'.KUBITOO__PLUGIN_URL.'_inc/img/btn_img'.$htmlbutton.'.png" alt="" />
                        <span>'.$textbutton.'</span>
                    </a>';

            }            
        echo '</div>';

        echo "<style type='text/css'>@import url(https://fonts.googleapis.com/css?family=Open+Sans:300,400,500,600,700);.btn_kubitoo{display:inline-block;background:#659fd5;border-radius:4px;box-shadow:0 0 1px 1px rgba(0,0,0,0.2);overflow:hidden;padding:7px 15px 7px 0;width:auto; max-width:280px}.btn_kubitoo > img{float:left;display:inline-block;margin:0;padding:0;margin-left:15px;}.btn_kubitoo > span{float:left;display:inline-block;margin:0;padding:0;line-height:50px;font-family:'Open Sans',sans-serif;font-size:18px;font-weight:700;color:#fff;padding-left:5px;padding-right:5px;text-transform:uppercase;text-decoration:none;height:50px;overflow:hidden;max-width:75%;text-align:left;}.btn_kubitoo_1 > span{max-width:78%;}.btn_kubitoo_2 > span{ max-width:72%;}.btn_kubitoo_3 > span{line-height: 23px; max-width:66%;}</style>";

    }
 
    // Back-end form of the Widget
    public function form( $instance ) {
        // Check for values
        if ( isset( $instance[ 'title' ] ) ) {
            $title = $instance[ 'title' ];
        }
        else
            $title = "";

        if ( isset( $instance[ 'token' ] ) ) {
            $token = $instance[ 'token' ];
        }
        else
            $token = "";

        if ( isset( $instance[ 'textbutton' ] ) ) {
            $textbutton = $instance[ 'textbutton' ];
        }
        else
            $textbutton = "";

        if ( isset( $instance[ 'htmlbutton' ] ) ) {
            $htmlbutton = $instance[ 'htmlbutton' ];
        }
        else
            $htmlbutton = 1;

        if ( isset( $instance[ 'language' ] ) ) {
            $language = $instance[ 'language' ];
        }
        else
            $language = "en_US";

        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label> 
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'token' ); ?>">Token:</label> 
            <input class="widefat" id="<?php echo $this->get_field_id( 'token' ); ?>" name="<?php echo $this->get_field_name( 'token' ); ?>" type="text" value="<?php echo esc_attr( $token ); ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'textbutton' ); ?>">Text Button:</label> 
            <input class="widefat" id="<?php echo $this->get_field_id( 'textbutton' ); ?>" name="<?php echo $this->get_field_name( 'textbutton' ); ?>" type="text" value="<?php echo esc_attr( $textbutton ); ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'language' ); ?>">Language service:</label> 
            <select class="widefat" id="<?php echo $this->get_field_id( 'language' ); ?>" name="<?php echo $this->get_field_name( 'language' ); ?>">
                <option value="en_US" <?php if($language == "en_US"):?>selected<?php endif; ?>>English</option>
                <option value="it_IT" <?php if($language == "it_IT"):?>selected<?php endif; ?>>Italiano</option>
            </select>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'htmlbutton' ); ?>">Style Button:</label>
            <div id="style_button">
            <?php 
                for($i=1; $i<4; $i++)
                {   $st_checked = '';
            

                    if($htmlbutton == $i)
                        $st_checked = 'checked="checked"';

                    if($i == 1)
                        echo '<div id="proposta'.$i.'" data-value="Call now">
                            <input type="radio" id="'.$this->get_field_id('htmlbutton').'-1" name="'.$this->get_field_name('htmlbutton').'" value="1" '.$st_checked.' />
                            <span>
                                <img src="'.KUBITOO__PLUGIN_URL.'_inc/img/btn_img1.png" alt="" />
                                <span>Call now</span>
                            </span>
                        </div>';
                    elseif($i == 2)
                        echo '<div id="proposta'.$i.'" data-value="Contact us">
                            <input type="radio" id="'.$this->get_field_id('htmlbutton').'-2" name="'.$this->get_field_name('htmlbutton').'" value="2" '.$st_checked.' />
                            <span>
                                <img src="'.KUBITOO__PLUGIN_URL.'_inc/img/btn_img2.png" alt="" />
                                <span>Contact us</span>
                            </span>
                        </div>';
                    elseif($i == 3) 
                        echo '<div id="proposta'.$i.'" data-value="Receive information">
                            <input type="radio" id="'.$this->get_field_id('htmlbutton').'-3" name="'.$this->get_field_name('htmlbutton').'" value="3" '.$st_checked.' />
                            <span>
                                <img src="'.KUBITOO__PLUGIN_URL.'_inc/img/btn_img3.png" alt="" />
                                <span>Receive information</span>
                            </span>
                        </div>';
                
                }
            ?>
            </div>
        </p>
        <style type="text/css">
            @import url(https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,300italic,700);
            div#style_button
            {   display:inline-block;
                width: 100%;  
                line-height:1;
            }
            div#style_button div
            {   display: inline-block;
                float: left;
                margin-bottom:5px;
                padding: 0;
                width: 100%;
            }
            div#style_button div > input
            {   float:left;
                display:inline-block;
                margin:0;
                padding:0;
                margin-top:28px;
            }
            div#style_button div > span
            {   float: left;
                display: inline-block;
                margin:0;
                padding:0;
                width:auto;
                margin-left:5%;
                border-radius: 4.3px;
                background-color: #659fd5;
                box-shadow: 0 0 1px 1px rgba(0, 0, 0, 0.2);
                padding-top:7px;
                padding-bottom:7px;
                padding-right:15px;
                max-width:80%;
                overflow: hidden;
            }
            div#style_button div > span > img
            {   float: none;
                display: inline-block;
                margin:0;
                padding:0;
                margin-left:15px;
            }
            div#style_button div > span > span
            {   float:none;
                display: inline-block;
                margin:0;
                padding:0;
                line-height: 50px;
                font-family: 'Open Sans', sans-serif;
                font-size: 18px;
                font-weight: bold;
                color: #ffffff;
                padding-left:5px;
                padding-right:5px;
                text-transform: uppercase;
                text-decoration: none;
                height:50px;
                overflow: hidden;
            }
            div#style_button div#proposta1 > span > span
            {   max-width:78%; 
            }
            div#style_button div#proposta2 > span > span
            {   max-width:75%;
            }
            div#style_button div#proposta3 > span > span
            {   line-height: 23px;
                max-width:66%;
            }
        </style>
    <?php 
    }
 
    // Sanitize and return the safe form values
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title']      = ( !empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['token']      = ( !empty( $new_instance['token'] ) ) ? strip_tags( $new_instance['token'] ) : '';
        $instance['textbutton'] = ( !empty( $new_instance['textbutton'] ) ) ? strip_tags( $new_instance['textbutton'] ) : '';
        $instance['htmlbutton'] = ( !empty( $new_instance['htmlbutton'] ) ) ? strip_tags( $new_instance['htmlbutton'] ) : 1;
        $instance['language']   = ( !empty( $new_instance['language'] ) ) ? strip_tags( $new_instance['language'] ) : 'en_US';
 
        return $instance;
    }
}
 
// Register widget
add_action( 'widgets_init', function(){
     register_widget( 'Kubitoo_Widget' );
});

?>