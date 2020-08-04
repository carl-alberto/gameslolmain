/**** 
* AMP Framework Reset
*****/
    body{ font-family: Open Sans, sans-serif; font-size: 12pt; line-height:1.4; }
    ol, ul{ list-style-position: inside }
    p, ol, ul, figure{ margin: 0 0 1em; padding: 0; }
    a, a:active, a:visited{ color:#000; text-decoration: none }
    a:hover, a:active, a:focus{}
    pre{ white-space: pre-wrap;}
    .left{float:left}
    .right{float:right}
    .hidden{ display:none }
    .clearfix{ clear:both }
    blockquote{ background: #f1f1f1; margin: 10px 0 20px 0; padding: 15px;}
    blockquote p:last-child {margin-bottom: 0;}
    .amp-wp-unknown-size img {object-fit: contain;}
    .amp-wp-enforced-sizes{ max-width: 100% }
    /* Image Alignment */
    .alignright {
        float: right;
    }
    .alignleft {
        float: left;
    }
    .aligncenter {
        display: block;
        margin-left: auto;
        margin-right: auto;
    }
    amp-iframe { max-width: 100%; margin-bottom : 20px; }

    /* Captions */
    .wp-caption {
        padding: 0;
    }
    .wp-caption-text {
        font-size: 12px;
        line-height: 1.5em;
        margin: 0;
        padding: .66em 10px .75em;
        text-align: center;
    }

    /* AMP Media */
    amp-iframe,
    amp-youtube,
    amp-instagram,
    amp-vine {
        margin: 0 -16px 1.5em;
    }
    amp-carousel > amp-img > img {
        object-fit: contain;
    }


/****
* Container
*****/
.container {
    width: 100%;
    max-width: 1200px;
    margin: 0 auto;
    box-sizing: border-box;
    padding: 0px 20px;
}

.content-wrapper {
	margin-top: 50px;
	padding-bottom: 10px;
}

#frontpage {
	padding: 10px;
}

#pageheader {
	padding: 10px;
    background: #cae6e8;
    margin-bottom: 10px;
    text-align: center;
}

#pagecontent .content a {
   color: blue;
}


#pagecontent .content amp-img,
#pagecontent .content img {
   margin: 10px auto;
}

/****
* GAME PAGE 
*****/

#gamebanner {
    height: 300px;
    overflow: hidden;
    position: relative;
    background: black;
}

    #gamebanner .bannerbg {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%; height: 100%;
    }
    
    #gamebanner .bannerimg {
    	position: relative;
	   width: 100%;
	   height: 100%;
    }

    #gamebanner .bannerbg amp-img.cover img{
        object-fit: cover;
        filter: blur(10px);
    }


    #gamebanner .banneroverlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        overflow: hidden;
        padding: 10px;
        display: flex;
        flex-direction: column;
        text-align: center;
        flex-wrap: wrap;
        box-sizing:  border-box;
        align-items: center;
    	justify-content: center;
    }

    #gamebanner .banneroverlay .gameimg {
		position: relative;
	   width: 300px;
	   height: 180px;
    }
    
    #gamebanner .banneroverlay amp-img.contain img {
    	object-fit: contain;
  	}

#gamepageheader {
	padding: 10px;
	background: #cae6e8;
	margin-bottom: 10px;
	width: 100%;
	box-sizing: border-box;
	font-size: 10pt;
}

	#gamepageheader>.container {
		box-sizing:  border-box;
		flex-direction: row;
		flex-wrap: wrap;
		padding: 0;
		display: flex;
	}

    #gamepageheader .icon {
        width: 100px;
        height: 100px;
        margin-right: 10px;
    }

    #gamepageheader .title {
        flex: 1;
    }
    #gamepageheader .title h2 {
        margin: 5px auto;
    }

    #gamepageheader .social {
        float: right;
    }
    
    #gamereviews h3 {
    margin-bottom: 0;
}

.rr_review_post_id {
    display: none;
}

.testimonial_group {
    display: flex;
    align-items:  center;
    justify-content:  center;
    box-sizing: border-box;
    flex-wrap: wrap;
    margin-bottom: 20px;
}

.testimonial {
    text-align: center;
    flex: 1;
    box-sizing: border-box;
    padding: 5px;
    min-width: 350px;
    max-width: 100%;
}
     
    p.categories {
    	margin-top: 5px;
    }
    
    p.categories a {
    	padding: 2px 10px;
    	border-radius: 20px;
    	border: 2px solid black;
    	display: inline-block;
    	font-size:  10pt;
    	margin: 2px 2px 2px 0;
    }

    p.categories a:hover {
    	color: white;
    	background: black;
    }

    .reviewbtn {
    	display: inline-block;
    	margin: 2px;
    	padding: 10px 15px;
    	background: #17a2b8;
    	border-radius: 5px;
    }

    .reviewbtn.yellow {
    	background: #ffc107;
    }

/****
* AMP Sidebar
*****/
    amp-sidebar {
        width: 100%;
		background: rgba(51, 51, 51, 0.9);
		color: whitesmoke;
    }
    
    /* AMP Sidebar Toggle button */
    .amp-sidebar-button{
        position:relative;
    }
    .amp-sidebar-toggle  {
    }
    .amp-sidebar-toggle span  {
        display: block;
        height: 2px;
        margin-top: 5px;
        width: 22px;
        background: #81b30e;
    }
    .amp-sidebar-toggle span:nth-child(2){
        top: 7px;
    }
    .amp-sidebar-toggle span:nth-child(3){
        top:14px;
    }

    /* AMP Sidebar close button */
    .amp-sidebar-close{
        background: black;
        display: block;
        width: 100%;
        text-align: left;
        box-sizing: border-box;
        padding: 10px;
        font-size: 12px;
        color: #fff;
    }
    
    .amp-search-wrapper {
    	box-sizing: border-box;
    	padding: 5px;
    }
    
    .amp-search-wrapper input[type=text] {
		box-sizing: border-box;
		font-size: 12pt;
		padding: 5px;
		font-family: Open Sans, sans-serif;
		border-radius: 3px;
		border: 1px solid black;
		background: #ececec;
		color: black;
    }
    
    .amp-search-wrapper input[type=submit] {
		box-sizing: border-box;
		font-size: 12pt;
		padding: 9px;
		display: inline-block;
		background: black;
		border: none;
		font-family: Open Sans, sans-serif;
		content: '/f002';
		color: white;
		
    }
    
	.amp-menu>li a {
		color: white;
	}
	.amp-social {
		padding: 10px;
		font-size: 15px;
		display: inline-block;
		box-sizing: border-box;
	}

/****
* AMP Navigation Menu with Dropdown Support
*****/
    .toggle-navigation ul{
        list-style-type: none;
        margin: 0;
        padding: 0;
        display: inline-block;
        width: 100%
    }
    .toggle-navigation ul li{
        font-size: 13px;
        border-bottom: 1px solid rgba(0, 0, 0, 0.11);
        padding: 11px 0px;
        width: 25%;
        float: left;
        text-align: center;
        margin-top: 6px
    }
    .toggle-navigation ul ul{
        display: none
    }
    .toggle-navigation ul li a{
        color: #eee;
        padding: 15px;
    }
    .toggle-navigation{
        display: none;
        background: #444;
    }


/**** 
* Header
*****/

.header {
  padding: 8px 10px;
  height: auto;
  position: fixed;
  z-index: 999;
  top: 0;
  width: 100%;
  background: black;
  box-sizing: border-box;
 }
.header>.container {
  display: flex;
  justify-content: space-between;
  padding: 0;
}

	.header-logo,
	.header-right {
	}

.amp-logo {
    max-height:36px;
}
    .header h1{
        font-size: 1.5em;
    }
    .header .right{
        margin: 16px 5px 0px 5px;
    }
    .amp-phone, .amp-social, .amp-sidebar-button{
        display:inline-flex 
    }
    .amp-phone{
        top: 4px;
    }
    .header .amp-social{
        margin: 0px 19px;
    }
    .amp-sidebar-button{
        top: 6px;
    }


/**** 
* Loop
*****/
    .loop-post{
        display: inline-block;
        width: 100%;
        margin: 6px 0px;
    }
    .loop-post .loop-img{
        float: left;
        margin-right: 15px;
    }
    .loop-post h2{
        font-size: 1.2em;
        margin: 0px 0px 8px 0px;
    }
    .loop-post p{
        font-size: 14px;
        color: #333;
        margin-bottom:6px;
    }
    .loop-post ul{
        list-style-type: none;
        display: inline-flex;
        margin: 0px;
        font-size: 14px;
        color: #666;
    }
    .loop-post ul li{
        margin-right:2px;
    }
    .loop-date{
        font-size:12px;
    }


/****
* Pagination
*****/
#pagination {
    text-align: center;
    margin: 20px auto 30px;
}

#pagination .pagination ul {
	list-style-type: none;
	margin: 0;
	padding: 0;
}


#pagination .pagination li {
    display: inline-block;
    margin: auto 0;
	border-top: 1px solid #cccccc;
	border-bottom: 1px solid #cccccc;
	border-right: 1px solid #cccccc;
	border-left: none;
	overflow: hidden;
}


#pagination .pagination li:first-child {
    border-top-left-radius: 5px;
    border-bottom-left-radius: 5px;
	border-left: 1px solid #cccccc;
}


#pagination .pagination li:last-child {
    border-top-right-radius: 5px;
    border-bottom-right-radius: 5px;
}



#pagination .pagination li .page-link {
	display: block;
    padding: 5px 10px;
    color: black;
}

#pagination .pagination li .page-link:hover {

    background: #d2d2d2;

}

#pagination .pagination li .page-link.current {
    background: black;
    color: white;

}

#pagination .pagination li .page-link.current:hover {
    background: black;

}

/****
* CATEGORY CLOUD
*****/

.category_cloud {
    color: gray;
    font-size: 10pt;
}
.category_cloud a {
    display: inline-block;
    border: 1px solid #c5c5c5;
    padding: 3px 10px;
    border-radius: 10px;
	margin: 2px auto;
}


.category_cloud a:hover {
    background: #eaeaea;
}

/****
* Single
*****/
    /** Related Posts **/
    .amp-related-posts ul{
        list-style-type:none;
    }
    .amp-related-posts ul li{
        display: inline-block;
        line-height: 1.3;
        margin-bottom: 5px;
    }
    .amp-related-posts amp-img{
        float: left;
        width: 100px;
        margin: 0px 10px 0px 0px;
    }


/**** 
* Comments
*****/
	.comments_list ul{
	    margin:0;
	    padding:0
	}
	.comments_list ul.children{
	    padding-bottom:10px;
		margin-left: 4%;
		width: 96%;
	}
	.comments_list ul li p{
        margin: 0;
        font-size: 14px;
        clear: both;
        padding-top: 5px;
	}
    .comments_list ul li .says{
        margin-right: 4px;
    }
	.comments_list ul li .comment-body{
	    padding: 10px 0px 15px 0px;
	}
	.comments_list li li{
	    margin: 20px 20px 10px 20px;
	    background: #f7f7f7;
	    box-shadow: none;
	    border: 1px solid #eee;
	}
	.comments_list li li li{
	    margin:20px 20px 10px 20px
	}
	.comment-author{ float:left }

    
   
/**** 
* Content Area
*****/
  
   h2.widget_title {
    background-color: black;
    color: white;
    padding: 5px 10px;
    display: inline-block;
}
  
  a.downloadbtn,
  button.downloadbtn {
	  outline: none;
      border: 1px solid #134a00;
      border-radius: 10px;
	  padding: 15px 20px;
	  font-size: 14pt;
	  color: white;
	  text-align: center;
	  background: #2b840a;
	  margin: 10px;
  }
   
  a.playbtn,
  button.playbtn {
	  outline: none;
      border: 1px solid #b59600;
      border-radius: 10px;
	  padding: 15px 20px;
	  font-size: 14pt;
	  color: black;
	  text-align: center;
	  background: #ffd300;
	  margin: 10px;
  }
   

/****
* GRID Styles
*****/

.grid {
    width: 100%;
    display: flex;
    flex-direction: row;
    flex-wrap: wrap;
    box-sizing: border-box;
    justify-content: center;
	margin-bottom: 20px;
    
}

.grid .item {
    width: calc(50% - 10px);
    max-width: 200px;
    margin: 5px;
    overflow: hidden;
    background: #cae6e8;
    border: 1px solid #a0bbbd;
    box-sizing: border-box;
    position: relative;
}
    .grid_game .item {
		width: calc(50% - 10px);
		max-width: 150px;
    }
    
    .grid_article .item {
    	width: 100%;
   		max-width: 350px;
    }

	.grid_walkthrough .item {

   		max-width: 120px;
		border: none;
		background: none;
		text-align: center;
	}
    
    .grid .item .preview {
        display: block; width: 100%;
    }
    
    	.grid_game .item .preview {
    	    padding: 5px;
    		box-sizing: border-box;
    		max-height: 200px;
    	}
    	
    	.grid_article .item .preview {
    		max-height: 150px;
    	}

    .grid .item .preview amp-img,
    .grid .item .preview img{
        width: 100%;
        overflow: hidden;
		max-height: 200px;
   		object-fit: cover;
    }

    .grid .item .details {
        display: block;
        padding: 0 5px;
    }

    .grid .item h2 {
        margin: 5px 0 5px;
        font-size: 12pt;
    }

    .grid .item .details p {
        font-size: 9pt;
    }

    .grid .item .rating {
        position: absolute;
        top: 0;
        left: 0;
        font-size: 9pt;
        display: block;
        background: black;
        padding: 5px;
        color: white;
    }
    
    .grid .item .tag {
        position: absolute;
        top: 0;
        right: 0;
        font-size: 9pt;
        display: block;
        background: #f18229;
        padding: 5px;
        color: white;
    }

.grid_levels a.item {
    max-width: calc(100px);
    border: none;
    color: #b5b5b5;
    background: #f3f3f3;
    text-align: center;
    padding: 5px 10px;
}

.grid_levels a.item span {
    display: block;
}

.grid_levels a.item span.levelnum {
    font-size: 20pt;
}

.grid_levels a.item.active {
    background: #daf3f5;
}

.grid_levels a.item.active span.leveltext {
    color: #89a7a9;
}
.grid_levels a.item.active span.levelnum {
    color: #0083ca;
    font-weight: 700;
}

.loop_faq .item {
    display: flex;
    width: 100%;
}

.loop_faq .item .preview {
   display: inline-block;
   width: 25%; 
   min-width: 150px;
   padding: 5px;
   box-sizing: border-box;
	min-height: 150px;
	max-height: 200px;
}

.loop_faq .item .preview amp-img,
.loop_faq .item .preview img{
    width: 100%;
    overflow: hidden;
	min-height: 150px;
    max-height: 200px;
    object-fit: cover;
}

.loop_faq .item .details {
    display:  inline-block; 
    padding: 0 5px;
 }

 .loop_faq .item h2 {
        margin: 5px 0 5px;
        font-size: 16pt;
    }

/**** 
* Widgets
*****/
	
.widget_trendinglist {

}

	.widget_trendinglist .list_game .item {
		width: 100%;
		height: 60px;
		margin-bottom: 5px;
		position: relative;
	}

	.widget_trendinglist .list_game .item-content {
		position: absolute;
		top: 0; left: 0;
		width: 100%;
		height: 100%;
		display: flex;
		flex-direction: row;
		overflow: hidden;
	}

	.widget_trendinglist .list_game .item-link {
		position: absolute;
		top: 0; left: 0;
		width: 100%;
		height: 100%;
	}

	.widget_trendinglist .list_game .item .rank {
		width: 60px;
		height: 60px;
		line-height: 60px;
		text-align: center;
		background: #157a28;
		margin-right: 5px;
		font-size: 30pt;
		color: white;
	}

	.widget_trendinglist .list_game .item:nth-child(1) .rank {
		background: #e01e0a;
	}
	.widget_trendinglist .list_game .item:nth-child(2) .rank {
		background: #ef7c2e;
	}
	.widget_trendinglist .list_game .item:nth-child(3) .rank {
		background: #efb706;
	}

	.widget_trendinglist .list_game .item .preview {
		width: 60px;
    		height: 60px;
		overflow: hidden;
		margin-right: 5px;
		object-fit: cover;
	}

	.widget_trendinglist .list_game .item .preview img {
		width: 100%; height: 100%;
		object-fit: cover;
	}

	.widget_trendinglist .list_game .item .cta {
		flex: 1;
		font-size: 12pt;
		display: flex;
		height: 60px;
		overflow: hidden;
		padding: 5px 0px 5px 8px;
		background: #6f80ff;
		color: #fff;
		border: 1px solid transparent;
	}
	
		.widget_trendinglist .list_game .item:hover .cta {
			
			background: #515fca;
		}

	.widget_trendinglist .list_game .item .cta span.title {
		flex: 1;
		display: block;
		overflow: hidden;
		height: 100%;
		line-height: 22px;
	}

	.content-wrapper .widget_connect .widget_title {
		display: none;
	}
	
	.content-wrapper .widget_connect ul {	
		list-style-type: none;
	    display: flex;
		padding: 0;
	}
	.content-wrapper .widget_taglist ul {	
		list-style-type: none;
		padding: 0;
	}

	.content-wrapper .widget_connect ul li {
	    flex: 1;
	    padding: 2px 2px;
	    margin: 0 2px;
		text-align: center;
	}
	.content-wrapper .widget_taglist ul li {;
		display: inline-block;
		margin: 3px 0;
	}
	
	.content-wrapper .widget_connect ul li a {
		font-size: 12pt;
		color: white;
		display: block;
		padding: 5px;
	}

	.content-wrapper .widget_connect ul li.connect_facebook {
		background: #3b5998;
		border: 2px solid #3b5998;
	}
	
	.content-wrapper .widget_connect ul li.connect_twitter {
		background: #1da1f2;
		border: 2px solid #1da1f2;
	}
	.content-wrapper .widget_connect ul li.connect_pinterest {
		background: #d0343a;
		border: 2px solid #d0343a;
	}
	.content-wrapper .widget_connect ul li.connect_google {
		background: #dc4e41;
		border: 2px solid #dc4e41;
	}
	
	.content-wrapper .widget_connect ul li a:hover {
		background: white;
	}
	.content-wrapper .widget_connect ul li.connect_facebook a:hover {
		color: #3b5998;
	}
	
	.content-wrapper .widget_connect ul li.connect_twitter a:hover  {
		color: #1da1f2;
	}
	.content-wrapper .widget_connect ul li.connect_pinterest a:hover  {
		color: #d0343a;
	}
	.content-wrapper .widget_connect ul li.connect_google a:hover {
		color: #dc4e41;
	}

	.content-wrapper .widget_taglist ul li a {	
		padding: 2px 10px;
		border-radius: 20px;
		border: 2px solid black;
		display: inline-block;
	}

	.content-wrapper .widget_taglist ul li a:hover {	
		background: black;
		color: white;
	}
	

/**** 
* Footer
*****/
   
    .footer-widgets {
    	display: block;
    	width: 100%;
    	padding: 10px 0;
    	background: #a3b5bf;
    	text-align: center;
    }
    
    	.footer-widgets h4 {
    		margin: 2px 0;
    	}
    
    	.footer-widgets ul {
    		padding: 0;
    		list-style-type: none;
    	}
    	
    	.footer-widgets ul li {
    		display: inline-block;
    		padding: 0 15px 0 10px;
    		font-size: 10pt;
    		border-right: 1px #82949e solid;
    	}
    	
    	.footer-widgets ul li:last-child {
    		border-right: none;
    	}
    	
    	.footer-widgets ul li>a {
    		color: black;
    	}
   
    .footer{
        padding: 10px 0px 10px 0px;
        font-size: 9pt;
        text-align: center;
        background: black;
        color: white;
    }
    
    .footer a {
    	color: #ececec;
    }
    
    .footer a.view-non-amp {
    	display: block;
    	color: green;
    }
    .sticky_social {
		width: 100%;
		background: #272727;
		text-align: center;
   		padding: 5px 0;
    }
    
/****
* RTL Styles
*****/
    <?php  if( is_rtl() ) {?> <?php } ?>
