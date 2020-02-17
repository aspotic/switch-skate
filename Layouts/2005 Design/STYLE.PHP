<?php
/*
Made by Adam K (switchskate@gmail.com)

Styles File

Please do not redistribute this merchandise because you and the person you give the file(s) to will be prosecuted.
DO NOT EDIT THIS UNLESS YOU ARE AN EXPERIANCED PROGRAMMER AND WILL NOT REDISTRIBUTE THIS PRODUCT

*/

// Open a theme

if ($logged == 0){
   $OpenThemeQuery = "SELECT * from schemes  WHERE id = $defaulttheme";
} else {
   $OpenThemeQuery = "SELECT * from schemes  WHERE id = $scheme";
}
   $ThemeResult = mysql_db_query ($database, $OpenThemeQuery, $dblink);
if ($Theme = mysql_fetch_array($ThemeResult)){} else
{print ("Error opening theme, please report to $???.  Thank you.");}

$TableWide = $Theme[tablewidth];

echo "
<style>

body {
	 margin-top:$Theme[topmargin] ;
	 margin-left: auto ;
	 margin-right: auto ;
	 text-align: $Theme[alignbody] ;
	 background-color: $Theme[background] ;
}


table.dimensions { 
	 font-family: $Theme[fontface] ;
	 width: $Theme[tablewidth] ;
	 border: $Theme[bordersize] $Theme[bordertype] $Theme[bordercolor] ;
} 


table.left { 
	 font-family: $Theme[fontface] ;
	 width: $Theme[widthleft] ;
	 border: $Theme[bordersize] $Theme[bordertype] $Theme[bordercolor] ;
} 


table.right { 
	 font-family: $Theme[fontface] ;
	 width: $Theme[widthright] ;
	 border: $Theme[bordersize] $Theme[bordertype] $Theme[bordercolor] ;
} 


table#whole {
	 width: $Theme[tablewidth] ;
}


td#toptable { 
	 background-color: $Theme[toptablecolor] ;
	 font-family: $Theme[fontface] ;
	 color: $Theme[colortoptable] ;
	 text-align: $Theme[txtaligntoptable] ;
} 


td#header { 
	 background-color: $Theme[headercolor] ;
	 font-family: $Theme[fontface] ;
	 color: $Theme[colorheader] ;
	 text-align: $Theme[txtalignheader] ;
}  


td#center {
	 width: $Theme[widthcenter] ;
}


td.catagoryside {
	 background-color: $Theme[catagorybg] ;
	 font-family: $Theme[fontface] ;
	 color: $Theme[colorcatagory] ;
	 text-align: $Theme[txtaligncatagory] ;
}


td.alt1 {
	 background-color: $Theme[alt1] ;
	 font-family: $Theme[fontface] ;
	 color: $Theme[coloralt1] ;
	 text-align: $Theme[txtalign] ;
}


td.alt2 {
	 background-color: $Theme[alt2] ;
	 font-family: $Theme[fontface] ;
	 color: $Theme[coloralt2] ;
	 text-align: $Theme[txtalign] ;
}


a {
	 text-decoration:none;
	 color: $Theme[linkcolor] ;
}


a:hover {
	 text-decoration:none;
	 font-weight: normal ;
	 color: $Theme[linkover] ;
}


select {
	 color: $Theme[colortoptable] ;
	 background-color: $Theme[toptablecolor] ;
	 font-family: $Theme[fontface] ;
	 border: $Theme[bordersize] $Theme[bordertype] $Theme[bordercolor] ;
}


textarea {
	 color: $Theme[colortoptable] ;
	 background-color: $Theme[toptablecolor] ;
	 font-family: $Theme[fontface] ;
	 border: $Theme[bordersize] $Theme[bordertype] $Theme[bordercolor] ;
}


input {
	 color: $Theme[colortoptable] ;
	 background-color: $Theme[toptablecolor] ;
	 font-family: $Theme[fontface] ;
	 border: $Theme[bordersize] $Theme[bordertype] $Theme[bordercolor] ;
}


</style>";


	  
	  if ($Theme[centercat] != "") { 
	  	 echo "
		 	  <style>
		 	  td.catagorycenter {
		 	  					background-image: url($siteurl/images/$themefolder$Theme[logofolder]/$Theme[centercat]) ; 
		 	  					background-color: $Theme[catagorybg] ;
		 	  					font-family: $Theme[fontface] ;
		 	  					color: $Theme[colorcatagory] ;
		 	  					text-align: $Theme[txtaligncatagory] ; 
		 	  }
			  </style>
		 ";
	  } else {
	  	 echo "
		 	  <style>
		 	  td.catagorycenter {
		 	  					background-color: $Theme[catagorybg] ;
		 	  					font-family: $Theme[fontface] ;
		 	  					color: $Theme[colorcatagory] ;
		 	  					text-align: $Theme[txtaligncatagory] ; 
		 	  }
			  </style>
		 ";
	  }
	  
	  
	  
if ($Theme[sidecat] != "") { 
	  	 echo "
		 	  <style>
		 	  td.catagoryside {
		 	  					background-image: url($siteurl/images/$themefolder$Theme[logofolder]/$Theme[sidecat]) ; 
		 	  					background-color: $Theme[catagorybg] ;
		 	  					font-family: $Theme[fontface] ;
		 	  					color: $Theme[colorcatagory] ;
		 	  					text-align: $Theme[txtaligncatagory] ; 
		 	  }
			  </style>
		 ";
	  }  else {
	  	 echo "
		 	  <style>
		 	  td.catagoryside {
		 	  					background-color: $Theme[catagorybg] ;
		 	  					font-family: $Theme[fontface] ;
		 	  					color: $Theme[colorcatagory] ;
		 	  					text-align: $Theme[txtaligncatagory] ; 
		 	  }
			  </style>
		 ";
	  }
	  
	  
	  
?>