SET @wp_url_old = 'http://leverage.giraphprojects.com', @wp_url_new = 'http://myleverage.com';

UPDATE lev_options SET option_value = replace( option_value, @wp_url_old, @wp_url_new ) 
	WHERE option_value LIKE CONCAT( '%', @wp_url_old, '%' );

UPDATE lev_posts SET guid = replace( guid, @wp_url_old, @wp_url_new );

UPDATE lev_posts SET post_content = replace( post_content, @wp_url_old, @wp_url_new );

UPDATE lev_postmeta SET meta_value = replace( meta_value, @wp_url_old, '' ) WHERE `meta_key` IN( '_p_large-title-icon' );
