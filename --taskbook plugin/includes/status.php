<?php
/**
 * Auto-update the Status field on Save Post.
 *
 * @param into $post_id The post ID.
 * @param post $post The post object.
 * @param bool $update Whether this is an existing post being updated or not.
 */
add_action( 'save_post', 'taskbook_change_status', 10, 3 );

function taskbook_change_status( $post_id, $post, $update ) {

	// Make sure this is a Task. If not, abandon immediately:
	if ( 'task' != get_post_type( $post_id ) ) return;

	// Get the current status of the Outcome meta box:
	if ( isset( $_POST['taskbook_outcome'] ) ) {
		$outcome = $_POST['taskbook_outcome'];
	}

	// If the task has a title (meaning it is not a brand new task),
	// update task_status based on the status of $outcome:
	if ( isset( $_POST['post_title'] ) ) {
		if ( empty( $outcome ) ) {
			update_post_meta( $post_id, 'task_status', false );
		} else {
			update_post_meta( $post_id, 'task_status', true );
		}
	}
}

/**
 * Register new REST field for task_status.
 */
add_action( 'rest_api_init', 'taskbook_register_task_status' );

function taskbook_register_task_status() {
	register_rest_field(
		'task',
		'task_status',
		array(
			'get_callback'    => 'taskbook_get_task_status',
			'update_callback' => 'taskbook_update_task_status',
			'schema'          => null,
		)
	);
}

function taskbook_get_task_status( $object, $field_name, $request ) {
	return get_post_meta( $object['id'], $field_name, true );
}

function taskbook_update_task_status( $value, $object, $field_name ) {
	$value = json_decode( $value );
	if ( is_bool( $value ) !== true ) {
		return;
	}

	return update_post_meta( $object->ID, $field_name, $value );
}
