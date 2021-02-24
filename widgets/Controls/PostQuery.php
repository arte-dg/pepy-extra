<?php
/**
 * Created by PhpStorm.
 * Project :  pepy-addons-for-elementor.
 * User: hadie MacBook
 * Date: 06/07/20
 * Time: 15.08
 */
namespace PepyExtra\Controls;
use \Elementor\Group_Control_Base;
use \Elementor\Controls_Manager;

class Group_Control_EL_Post_Query extends Group_Control_Base{

	protected static $fields;

	private static $post_types;

	public static function get_type() {
		return 'el_PostQuery';
	}


	protected function prepare_fields( $fields ) {
		$args = $this->get_args();
		$post_type = self::get_post_type();
		$choose_types = [];

		foreach ( $args['types'] as $type ) {
			if ( isset( $post_type[ $type ] ) ) {
				$choose_types[ $type ] = $post_type[ $type ];
			}
		}

		$fields['post']['options'] = $choose_types;

		return parent::prepare_fields( $fields );
	}

	protected function filter_fields() {
		$fields = parent::filter_fields();

		$args = $this->get_args();

		foreach ( $fields as &$field ) {
			if ( isset( $field['of_type'] ) && ! in_array( $field['of_type'], $args['types'] ) ) {
				unset( $field );
			}
		}

		return $fields;
	}

	/**
	 * Get child default args.
	 *
	 * Retrieve the default arguments for all the child controls for a specific group
	 * control.
	 *
	 * @since 1.2.2
	 * @access protected
	 *
	 * @return array Default arguments for all the child controls.
	 */
	protected function get_child_default_args() {
		return [
			'types' => [ 'post', 'page' ],
		];
	}

	public function init_fields() {

//		$post_types          = self::get_post_type();
//		$post_types['by_id'] = esc_attr( 'Selected Post', 'pepy-addons-for-elementor' );
		$taxonomies          = get_taxonomies( [], 'objects' );


		$fields = [];
		$fields['post'] = [
			'label' => _x( 'Post Type', 'Post Query Control', 'pepy-addons-for-elementor' ),
			'type' => Controls_Manager::SELECT,
			'label_block' => false,

		];

		$fields['author'] =[
			'label' => _x( 'Post Author', 'Post Query Control', 'pepy-addons-for-elementor' ),
			'type'        => Controls_Manager::SELECT2,
			'label_block' => true,
			'default'     => key( $this->get_authors() ),
			'options'     => $this->get_authors(),
			'multiple'    => true,
			'condition'   => [
				'post!' => ['by_id','']
			],
		];
		$fields['ids'] =[
			'label' => _x( 'Search & Select', 'Post Query Control', 'pepy-addons-for-elementor' ),
			'type'        => Controls_Manager::SELECT2,
			'options'     => $this->search_posts(),
			'label_block' => true,
			'multiple'    => true,
			'condition'   => [
				'post' => ['by_id']
			],
		];

		foreach ( $taxonomies as $taxonomy => $object ) {
			if ( ! isset( $object->object_type[0] ) || ! in_array( $object->object_type[0], array_keys( self::get_post_type() ) ) ) {
				continue;
			}

			$fields [$taxonomy . '_ids'] = [

				'label' => _x( $object->label, 'Post Query Control', 'pepy-addons-for-elementor' ),
				'type'        => Controls_Manager::SELECT2,
				'label_block' => true,
				'multiple'    => true,
				'object_type' => $taxonomy,
				'options'     => wp_list_pluck( get_terms( $taxonomy ), 'name', 'term_id' ),

				'condition' =>[
					'post' =>$object->object_type
				],
			];
		}



		$fields['options'] =[
			'type'         => Controls_Manager::POPOVER_TOGGLE,
			'label' => _x( 'Custom Options', 'Post Query Control', 'pepy-addons-for-elementor' ),
			'condition'   => [
				'post' => ['post','page','product']
			],
		];
		$output ['_not_in'] = [
			'label' => _x( 'Exclude', 'Post Query Control', 'pepy-addons-for-elementor' ),
			'type'        => Controls_Manager::SELECT2,
			'options'     => $this->search_posts(),
			'label_block' => true,
			'post_type'   => '',
			'multiple'    => true,
			'condition'   => [
				'options' =>'yes',
				'post!' =>'by_id'
			],
		];
		$fields['per_page'] =[
			'label' => _x( 'Number of Post', 'Post Query Control', 'pepy-addons-for-elementor' ),
			'type'        => Controls_Manager::NUMBER,
			'label_block' => false,
			'default'     => 5,
			'condition'   => [
				'options' =>'yes',
				'post!' =>'by_id'
			],
		];
		$fields['offset'] = [
			'label' => _x( 'Offset', 'Post Query Control', 'pepy-addons-for-elementor' ),
			'type'        => Controls_Manager::NUMBER,
			'label_block' => false,
			'default'     => 0,
			'condition'   => [
				'options' =>'yes',
				'post!' =>'by_id'
			],
		];

		$fields['orderby'] = [
			'label' => _x( 'Order by', 'Post Query Control', 'pepy-addons-for-elementor' ),
			'type'      => Controls_Manager::SELECT,
			'options'   => [
				'ID'            => 'Post ID',
				'author'        => 'Post Author',
				'title'         => 'Title',
				'date'          => 'Date',
				'modified'      => 'Last Modified Date',
				'parent'        => 'Parent Id',
				'rand'          => 'Random',
				'comment_count' => 'Comment Count',
				'menu_order'    => 'Menu Order',
			],
			'default'   => 'date',
			'condition'   => [
				'options' =>'yes',

			],
		];

		$fields['order'] = [
			'label' => _x( 'Post Order', 'Post Query Control', 'pepy-addons-for-elementor' ),
			'type'      => Controls_Manager::SELECT,
			'options'   => [
				'asc'  => 'Ascending',
				'desc' => 'Descending',
			],
			'default'   => 'desc',
			'condition'   => [
				'options' =>'yes',

			],
		];

		$fields['meta'] = [
			'label' => _x( 'Meta Options', 'Post Query Control', 'pepy-addons-for-elementor' ),
			'type'        => Controls_Manager::SELECT2,
			'multiple'    => true,
			'label_block' => true,
			'options'     =>  [
				'postdate'   => esc_attr( 'Post Date', 'pepy-addons-for-elementor' ),
				'author'     => esc_attr( 'Author', 'pepy-addons-for-elementor' ),
				'categories' => esc_attr( 'Categories', 'pepy-addons-for-elementor' ),
				'tags'       => esc_attr( 'Tags', 'pepy-addons-for-elementor' )
			],
			'default'     => ['postdate'],
			'condition'   => [
				'post' =>['post','page'],

			],
		];




		return $fields;
	}

	protected function get_default_options() {
		return [
			'popover' => false,
		];
	}


	public static function get_default_post_type(){
		$post_types = get_post_types( [ 'public' => true, 'show_in_nav_menus' => true ], 'objects' );
		$post_types = wp_list_pluck( $post_types, 'label', 'name' );
		$output     = array_diff_key( $post_types, [ 'elementor_library', 'attachment' ] );
		$output['by_id'] = esc_attr( 'Selected Post', 'pepy-addons-for-elementor' );

		return $output;
	}


	public static function get_post_type(  ) {

		if ( null === self::$post_types ) {
			return self::get_default_post_type();
		}

		return self::$post_types;
	}

	private function get_authors(){
		$users = get_users( [
			'who'                 => 'authors',
			'has_published_posts' => true,
			'fields'              => [
				'ID',
				'display_name',
			],
		] );

		if ( ! empty( $users ) ) {
			return wp_list_pluck( $users, 'display_name', 'ID' );
		}

		return [];
	}

	private function search_posts(){
		$posts = get_posts( [
			'post_type'      => 'any',
			'post_style'     => 'all_types',
			'post_status'    => 'publish',
			'posts_per_page' => '-1',
		] );

		if ( ! empty( $posts ) ) {
			return wp_list_pluck( $posts, 'post_title', 'ID' );
		}

		return [];
	}


}
