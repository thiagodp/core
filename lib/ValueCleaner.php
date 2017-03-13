<?php
namespace phputil\core;

/**
 * Value cleaner
 *
 * @author	Thiago Delgado Pinto
 */
class ValueCleaner {

	/**
	 *  Clear a value or an array value. If the array has subarrays, clean them
	 *  recursively.
	 *  
	 *  @param mixed $value				Value or array to clean.
	 *  @param bool $useTrim			Remove spaces arround the value.
	 * 									Default true.
	 *  @param bool $encodeAllEntities	Encode all HTML entities, including
	 *									accentuation. Default false.
	 *  @return mixed					Clean value or array.
	 */	
	function clean(
			$value,
			$useTrim = true,
			$encodeAllEntities = false,
			$charset = 'UTF-8'
			) {
		if ( is_array( $value ) ) {
			$clean = array();
			foreach ( $value as $k => $v ) {
				$clean[ $k ] = $this->clean( $v, $useTrim, $encodeAllEntities, $charset );
			}
			return $clean;			
		} else {
			$content = $useTrim ? trim( $value ) : $value;
			return $encodeAllEntities
				? htmlentities( $content, ENT_COMPAT, $charset )
				: htmlspecialchars( $content, ENT_COMPAT, $charset );
		}
	}
	
}

?>