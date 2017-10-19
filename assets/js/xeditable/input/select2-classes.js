( function( $ ) {
	"use strict";

	var Select2_Classes = function( options ) {
		this.init( 'select2_classes', options, Select2_Classes.defaults );
	};

	$.fn.editableutils.inherit( Select2_Classes, $.fn.editabletypes.select2 );

	$.extend( Select2_Classes.prototype, {} );

	Select2_Classes.defaults = $.extend( {}, $.fn.editabletypes.select2.defaults );

	$.fn.editabletypes.select2_classes = Select2_Classes;

	console.log( $.fn.editabletypes );
}( window.jQuery ) );

jQuery.fn.cacie_edit_select2_classes = function( column, item ) {

	var el = $( this );
	var value = el.cacie_get_value( column, item );
	var options = column.editable.options;

	el.cacie_xeditable( {
		type : 'select2',
		value : value,
        select2 : {
            width : 200,
            tags : cacie_options_format_editable( options ),
	        tokenSeparators : [',',';',' ']
        }
	}, column, item );
};