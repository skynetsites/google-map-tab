(function() {
    tinymce.PluginManager.add('gmt_tab', function( editor, url ) {
        editor.addButton( 'gmt_button_key', {
			title : 'Insert Google Map Tab',
            icon: true,
			image : url + '/images/gmt-icon.png',
            onclick: function() {
                editor.insertContent('[google-map-tab]');
            }
        });
    });
})();
