( function( $ ) {
	"use strict";

	var type  = ( $.fn.editabletypes.hasOwnProperty( 'ac_select2_tags' ) ) ? 'ac_select2_tags' : 'select2';

	var Select2_Classes = function( options ) {
		this.init( 'select2_classes', options, Select2_Classes.defaults );
	};

	$.fn.editableutils.inherit( Select2_Classes, $.fn.editabletypes[ type ] );

	$.extend( Select2_Classes.prototype, {} );

	Select2_Classes.defaults = $.extend( {}, $.fn.editabletypes[ type ].defaults );

	$.fn.editabletypes.select2_classes = Select2_Classes;

}( window.jQuery ) );

jQuery.fn.cacie_edit_select2_classes = function( column, item ) {

	var el = $( this );
	var value = el.cacie_get_value( column, item );
	var options = column.editable.options;

	// e.g. no terms available
	if ( ! value ) {
		value = [];
	}

	if ( $.fn.editabletypes.hasOwnProperty( 'ac_select2_tags' ) ) {

		el.cacie_xeditable( {
			type : 'ac_select2_tags',
			value : value,
			source : cacie_options_format_editable( options ),
			select2 : {
			width : 200,
				tags : true,
				multiple : true,
				tokenSeparators : [',',';',' '],
				escapeMarkup : function( text ) { return $( '<div>' + text + '</div>' ).text(); }
			}
		}, column, item );

	} else {

		el.cacie_xeditable( {
			type : 'select2',
			value : value,
	        select2 : {
	            width : 200,
		        tags : true,
	            options : cacie_options_format_editable( options ),
		        tokenSeparators : [',',';',' ']
	        }
		}, column, item );

	}
};