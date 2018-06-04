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

use \VanilleNameSpace\core\system\libraries\interfaces\ConfigInterface;

class CustomPostType extends CustomPost
{
    /**
     * @access private
     */
    private $config;
    
    /**
     * Custom post init
     *
     * @param ConfigInterface $config
     * @return void
     */
    public function __construct(ConfigInterface $config)
    {
        // Set custom post & templates paths
        $this->config = $config;
        $this->setPath($this->config->get('path')->custompost);
        $this->setTemplatePath($this->config->get('path')->templates->custompost);

        /**
         * Build custom post type
         * priority :0
         * @see init@parent
         */
        $this->addAction('init', [$this,'init'], 0);

        /**
         * Custom single template
         * @see customSingleTemplate@parent
         */
        $this->addFilter('single_template', [$this,'customSingleTemplate']);

        /**
         * Custom single template
         * @see customArchiveTemplate@parent
         */
        $this->addFilter('archive_template', [$this,'customArchiveTemplate']);

        /**
         * Custom taxonomy template
         * @see customArchiveTemplate@parent
         */
        $this->addFilter('taxonomy_template', [$this,'customTaxonomyTemplate']);

        /**
         * Custom search
         * @see customSearchTemplate@parent
         */
        $this->addFilter('template_include', [$this,'customSearchTemplate']);

        /**
         * Add metabox
         * @see initMetabox@parent
         */
        $this->addAction('add_meta_boxes', [$this,'initMetabox']);

        /**
         * Save metabox
         * @see saveMetabox@parent
         */
        $this->addAction('save_post', [$this,'saveMetabox']);
    }
}
