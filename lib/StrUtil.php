<?php
namespace phputil\core;

/**
 * Useful string functions.
 *
 * @author Thiago Delgado Pinto
 */
class StrUtil {

	/**
	 * Transforms a snake_case string into a camelCase string.
	 *
	 * @param string $snake	the string to convert
	 * @return string
	 */
	function snakeToCamel( $snake ) {
			$pieces = explode( '_', $snake );
			$count = count( $pieces );
			if ( 1 == $count ) {
				return $snake;
			}
			$str = $pieces[ 0 ];
			for ( $i = 1; $i < $count; ++$i ) {
				$p = $pieces[ $i ];
				$str .= mb_strtoupper( $p[ 0 ] ) . mb_substr( $p, 1 );
			}
			return $str;
	}

	/**
	 * Transforms a camelCase string into a snake_case string.
	 *
	 * @param string $camel	the string to convert
	 * @return string
	 */
	function camelToSnake( $camel ) {
		return mb_strtolower( preg_replace( '/([A-Z])/u', "_$1", $camel ) );
	}

	/**
	 * Transforms a text to uppercase.
	 *
	 * @deprecated	Use {@link mb_strtoupper} instead.
	 *
	 * @param text		the text to transform.
	 * @param encoding	the character encoding to use. default is {@link mb_internal_encoding()}.
	 * @return			the text in uppercase.
	 */
	function toUpper( $text, $encoding = null ) {
		$enc = is_string( $encoding ) ? $encoding : mb_internal_encoding();
		return mb_strtoupper( $text, $enc );
	}

	/**
	 * Transforms a text to lowercase.
	 *
	 * @deprecated	Use {@link mb_strtolower} instead.
	 *
	 * @param text		the text to transform.
	 * @param encoding	the character encoding to use. default is {@link mb_internal_encoding()}.
	 * @return			the text in lowercase.
	 */
	function toLower( $text, $encoding = null ) {
		$enc = is_string( $encoding ) ? $encoding : mb_internal_encoding();
		return mb_strtolower( $text, $enc );
	}
	
	/**
	 * Transforms all the letters of a sentence to lowercase and 
	 * just the first letter of each word to uppercase.
	 * 
	 * This method can be replaced by
	 * 		mb_convert_case( 'your text here', MB_CASE_TITLE )
	 * when the "exceptions" parameter is not given.
	 *
	 * How to use it:
	 *   ( 'john von neumann', array( ' von ' ) ) produces 'John von Neumann'
	 *   ( 'JOHN VON NEUMANN', array( ' von ' ) ) produces 'John von Neumann'
	 *   ( 'maria da silva e castro', array( ' da ', ' e '  ) ) produces 'Maria da Silva e Castro'
	 *
	 * @see {@link commonNameExceptions}.
	 * 
	 * @param text			text to transform.
	 * @param exceptions	array of words to ignore exceptions.
	 * @param encoding		the character encoding to use. default is {@link mb_internal_encoding()}.
	 * @return				the transformed text.
	 */
	function upperCaseFirst(
		$text,
		array $exceptions = array(),
		$encoding = null
		) {
		$enc = is_string( $encoding ) ? $encoding : mb_internal_encoding();
		$newText = mb_convert_case( $text, MB_CASE_TITLE, $enc );
		if ( count( $exceptions ) < 1 ) {
			return $newText;
		}
		foreach ( $exceptions as $e ) {
			$newText = str_replace( mb_convert_case( $e, MB_CASE_TITLE, $enc ),
				mb_convert_case( $e, MB_CASE_LOWER, $enc ), $newText );
		}
		return $newText;
	}

	/** Common name separators to be used as exceptions with {@link upperCaseFirst}. */
	function commonNameSeparators() {
		return array(
			' de ', ' da ', ' di ', ' del ', ' della ',
			' e ', ' i ', ' y ',
			' van ', ' von '
			);
	}
}

?>