<?php
// <Internal Doc Start>
/*
*
* @description: 
* @tags: 
* @group: 
* @name: code from customizer that was making me insane
* @type: css
* @status: published
* @created_by: 
* @created_at: 
* @updated_at: 2025-01-16 11:51:16
* @is_valid: 
* @updated_by: 
* @priority: 10
* @run_at: wp_head
* @load_as_file: yes
* @condition: {"status":"no","run_if":"assertive","items":[[]]}
*/
?>
<?php if (!defined("ABSPATH")) { return;} // <Internal Doc End> ?>
.dc-inline-buttons .et_pb_button {
 display: inline-block;
 margin-right: 10px; 
}
/*** Responsive Styles Tablet And Below ***/
@media all and (max-width: 980px) {
#et-boc .et-l .dp-dfg-skin-default.dp-dfg-skin-split .dp-dfg-image,.dp-dfg-skin-default.dp-dfg-skin-split .dp-dfg-image,.et-l .dp-dfg-skin-default.dp-dfg-skin-split .dp-dfg-image {
    padding: 0;
    position: absolute;
}
 
	.et_pb_button_wrapper.read-more-wrapper {
    left: 180px;
    position: relative;
}
	
}

.et_pb_menu__search-button:after {
    content: " U" !important;
    padding-left: calc(0.3em + 0.3vw) !important;
}

li.menu-cta.et_pb_menu_page_id-5486.menu-item.menu-item-type-post_type.menu-item-object-page.menu-item-has-children.menu-item-376274 {
    border-right: calc(1px + 0.1vw) solid #fff !important;
    padding-right: calc(0.5em + 0.5vw) !important;
}

button.et_pb_menu__icon.et_pb_menu__search-button {
    padding-left: calc(0.5em + 0.3vw) !important;
}

/* Hide filter */
.ragnar_blog_adrian .blog_filter {
    display: none !important;
}

.testimonial6 .et_pb_column_1_3 .et_pb_team_member_description:after {
    content: "\f005\f005\f005\f005\f005";
    font-family: 'FontAwesome';
    color: #ED1C24 !important;
    font-size: clamp(0.8rem, 0.5em + 0.4vw, 1rem);
    margin: calc(1em + 0.5vw) 0 -0.5em;
    display: block;
}

/* Blog meta adjustments */
.et_pb_blog_0 .et_pb_post .post-meta,
.et_pb_blog_0 .et_pb_post .post-meta a,
#left-area .et_pb_blog_0 .et_pb_post .post-meta,
#left-area .et_pb_blog_0 .et_pb_post .post-meta a {
    font-family: 'Manrope', sans-serif;
    color: #000000 !important;
    line-height: 1.2;
    display: none !important;
}

/* Image aspect ratio adjustments */
.pa-blog-image-1-1 .entry-featured-image-url {
    padding-top: 100%;
    display: block;
}

.pa-blog-image-1-1 .entry-featured-image-url img {
    position: absolute !important;
    height: 100% !important;
    width: 100% !important;
    object-fit: cover !important;
}

figure.dp-dfg-image.entry-thumb img {
    position: absolute !important;
    height: 100% !important;
    width: 100% !important;
    object-fit: cover !important;
}

/* Font and icon adjustments */
.et-menu .menu-item-has-children > a:first-child:after {
    font-family: ETmodules;
    content: "\35" !important;
    font-size: clamp(0.8rem, 0.5em + 0.3vw, 1rem);
    position: absolute;
    right: 0;
    top: auto !important;
}

/* General Button Styles */
.et_pb_button_0_tb_header {
    padding: calc(0.4em + 0.2vw) calc(1em + 0.4vw) !important;
    font-size: clamp(0.9rem, 0.5em + 0.4vw, 1rem) !important;
    border-radius: calc(0.3em + 0.3vw) !important;
}

/* Language Selector Styles */
.lang_sel_list_horizontal {
    display: flex !important;
    justify-content: flex-end !important;
    align-items: center !important;
    list-style: none !important;
}

.lang_sel_list_horizontal li {
    margin: 0 calc(0.3em + 0.3vw) !important;
}

.lang_sel_list_horizontal a {
    font-size: clamp(0.8rem, 0.5em + 0.3vw, 1rem) !important;
    text-decoration: none !important;
    color: #000 !important;
    padding: calc(0.1em + 0.2vw) calc(0.4em + 0.3vw) !important;
    border-radius: calc(0.15em + 0.2vw) !important;
    transition: background-color 0.3s ease, color 0.3s ease !important;
}

.lang_sel_list_horizontal a:hover {
    background-color: #f0f0f0 !important;
    color: #333 !important;
}

.lang_sel_list_horizontal .wpml-ls-current-language a {
    font-weight: bold !important;
    color: #d00 !important;
}

/* Header Flexbox Layout */
.et_pb_menu__wrap {
    display: flex !important;
    align-items: center !important;
    justify-content: flex-start !important;
    width: 100% !important;
    flex-wrap: nowrap !important;
}

.et_pb_menu__menu {
    display: flex !important;
    align-items: center !important;
    justify-content: flex-start !important;
    flex: 1;
}

.menu-cta {
    margin-left: auto !important;
    display: flex !important;
    align-items: center !important;
}

.menu-cta > a {
    color: #ED1C24 !important;
    padding: calc(0.5em + 0.3vw) calc(0.7em + 0.4vw) !important;
    border-radius: calc(0.25em + 0.3vw) !important;
    font-weight: bold !important;
    background-color: white !important;
    text-decoration: none !important;
}

/* Submenu alignment */
.menu-cta .sub-menu {
    position: absolute !important;
    right: 0 !important;
    background-color: #fff !important;
}

/* Mobile Menu adjustments */
@media (max-width: 768px) {
    .et_pb_menu__wrap {
        flex-direction: column !important;
        align-items: flex-start !important;
    }

    .menu-cta {
        margin-left: 0 !important;
        width: 100% !important;
        text-align: center !important;
    }

    .et_pb_menu__menu a {
        font-size: calc(0.6em + 2vw) !important;
    }

    .et_pb_menu__menu {
        flex-direction: column !important;
    }

    .menu-cta a {
        width: 100% !important;
    }
}

li.menu-cta.et_pb_menu_page_id-5486.menu-item.menu-item-type-post_type.menu-item-object-page.menu-item-has-children.menu-item-376274 > a {
    color: #ED1C24 !important;
}

li.et_pb_menu_page_id-355.menu-item {
    margin-right: calc(2em + 2vw) !important;
}

@media (max-width: 1200px) {
    li.et_pb_menu_page_id-355.menu-item {
        margin-right: calc(1.5em + 1.5vw) !important;
    }
}

@media (max-width: 992px) {
    li.et_pb_menu_page_id-355.menu-item {
        margin-right: calc(1em + 1vw) !important;
    }
}

@media (max-width: 768px) {
    li.et_pb_menu_page_id-355.menu-item {
        margin-right: calc(0.5em + 0.5vw) !important;
    }
}

@media (max-width: 576px) {
    li.et_pb_menu_page_id-355.menu-item {
        margin-right: calc(0.3em + 0.3vw) !important;
    }
}

.et-menu li a {
    font-size: clamp(0.8rem, 0.5em + 0.3vw, 1.2rem) !important;
}

li.menu-cta.et_pb_menu_page_id-385483.menu-item > a {
    color: #ED1C24 !important;
}

/* Large Desktop */
@media (min-width: 1405px) {
    .et_pb_menu--without-logo .et_pb_menu__menu > nav > ul > li {
        margin-top: 0 !important;
        display: flex !important;
        justify-content: center;
        align-items: center;
    }

    .et_pb_menu--without-logo .et_pb_menu__menu > nav > ul > li > a {
        margin: 0;
        padding: calc(0.5em + 0.4vw) calc(0.7em + 0.5vw);
        display: flex;
        justify-content: center;
        align-items: center;
    }
}

li.menu-cta.et_pb_menu_page_id-5486.menu-item.menu-item-type-post_type.menu-item-object-page.menu-item-has-children.menu-item-25997593 > a {
    color: #ED1C24 !important;
}


.et_pb_menu_inner_container.clearfix {
    width: max-content !important;
}

.et_pb_menu .et_pb_menu__menu,.et_pb_menu .et_pb_menu__menu>nav,.et_pb_menu .et_pb_menu__menu>nav>ul {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-align: center !important;
    -ms-flex-align: center !important;
    align-items: center !important;
}



/* Search Fix */
.et_pb_menu__search-button:before {
    content: " Αναζήτηση " !important;
    font-family: "Manrope", serif !important;
    order: 2 !important;
	font-size: clamp(0.8rem, 0.5em + 0.3vw, 1rem);
}

/* Search Container Fix */
.et_pb_menu .et_pb_menu__search-container {
    background: #ffffff;
    width: 30% !important;
    height: 100% !important;
    bottom: 20px !important;
    right: 0 !important;
    left: auto !important;
    border-radius: 3px !important;
    padding-left: 20px !important;
    top: 0px !important;
}

/*search fix start*/
.et_pb_menu .et_pb_menu__search-container {
	background: #ffffff;
	width: 30% !important;
	height:100% !important;
	bottom: 20px !important;
	right:0 !important;
	left:auto !important;
	border-radius: 3px !important;
	padding-left:20px !important;
	top:0px !important;
}
/*search fix end*/



/*sharing is caring magic start*/

.addtoany_share_save_container.addtoany_content.addtoany_content_bottom:before {
    content: "Sharing is Caring";
    font-weight: 900;
    font-family: "Manrope",sans-serif;
    color: #33879E;
    display: flex;
    position: relative;
    top: -10px;
}
/*sharing is caring magic end*/


/*photo fix start*/
figure.wp-block-gallery {
    padding-top: 30px !important;
		padding-bottom: 30px !important;
}
/*photo fix end*/

p:not(.has-background):last-of-type {
    padding-bottom: 10px !important;
	
}