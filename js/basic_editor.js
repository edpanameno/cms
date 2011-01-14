tinyMCE.init({
	mode: "exact",
	elements: "text_description,note_description",
	theme: "advanced",
	plugins: "tabfocus",
	//button_tile_map: true,
	//auto_focus: "text_content",
	theme_advanced_toolbar_location: "top",
	theme_advanced_statusbar_location: "bottom",
	theme_advanced_toolbar_align: "left",
	theme_advanced_buttons1:
		"code,|,bold,italic,underline,|" +
		",copy,cut,paste,|,undo,redo,|," +
		",justifyleft,justifycenter,justifyright,justifyfull,preview" +
		",bullist,numlist,|,link,unlink,anchor,removeformat",
	theme_advanced_buttons2: "",
	//theme_advanced_resizing_horizontal: false,
	//theme_advanced_resizing_vertical: true
	//theme_advanced_resizing: true
	//content_css: "../../../../css/editor/content.css" // this works when creating tickets
	//content_css: "../css/editor/content.css"

	//tab_focus: ':prev,:next',
	//forced_root_block: false,
	//force_p_newlines: false,
	//remove_linebreaks: false,
	//force_br_newlines: true,
	//remove_trailing_nbsp: false
	//verify_html: false
});

