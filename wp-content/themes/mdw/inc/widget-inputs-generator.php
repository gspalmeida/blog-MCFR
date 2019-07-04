<?php

class WidgetInputsGenerator {


	public function insertCheckBox( $self, $checkBoxLabel = "", $fieldName, $fieldValue ) {
		?>

			
			<input id="<?php echo $self->get_field_id( $fieldName ); ?>"
			 <?php echo $fieldValue; ?>
				   type="checkbox">
			<label for="<?php echo $self->get_field_id( $fieldName ); ?>"><?php echo $checkBoxLabel; ?></label>
			<input hidden
				   name="<?php echo $self->get_field_name( $fieldName ); ?>"
				   value="<?php echo $fieldValue; ?>"
				   data-role = "checked"
				   type="text">
			<!-- <br/> -->
		
		<?php
	}

	/**
	 * 
	 * @param type $self
	 * @param type $amount
	 */
	public function insertIconContainers( $self, $value, $color, $fieldName, $colorFieldName, $containerFieldName  ) {
		
		
			?>
				
				<span>
					<i id="icon_modal_toggle"
						 class="<?php echo $value == '' ? 'fa fa-plus blue-text' : 'fa fa-close red-text'; ?>">
					</i>
				</span>
				<span class="title_text icon_container"
					  id="<?php echo $self->get_field_id( $fieldName ); ?>" 
					  name="<?php echo $self->get_field_name( $fieldName ); ?>">
					<i class="<?php echo $value ; ?> chosen fa-4x"
					   style="<?php echo 'color:' . sanitize_text_field( $color ); ?>">
					</i>
				</span>
				<br/>
				<input hidden name="<?php echo $self->get_field_name( $containerFieldName ); ?>"
					   value="<?php echo sanitize_text_field( $value ); ?>">
				<?php if($color != '') { ?>
				<input  type="color" 
					   id="<?php echo $self->get_field_id( $colorFieldName ); ?>" 
					   value="<?php echo sanitize_text_field( $color ); ?>">
				<input hidden type="text"
					   id="color-code"
					   name="<?php echo $self->get_field_name( $colorFieldName ); ?>"
					   value="<?php echo sanitize_text_field( $color ); ?>">
				<?php } ?>
				<br/>

			<?php 
		
	}

	/**
	 * 
	 * @param type $self
	 * @param type $color
	 */
	public function insertColorPicker( $self, $fieldValue, $fieldName ) {
		?>
			<input type="color" id="<?php echo $self->get_field_id( $fieldName ) ?>" value="<?php echo $fieldValue ?>">
			<input hidden type="text" id="color-code" name="<?php echo $self->get_field_name( $fieldName ) ?>" value="<?php echo $fieldValue ?>">
			<br>
		<?php
	}

	/**
	 * 
	 * @param type $fieldName
	 * @param type $fieldValue
	 * @param type $placeholder
	 * @param type $self
	 */
	public function textareaInput( $fieldName, $fieldValue, $placeholder = "", $self ) {
		?>
		<textarea class = "title_text"
				  id = "<?php echo $self->get_field_id( $fieldName ); ?>"
				  name = "<?php echo $self->get_field_name( $fieldName ); ?>"
				  type = "text"
				  placeholder = "<?php _e( $placeholder, 'mdw' ); ?>"><?php echo esc_textarea( $fieldValue );?></textarea> 
		<?php
	}

	/**
	 * 
	 * @param type $fieldName
	 * @param type $fieldValue
	 * @param type $placeholder
	 * @param type $self
	 */
	public function textInput( $fieldName, $fieldValue, $placeholder = "", $self ) {
		?>
		<input class="title_text"
			   id="<?php echo $self->get_field_id( $fieldName ); ?>"
			   name="<?php echo $self->get_field_name( $fieldName ); ?>"
			   value="<?php echo htmlentities($fieldValue) ; ?>"
			   placeholder="<?php _e( $placeholder, 'mdw' ); ?>"
			   type="text">
			   <?php				  
		   }

		   /**
			* 
			* @param type $fieldName
			* @param type $fieldValue
			* @param type $placeholder
			* @param type $self
			*/
		   public function numberInput( $fieldName, $fieldValue, $placeholder = "", $self ) {
			   ?>
		<label for="<?php echo $self->get_field_id( $fieldName ); ?>"><?php _e( $placeholder, 'mdw' ); ?></label>
		<input class="title_text" id="<?php echo $self->get_field_id( $fieldName ); ?>"
			   name="<?php echo $self->get_field_name( $fieldName ); ?>"
			   type="number"
			   value="<?php echo $fieldValue ?>"
			   min=1 >
			   <?php
		   }

		   /**
			* 
			* @param string $fieldName
			* @param string $fieldValue
			* @param string $placeholder
			* @param string $buttonName
			* @param string $urlValue
			* @param string $imageValue
			* @param type $self
			*/
		   public function imageInput( $fieldName, $fieldValue, $placeholder = "", $buttonName, $urlValue, $imageValue, $self ) {
			   ?>
		<div id = "<?php echo $self->get_field_id( $fieldName ); ?>_preview" class = "preview_placeholder" style = "height: 50%">
			<img src = "<?php echo $imageValue; ?>" class = "img-fluid"/>
		</div>

		<input class = "background_image"
			   id = "<?php echo $self->get_field_id( $fieldName ); ?>"
			   name = "<?php echo $self->get_field_name( $fieldName ); ?>"
			   value = "<?php echo esc_attr( $fieldValue ); ?>"
			   type = "text">
		<button id = "image_button"
				class = "button"
				onclick = "image_button_click( 'Choose Background Image', 'Select Background Image', 'image', '<?php echo $self->get_field_id( $fieldName ); ?>_preview', '<?php echo $self->get_field_id( $fieldName ); ?>' );"><?php _e( $buttonName, 'mdw' );
			   ?>
		</button>
		<?php if ($urlValue != "") { ?>
		<input type="text" id="<?php echo $self->get_field_id( $fieldName . '_url' ) ?>" name="<?php echo $self->get_field_name( $fieldName . '_url' ) ?>" value="<?php echo $urlValue ?>" placeholder="<?php _e( $placeholder, 'mdw' ) ?>">
		<?php } 
	}

	/**
	 * 
	 * @param string $fieldName
	 * @param string $fieldValue
	 * @param string $placeholder
	 * @param array $options
	 * @param type $self
	 */
	public function selectInput( $fieldName, $fieldValue, $placeholder = "", $options, $self ) {
		?>
		<label for = "<?php echo $self->get_field_name( $fieldName ); ?>"><?php _e( $placeholder, 'mdw' );
		?></label>
		<br>
		<select id="<?php echo $self->get_field_id( $fieldName ); ?>" name="<?php echo $self->get_field_name( $fieldName ); ?>" value="<?php echo sanitize_text_field( $fieldValue ); ?>">
		<?php foreach ( $options as $option ) { ?>
				<option <?php echo ($fieldValue == $option['value']) ? 'selected' : '' ?> value="<?php echo $option['value']; ?>"><?php _e( $option['text'], 'mdw' ); ?></option>
		<?php } ?>

		</select>
		<?php
	}
	
	
	    public function insertEmailInput( $fieldName, $fieldValue, $placeholder, $self ){
        ?>
            <input class="title_text"
            id="<?php echo $self->get_field_id( $fieldName ); ?>"
            name="<?php echo $self->get_field_name( $fieldName ); ?>"
            value="<?php echo sanitize_text_field( $fieldValue ); ?>"
            placeholder="<?php _e( $placeholder, 'mdw' ); ?>"
            type="text">
        <?php
    }

}
