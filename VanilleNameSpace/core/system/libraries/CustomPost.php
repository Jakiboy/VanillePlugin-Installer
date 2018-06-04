<?php
/**
 * @author    : JIHAD SINNAOUR
 * @package   : VanillePlugin
 * @version   : 1.0.0
 * @copyright : (c) 2018 JIHAD SINNAOUR <j.sinnaour.official@gmail.com>
 * @link      : https://jakiboy.github.io/VanillePlugin/
 * @license   : MIT
 */

namespace VanilleNameSpace\core\system\libraries;

class CustomPost extends Wordpress
{
    /**
     * @access private
     */
    private $wrapper = []; // custom post wrapper

    /**
     * @access protected
     */
    protected $path; // path of custom post
    protected $templatePath; // path of custom templates

    /**
     * Install custom post types
     *
     * @param void
     * @return boolean
     *
     * action : init
     */
    public function init()
    {
    	// load custom posts files
        $file = array_diff(scandir($this->path), ['..', '.']);

        foreach ($file as $post)
        {
            $content = json_decode( file_get_contents($this->path . $post) );
            $args = $content->post;
            $type = basename($post,'.json');

            // wrap all custom post types, important for initMetabox
            $this->wrapper[$type] = $content;

            if ($content->taxonomy)
            {
                foreach ($content->taxonomy as $taxonomy) 
                {
                    $this->registerTaxonomy($taxonomy->type, $type, $taxonomy->args);
                }
            }

            $this->registerPostType( $type, $args );
            $this->flushRewrite();
        }
    }

	/**
	 * Set custom post type Path
	 *
	 * @access protected
	 * @param string $path
	 * @return void
	 * @see /Function_Reference/plugin_dir_path
	 * @todo fix relative path
	 */
	protected function setPath($path)
	{
		$this->path = dirname(dirname(dirname(dirname(__DIR__)))) . $path;
	}

	/**
	 * Set custom post type Templates Path
	 *
	 * @access protected
	 * @param string $path
	 * @return void
	 * @see /Function_Reference/plugin_dir_path
	 * @todo fix relative path
	 */
	protected function setTemplatePath($path)
	{
		$this->templatePath = dirname(dirname(dirname(dirname(__DIR__)))) . $path;
	}

	/**
	 * Register custom post type
	 *
	 * @access protected
	 * @param string $type, array $args
	 * @return boolean
	 */
	protected function registerPostType($type, $args)
	{
		register_post_type($type,$args);
	}

	/**
	 * Register custom post type Taxonomy
	 *
	 * @access protected
	 * @package Wordpress Core
	 * @param string $taxonomy, string $type, array $args
	 * @return true
	 * @see /Function_Reference/register_taxonomy
	 */
	protected function registerTaxonomy($taxonomy, $type, $args)
	{
		register_taxonomy($taxonomy,$type,$args);
	}

	/**
	 * Initialize Metabox of current custom post
	 *
	 * @access protected
	 * @param void
	 * @return boolean
	 * @var string $type,
	 * using get_post_type in instead of global $post
	 */
	public function initMetabox()
	{
		$type = get_post_type();

		// check if is a custom post type
		if (isset($this->wrapper[$type]->metabox) && $this->wrapper[$type]->metabox)
		{
			$this->addMetabox(
				"{$type}-metabox",
				__( $this->wrapper[$type]->metabox->title, 'VanilleNameSpace' ),
				[$this,'renderMetabox'], $type
			);
		}
	}

	/**
	 * Get Metabox
	 *
	 * @access protected
	 * @param string $type, array $args
	 * @return boolean
	 *
	 * @todo add json field
	 */
	public function renderMetabox($post)
	{
		wp_nonce_field( "{$post->post_type}-nonce", "{$post->post_type}-check" );

		$html = '';

		foreach ($this->wrapper[$post->post_type]->metabox->input as $input)
		{
			switch ($input->type)
			{
				case 'textarea':
					$html .= '<p>';
					if($input->title) $html .= '<label for="'.$input->id.'">'.__( $input->title, 'VanilleNameSpace' ).': </label><br>';
					$html .= '<textarea name="'.$input->id.'" id="'.$input->id.'">'.$this->getMetabox($input->id).'</textarea>';
					$html .= '</p>';
					break;

				default:
					$html .= '<p>';
					if($input->title) $html .= '<label for="'.$input->id.'">'.__( $input->title, 'VanilleNameSpace' ).': </label><br>';
					$html .= '<input type="'.$input->type.'" name="'.$input->id.'" id="'.$input->id;
					$html .= '" value="'.$this->getMetabox($input->id).'">';
					$html .= '</p>';
					break;
			}
		}
		echo $html;
	}

	/**
	 * Get Metabox
	 *
	 * @access protected
	 * @param string $type, array $args
	 * @return boolean
	 * @todo coding style
	 */
	private function getMetabox($id)
	{
		global $post;

		$metabox = get_post_meta( $post->ID, $id, true );
		if ( !empty( $metabox ) )
		{
			return is_array( $metabox ) ? stripslashes_deep( $metabox ) : stripslashes( wp_kses_decode_entities( $metabox ) );
		}
		else return false;
	}

	/**
	 * Get Metabox
	 *
	 * @access protected
	 * @param string|int $postID
	 * @return boolean
	 *
	 * action : save_post
	 */
	public function saveMetabox($postID)
	{
		$type = get_post_type();

		if (isset($this->wrapper[$type]->metabox->input) && $this->wrapper[$type]->metabox->input)
		{
			foreach ($this->wrapper[$type]->metabox->input as $input)
			{
				if ( defined( 'DOING_AUTOSAVE' ) ) return;
				if ( !isset( $_POST["{$type}-check"] ) || !wp_verify_nonce( $_POST["{$type}-check"], "{$type}-nonce" ) ) return;
				if ( !current_user_can( 'edit_post', $postID ) ) return;
				if ( isset( $_POST[$input->id] ) ) update_post_meta( $postID, $input->id, esc_attr( $_POST[$input->id] ) );
			}
		}
	}

	/**
	 * Custom template for single
	 *
	 * @param string $single template path
	 * @return string
	 *
	 * filter : archive_template
	 */
    public function customSingleTemplate($single)
	{
		global $post;

		$customSinglePostName = $this->templatePath . "single-{$post->post_type}-{$post->post_name}.php";
		if( file_exists( $customSinglePostName ) ) return $customSinglePostName;

		else
		{
			$customSingle = $this->templatePath . "single-{$post->post_type}.php";
			if( file_exists( $customSingle ) ) return $customSingle;
			else return $single;
		}
	}

	/**
	 * Custom template for archive
	 *
	 * @param string $archive template path
	 * @return string
	 *
	 * filter : archive_template
	 */
    public function customArchiveTemplate($archive)
	{
		if (have_posts()) 
		{
			global $post;
			$customArchive = $this->templatePath . "archive-{$post->post_type}.php";
			if( file_exists( $customArchive ) ) return $customArchive;
			else return $archive;
		}
	}

	/**
	 * Custom template for taxonomy
	 *
	 * @param string $taxonomy template path
	 * @return string
	 *
	 * filter : taxonomy_template
	 */
    public function customTaxonomyTemplate($taxonomy)
	{
		global $post;
		$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) ); 

		$customTaxonomy = $this->templatePath . "taxonomy-{$post->post_type}-{$term->slug}.php";
		if( file_exists( $customTaxonomy ) ) return $customTaxonomy;

		else
		{
			$customTaxonomy = $this->templatePath . "taxonomy-{$post->post_type}.php";
			if( file_exists( $customTaxonomy ) ) return $customTaxonomy;
			else return $taxonomy;
		}
	}

	/**
	 * Custom template for search
	 *
	 * @param string $template
	 * @return string
	 *
	 * filter : template_include
	 */
    public function customSearchTemplate($template)
	{
		global $wp_query, $post;

		$type = get_query_var( 'post_type' );

		if( $wp_query->is_search && isset($post) && $type == $post->post_type )
		{
			$customSearch = $this->templatePath . "search-{$post->post_type}.php";
			if( file_exists( $customSearch ) ) return $customSearch;
		}
		return $template;
	}

	/**
	 * Custom search
	 *
	 * @param string $query
	 * @return string
	 *
	 * filter : pre_get_posts
	 */
	public function customSearch($query)
	{
	    if ( is_search() && $query->get('s') )
	    {
	    	$type = get_query_var( 'post_type' );
	    	$meta = [
	    		['key' => 'bien-id', 'value' => '%s', 'compare' => 'LIKE' ]
	    	];
	        $query->set('post_type', [$type], $meta);
	    }
		return $query;
	}
}
